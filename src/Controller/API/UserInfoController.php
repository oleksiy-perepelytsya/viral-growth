<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Entity\UserInfo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserInfoController extends AbstractController
{
    /**
     * @param int $id
     * @Route("/user-info/{id}", name="user-info")
     * @return Response
     */
    public function userInfoGet($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userinfo = $entityManager->find(UserInfo::class,(int) $id);

        if(!$userinfo){
            return $this->json(['status' => Response::HTTP_NOT_FOUND ]);
        }

        return $this->json(['status' => Response::HTTP_OK, 'resource' => $userinfo->toArray()]);
    }
}