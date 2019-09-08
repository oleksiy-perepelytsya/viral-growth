<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Entity\Invite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class InviteController extends AbstractController
{
    /**
     * @param int $user_id
     * @Route("/invite/create/user/{user_id}", name="invite_create")
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

        $invite->setCode($entityManager->getRepository(Invite::class)->generateCode($invite));
        $invite->setStatus(Invite::STATUS_ACTIVE);
        $user->addInvite($invite);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['status' => Response::HTTP_OK, 'resource' => $invite->toArray()]);
    }


    /**
     * @param int $user_id
     * @Route("/invite/user/{user_id}", name="invite")
     * @return Response
     */
    public function invitesGetByUserId($user_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->find(User::class,(int) $user_id);

        if(!$user){
            return $this->json(['status' => Response::HTTP_NOT_FOUND ]);
        }

        $invites = $user->getInvites();
        $invitesArray = [];
        if($invites) foreach($invites as $invite){
            $invitesArray[] = $invite->toArray();
        }

        return $this->json(['status' => Response::HTTP_OK, 'resource' => $invitesArray]);
    }

    /**
     * @param int $status
     * @Route("/invite/{id}/status/{status}", name="invite_set_status")
     * @return Response
     */
    public function setInviteStatus($id, $status)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $invite = $entityManager->find(Invite::class,(int) $id);

        if(!$invite || !in_array($status, Invite::ALLOWED_STATUSES)){
            return $this->json(['status' => Response::HTTP_NOT_FOUND]);
        }

        $invite->setStatus($status);
        $entityManager->persist($invite);
        $entityManager->flush();

        return $this->json(['status' => Response::HTTP_OK]);
    }
}