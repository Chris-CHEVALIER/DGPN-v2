<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class TicketController extends AbstractController
{
    #[Route('/tickets', name: 'tickets', methods: ['GET'])]
    public function tickets(TicketRepository $ticketRepository, NormalizerInterface $normalizer): JsonResponse
    {
        $tickets = $ticketRepository->findAll();

        $ticketsNormalises = $normalizer->normalize($tickets, "json");

        return new JsonResponse($ticketsNormalises);
    }

    #[Route('/ticket/{id}', name: 'ticket', methods: ['GET'])]
    public function ticketById(Ticket $ticket, NormalizerInterface $normalizer): JsonResponse
    {
        return new JsonResponse($normalizer->normalize($ticket));
    }

    #[Route('/ticket/create', name: 'ticket-create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $json = $request->getContent();

        $ticket = $serializer->deserialize($json, Ticket::class, "json");
        $ticket->setCreatedAt(new \DateTime())->setLastUpdate(new \DateTime());
        $entityManager->persist($ticket);

        $entityManager->flush();
        return new Response('Saved new ticket !');
    }

    #[Route('/ticket/delete/{id}', name: 'ticket-delete', methods: ['DELETE'])]
    public function deleteTicket(Ticket $ticket, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($ticket);
        $entityManager->flush();
        return new Response('Deleted ticket !');
    }

    #[Route('/ticket/update/{id}', name: 'ticket-update', methods: ['PATCH'])]
    public function updateTicket(Request $request, Ticket $ticket, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $updatedTicket = $serializer->deserialize($request->getContent(), Ticket::class, "json", [AbstractNormalizer::OBJECT_TO_POPULATE => $ticket]);
        $updatedTicket->setLastUpdate(new \DateTime());
        $entityManager->persist($updatedTicket);
        $entityManager->flush();
        return new Response('Updated ticket !');
    }

}



