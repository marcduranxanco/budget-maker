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
        return $this->render('dashboard/base_dashboard.html.twig', [
            'panel_type' => 'administrador',
            'controller_name' => 'IndexController',
        ]);
    }

    private function comercial(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_COMERCIAL');
        return $this->render('dashboard/base_dashboard.html.twig', [
            'panel_type' => 'comercial',
            'controller_name' => 'IndexController',
        ]);
    }

    private function jefeproyecto(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_JEFEPROYECTO');
        return $this->render('dashboard/base_dashboard.html.twig', [
            'panel_type' => 'jefe de proyecto',
            'controller_name' => 'IndexController',
        ]);
    }

    private function empleado(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EMPLEADO');
        return $this->render('dashboard/base_dashboard.html.twig', [
            'panel_type' => 'empleado',
            'controller_name' => 'IndexController',
        ]);
    }
}
