<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     * @IsGranted("admin")
     */
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard_admin.html.twig');
    }
}