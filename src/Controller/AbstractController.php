<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as AbstractControllerBase;

use Doctrine\ORM\EntityManagerInterface as EntityManager;

class AbstractController extends AbstractControllerBase
{
    public function __construct(private EntityManager $entityManager) {}

    protected function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    protected function getRepository(string $entityClass): object
    {
        return $this->entityManager->getRepository($entityClass);
    }
}