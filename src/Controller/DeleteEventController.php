<?php

namespace App\Controller;

use App\Entity\ReccurringEvent;
use App\Repository\ReccuringEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class DeleteEventController extends AbstractController
{

    #[Route('/delete-event/{id}', name: 'app_index')]
    public function delete(
        $id,
        EntityManagerInterface $entityManager,
        ReccuringEventRepository $reccuringEventRepository
    ): Response {
        $reccurringEvent = $reccuringEventRepository->find($id);
    
        if (!$reccurringEvent) {
            throw $this->createNotFoundException(
                'No record found for id ' . $id
            );
        }
    
        $entityManager->remove($reccurringEvent);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_index');
    }
}