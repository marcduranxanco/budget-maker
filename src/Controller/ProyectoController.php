<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Form\ProyectoType;
use App\Repository\ProyectoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proyecto")
 */
class ProyectoController extends AbstractController
{
    /**
     * @Route("/", name="app_proyecto_index", methods={"GET"})
     */
    public function index(ProyectoRepository $proyectoRepository): Response
    {
        return $this->render('proyecto/index.html.twig', [
            'proyectos' => $proyectoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_proyecto_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProyectoRepository $proyectoRepository): Response
    {
        $proyecto = new Proyecto();
        $form = $this->createForm(ProyectoType::class, $proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proyectoRepository->add($proyecto);
            return $this->redirectToRoute('app_proyecto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_proyecto_show", methods={"GET"})
     */
    public function show(Proyecto $proyecto): Response
    {
        return $this->render('proyecto/show.html.twig', [
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_proyecto_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Proyecto $proyecto, ProyectoRepository $proyectoRepository): Response
    {
        $form = $this->createForm(ProyectoType::class, $proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proyectoRepository->add($proyecto);
            return $this->redirectToRoute('app_proyecto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('proyecto/edit.html.twig', [
            'proyecto' => $proyecto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_proyecto_delete", methods={"POST"})
     */
    public function delete(Request $request, Proyecto $proyecto, ProyectoRepository $proyectoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proyecto->getId(), $request->request->get('_token'))) {
            $proyectoRepository->remove($proyecto);
        }

        return $this->redirectToRoute('app_proyecto_index', [], Response::HTTP_SEE_OTHER);
    }
}
