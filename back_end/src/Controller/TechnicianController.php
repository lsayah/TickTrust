<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TechnicianController extends AbstractController
{


    #[Route('/technician/dashboard', name: 'technician_dashboard')]
    public function dashboard(): Response
    {
        $user = $this->getUser();
        if (!$user || !in_array('ROLE_TECHNICIAN', $user->getRoles())) {
            throw new AccessDeniedException('Vous devez être connecté en tant que technicien pour accéder à cette page.');
        }

        return $this->render('admin/dashboard_admin.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/technicians', name: 'technician_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            // L'administrateur voit tous les techniciens
            $technicians = $entityManager->getRepository(User::class)->findBy(['role' => 'ROLE_TECHNICIAN']);
        } else {
            // L'utilisateur voit uniquement les techniciens liés à ses tickets
            $tickets = $entityManager->getRepository(Ticket::class)->findBy(['idAuteur' => $user]);
            $technicians = [];
            foreach ($tickets as $ticket) {
                if ($ticket->getTechnician() && !in_array($ticket->getTechnician(), $technicians)) {
                    $technicians[] = $ticket->getTechnician();
                }
            }
        }

        return $this->render('technician/technician_list.html.twig', [
            'technicians' => $technicians,
        ]);
    }

    #[Route('/technician/{id}', name: 'technician_details', requirements: ['id' => '\d+'])]
    public function details(int $id, EntityManagerInterface $entityManager): Response
    {
        $technician = $entityManager->getRepository(User::class)->find($id);
        if (!$technician) {
            throw $this->createNotFoundException('Le technicien n\'existe pas.');
        }

        // Récupérer les tickets et autres informations nécessaires pour le technicien
        $tickets = $entityManager->getRepository(Ticket::class)->findBy(['technician' => $technician]);

        return $this->render('technician/technician_details.html.twig', [
            'technician' => $technician,
            'tickets' => $tickets,
            // Ajoutez d'autres informations nécessaires
        ]);
    }
}