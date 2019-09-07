<?php

namespace App\Controller\API;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserController extends AbstractController
{
    /**
     * @Route("/user/create", name="user_create")
     */
    public function userCreate()
    {
        $request = Request::createFromGlobals();
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        if(!$email || !$password){
            return $this->json(['status' => Response::HTTP_BAD_REQUEST]);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setEmail($email);
        $user->setEmail($password);
        $entityManager->persist($user);
        $entityManager->flush();

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