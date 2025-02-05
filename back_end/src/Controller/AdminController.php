<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Ticket;
use App\Form\UserRoleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     * @IsGranted("ROLE_ADMIN")
     */
    public function dashboard(EntityManagerInterface $entityManager): Response
    {
        $technicians = $entityManager->getRepository(User::class)->findBy(['role' => 'ROLE_TECHNICIAN']);
        $totalTickets = $entityManager->getRepository(Ticket::class)->count([]);
        $activeTickets = $entityManager->getRepository(Ticket::class)->count(['statut' => 'active']);
        $closedTickets = $entityManager->getRepository(Ticket::class)->count(['statut' => 'closed']);

        // Convertir les services en chaînes de caractères
        foreach ($technicians as $technician) {
            if ($technician->getService() instanceof \App\Enum\ServiceEnum) {
                $technician->serviceLabel = $technician->getService()->label();
            } else {
                $technician->serviceLabel = 'Unknown';
            }
        }

        return $this->render('admin/dashboard_admin.html.twig', [
            'technicians' => $technicians,
            'totalTickets' => $totalTickets,
            'activeTickets' => $activeTickets,
            'closedTickets' => $closedTickets,
        ]);
    }

    /**
     * @Route("/admin/users", name="admin_user_list")
     * @IsGranted("ROLE_ADMIN")
     */
    public function listUsers(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/admin/users/edit/{id}", name="admin_user_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function editUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserRoleType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Rôle de l\'utilisateur mis à jour avec succès.');
            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/admin/users/delete/{id}", name="admin_user_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();

            $this->addFlash('success', 'Utilisateur supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_user_list');
    }
}