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
        return $this->json('Panel Admin');
    }

    private function comercial(): Response
    {
        return $this->json('Panel Comercial');
    }

    private function jefeproyecto(): Response
    {
        return $this->json('Panel Jefe de Proyecto');
    }

    private function empleado(): Response
    {
        return $this->json('Panel Empleado');
    }
}
