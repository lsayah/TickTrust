<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\TicketFormType;
use App\Form\TicketEditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

class TicketController extends AbstractController
{
    #[Route('/ticket/new', name: 'ticket_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        $token = $tokenStorage->getToken();
        if (null === $token) {
            throw new AccessDeniedException('Vous devez être connecté pour créer un ticket.');
        }

        $user = $token->getUser();
        if (!is_object($user) || !in_array('ROLE_USER', $user->getRoles())) {
            throw new AccessDeniedException('Vous devez être connecté en tant qu\'utilisateur pour créer un ticket.');
        }

        $ticket = new Ticket();
        $form = $this->createForm(TicketFormType::class, $ticket);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ticket->setCreatedAt(new \DateTimeImmutable());
            $ticket->setUpdatedAt(new \DateTimeImmutable());
            $ticket->setIdAuteur($user); // Assigner l'auteur du ticket à l'utilisateur connecté

            // Assigner automatiquement un technicien libre
            $technician = $entityManager->getRepository(User::class)->findOneBy(['role' => 'ROLE_TECHNICIAN', 'isAvailable' => true]);
            if ($technician) {
                $ticket->setTechnician($technician);
                $technician->setIsAvailable(false); // Marquer le technicien comme non disponible
                $entityManager->persist($technician);
            }

            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard_user');
        }

        return $this->render('ticket/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ticket/{id}', name: 'ticket_details', requirements: ['id' => '\d+'])]
    public function details(int $id, Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        $token = $tokenStorage->getToken();
        if (null === $token) {
            throw new AccessDeniedException('Vous devez être connecté pour voir les détails du ticket.');
        }

        $user = $token->getUser();
        if (!is_object($user)) {
            throw new AccessDeniedException('Vous devez être connecté pour voir les détails du ticket.');
        }

        $ticket = $entityManager->getRepository(Ticket::class)->find($id);
        if (!$ticket) {
            throw $this->createNotFoundException('Le ticket n\'existe pas.');
        }

        // Vérifier et gérer les valeurs nulles pour service
        if ($ticket->getService() === null) {
            $ticket->setService(ServiceEnum::NONE); // Remplacez NONE par une valeur par défaut appropriée
        }

        $form = $this->createForm(TicketEditType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ajouter la nouvelle description sans supprimer l'ancienne
            $newDescription = $form->get('description')->getData();
            if ($newDescription) {
                $ticket->setDescription($ticket->getDescription() . "\n\nNouvelle Description:\n" . $newDescription);
            }

            $ticket->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('ticket_details', ['id' => $ticket->getId()]);
        }

        return $this->render('ticket/ticket_details.html.twig', [
            'ticket' => $ticket,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ticket/list', name: 'ticket_list')]
    public function list(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        $token = $tokenStorage->getToken();
        if (null === $token) {
            throw new AccessDeniedException('Vous devez être connecté pour accéder à la liste des tickets.');
        }

        $user = $token->getUser();
        if (!is_object($user) || !in_array('ROLE_ADMIN', $user->getRoles()) && !in_array('ROLE_TECHNICIAN', $user->getRoles())) {
            throw new AccessDeniedException('Vous devez être connecté en tant qu\'administrateur ou technicien pour accéder à la liste des tickets.');
        }

        $tickets = $entityManager->getRepository(Ticket::class)->findAll();

        return $this->render('ticket/list.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    #[Route('/dashboard', name: 'dashboard_user')]
    public function dashboard(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        $token = $tokenStorage->getToken();
        if (null === $token) {
            throw new AccessDeniedException('Vous devez être connecté pour accéder au tableau de bord.');
        }

        $user = $token->getUser();
        if (!is_object($user)) {
            throw new AccessDeniedException('Vous devez être connecté pour accéder au tableau de bord.');
        }

        // Récupérer le dernier ticket initié par l'utilisateur
        $lastTicket = $entityManager->getRepository(Ticket::class)->findOneBy(
            ['idAuteur' => $user],
            ['createdAt' => 'DESC']
        );

        // Récupérer l'historique des tickets initiés par l'utilisateur
        $ticketHistory = $entityManager->getRepository(Ticket::class)->findBy(
            ['idAuteur' => $user],
            ['createdAt' => 'DESC'] // Trier par date de création dans l'ordre décroissant
        );

        return $this->render('users/dashboard_user.html.twig', [
            'lastTicket' => $lastTicket,
            'ticketHistory' => $ticketHistory,
        ]);
    }

    #[Route('/tickets/user', name: 'user_ticket_list')]
    public function userTicketList(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        $token = $tokenStorage->getToken();
        if (null === $token) {
            throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }

        $user = $token->getUser();
        if (!is_object($user)) {
            throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }

        // Récupérer tous les tickets de l'utilisateur
        $tickets = $entityManager->getRepository(Ticket::class)->findBy(
            ['idAuteur' => $user],
            ['createdAt' => 'DESC'] // Trier par date de création dans l'ordre décroissant
        );

        return $this->render('Ticket/ticket_list_user.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    public function assignTechnician(Ticket $ticket, User $technician, NotifierInterface $notifier)
    {
        $ticket->setTechnician($technician);
        $technician->setIsAvailable(false);
        $this->entityManager->persist($ticket);
        $this->entityManager->persist($technician);
        $this->entityManager->flush();

        // Envoyer une notification au technicien
        $notification = (new Notification('Nouveau ticket assigné', ['email']))
            ->content('Un nouveau ticket vous a été assigné. Veuillez vérifier votre tableau de bord pour plus de détails.');
        $notifier->send($notification, $technician->getEmail());

        return $this->redirectToRoute('ticket_details', ['id' => $ticket->getId()]);
    }

}