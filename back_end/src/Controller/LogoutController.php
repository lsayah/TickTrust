<?php
// src/Controller/LogoutController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout-success', name: 'app_logout_success')]
    public function logoutSuccess(): Response
    {
        return $this->render('log_out/index.html.twig');
    }
}