<?php

namespace App\Controller\API;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AuthController extends AbstractController
{
    /**
     * @Route("/auth", name="auth")
     */
    public function authentication()
    {
        $request = Request::createFromGlobals();
        $form = json_decode($request->getContent());

        if(!$form->email || !$form->password){
            return $this->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Provide email and password']);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $form->email, 'password' => $form->password]);

        if(!$user){
            return $this->json(['status' => Response::HTTP_NOT_FOUND, 'message' => 'User not found']);
        }

        return $this->json(['status' => Response::HTTP_OK, 'id' => $user->getId()]);
    }
}