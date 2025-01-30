<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{

    #[Route('/technicians', name: 'technician_list')]
    public function technicians(EntityManagerInterface $entityManager): Response
    {
        $technicians = $entityManager->getRepository(User::class)->findBy(['role' => 'ROLE_TECHNICIAN']);

        return $this->render('employee/technicians.html.twig', [
            'technicians' => $technicians,
        ]);
    }
}