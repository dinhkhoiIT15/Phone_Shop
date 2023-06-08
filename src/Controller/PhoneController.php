<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Phone;
use App\Form\AddCustomerType;
use App\Repository\CustomerRepository;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhoneController extends AbstractController
{
    #[Route('/phone', name: 'app_phone')]
    public function index(): Response
    {
        return $this->render('phone/index.html.twig', [
            'controller_name' => 'PhoneController',
        ]);
    }

    #[Route('/phone/add', name: 'app_phone_add')]
    public function addSupplierAction(Request $request, PhoneRepository $phoneRepository): Response
    {
        $phone = new Phone();

        $form = $this->createForm(AddCustomerType::class, $phone);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $phone = $form->getData();
            $phoneRepository->save($phone, true);
            $this->addFlash('success', 'Adding phone successfully!');
            return $this->redirectToRoute('app_phone_add');
        }

        return $this->render('phone/add.html.twig', [
            'form' => $form
        ]);
    }
}
