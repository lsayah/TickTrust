<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class TechnicianController extends AbstractController
{
    /**
     * @Route("/technician/dashboard", name="technician_dashboard")
     * @IsGranted("technician")
     */
    public function dashboard(): Response
    {
        return $this->render('technician/technician_dashboard.html.twig');
    }
}