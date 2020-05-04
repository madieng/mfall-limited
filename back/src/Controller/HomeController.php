<?php

namespace App\Controller;

use App\Entity\Applicant;
use App\Form\ApplicantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $applicant = new Applicant();
        $form = $this->createForm(ApplicantType::class, $applicant);

        $form->handleRequest($request);
        // var_dump($request); exit;
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($applicant);

            $em->flush();
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
