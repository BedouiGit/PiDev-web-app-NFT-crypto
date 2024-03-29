<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry as ClientClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GoogleController extends AbstractController
{
    /**
    * Link to this controller to start the "connect" process
    *
    * @Route("/connect/google", name="connect_google")
    * @param ClientRegistry $clientRegistry
    * @return \Symfony\Component\HttpFoundation\RedirectResponse
    */
    public function connectAction(ClientClientRegistry $clientRegistry)
    {
        return $clientRegistry
        ->getClient('google')
        ->redirect();
    }

    /**
    * Facebook redirects to back here afterward
    *
    * @Route("/connect/google/check", name="connect_google_check")
    * @param Request $request
    * @return JsonResponse | \Symfony\Component\HttpFoundation\RedirectResponse
    */
    public function connectCheckAction (Request $request)
    {
        if (!$this->getUser()) {
        return new JsonResponse(array('status' => false, 'message' => "User not found!"));
        } else {
        return $this->redirectToRoute('auth_front');
        }
    }
}