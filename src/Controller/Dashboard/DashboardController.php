<?php

namespace App\Controller\Dashboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{

    public function index(string $role): Response
    {
        return $this->{$role}();
    }

    private function admin(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->json('Panel Admin');
    }

    private function comercial(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_COMERCIAL');
        return $this->json('Panel Comercial');
    }

    private function jefeproyecto(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_JEFEPROYECTO');
        return $this->json('Panel Jefe de Proyecto');
    }

    private function empleado(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLEADO');
        return $this->json('Panel Empleado');
    }
}
