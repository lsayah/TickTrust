<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{
    /**
     * @Route("/user/dashboard", name="user_dashboard")
     * @IsGranted("user")
     */
    public function dashboard(): Response
    {
        return $this->render('users/dashboard_user.html.twig');
    }
}