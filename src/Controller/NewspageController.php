<?php

namespace App\Controller;

use App\Entity\Newspage;
use App\Form\NewspageType;
use App\Repository\NewspageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/newspage")
 */
class NewspageController extends AbstractController
{
    /**
     * @Route("/", name="newspage_index", methods="GET")
     */
    public function index(NewspageRepository $newspageRepository): Response
    {
        return $this->render('newspage/index.html.twig', ['newspages' => $newspageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="newspage_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $newspage = new Newspage();
        $form = $this->createForm(NewspageType::class, $newspage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newspage);
            $em->flush();

            return $this->redirectToRoute('newspage_index');
        }

        return $this->render('newspage/new.html.twig', [
            'newspage' => $newspage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newspage_show", methods="GET")
     */
    public function show(Newspage $newspage): Response
    {
        return $this->render('newspage/show.html.twig', ['newspage' => $newspage]);
    }

    /**
     * @Route("/{id}/edit", name="newspage_edit", methods="GET|POST")
     */
    public function edit(Request $request, Newspage $newspage): Response
    {
        $form = $this->createForm(NewspageType::class, $newspage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newspage_edit', ['id' => $newspage->getId()]);
        }

        return $this->render('newspage/edit.html.twig', [
            'newspage' => $newspage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newspage_delete", methods="DELETE")
     */
    public function delete(Request $request, Newspage $newspage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newspage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($newspage);
            $em->flush();
        }

        return $this->redirectToRoute('newspage_index');
    }
}
