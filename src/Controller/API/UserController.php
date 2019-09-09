<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Entity\UserInfo;
use App\Entity\Invite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserController extends AbstractController
{
    /**
     * @Route("/user/create", name="user_create")
     */
    public function userCreate()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $request = Request::createFromGlobals();
        $form = json_decode($request->getContent());

        if(!$form->email || !$form->password || !$form->password2){
            return $this->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Provide email and password']);
        }

        if($form->password != $form->password2){
            return $this->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Passwords do not match']);
        }

        $existedUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $form->email]);

        if($existedUser){
            return $this->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Email already in use']);
        }

        $user = new User();
        $user->setEmail($form->email);
        $user->setPassword($form->password);

        $invite = $entityManager->getRepository(Invite::class)->findOneBy(['code' => $form->code]);

        if(!$invite){
            return $this->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Viral Code is not valid!']);
        }

        if($invite->getStatus() == Invite::STATUS_USED){
            return $this->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Viral Code has been already used!']);
        }

        $user->setInviteCode($invite->getCode());
        $userInfo = new UserInfo();
        $userInfo->setName($form->name);
        $userInfo->setDescription($form->description);

        $user->setUserInfo($userInfo);
        $entityManager->persist($user);
        $entityManager->flush();

        $this->forward('App\Controller\API\InviteController::setInviteStatus', [
            'id'  => $invite->getId(),
            'status' => Invite::STATUS_USED,
        ]);

        return $this->json(['status' => Response::HTTP_OK, 'id' => $user->getId()]);
    }


    /**
     * @param int $id
     * @Route("/user/{id}", name="user")
     * @return Response
     */
    public function userGet($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->find(User::class,(int) $id);

        if(!$user){
            return $this->json(['status' => Response::HTTP_NOT_FOUND ]);
        }

        return $this->json(['status' => Response::HTTP_OK, 'resource' => $user->toArray()]);
    }
}