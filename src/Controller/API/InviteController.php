<?php

namespace App\Controller\API;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class InviteController extends AbstractController
{
    /**
     * @param int $user_id
     * @Route("/invite/{user_id}/create", name="invite_create")
     * @return Response
     */
    public function inviteCreate($user_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->find(User::class,(int) $user_id);

        if(!$user){
            return $this->json(['status' => Response::HTTP_NOT_FOUND ]);
        }

        $invite = new Invite();

        $invite->setCode($entityManager->getRepository(Code::class)->generateCode($invite));
        $invite->setUser($user);
        $entityManager->persist($invite);
        $entityManager->flush();

        return $this->json(['status' => Response::HTTP_OK, 'resource' => $invite->toArray()]);
    }


    /**
     * @param int $user_id
     * @Route("/invite/{user_id}", name="invite")
     * @return Response
     */
    public function inviteGet($user_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $invite = $entityManager->find(Invite::class,(int) $user_id);

        if(!$invite){
            return $this->json(['status' => Response::HTTP_NOT_FOUND ]);
        }

        return $this->json(['status' => Response::HTTP_OK, 'resource' => $invite->toArray()]);
    }
}