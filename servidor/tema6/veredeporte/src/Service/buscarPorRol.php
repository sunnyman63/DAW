<?php

namespace App\Service;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;

class buscarPorRol {

    public function findByRole(EntityManagerInterface $em, string $role)
    {
        return $em->createQueryBuilder()
            ->select("roles")
            ->from(Usuario::class, "usuario")
            ->where('roles LIKE :role')
            ->setParameter('role', 'ROLE_"' . strtoupper($role) . '"')
            ->getQuery()
            ->getResult();
    }

}