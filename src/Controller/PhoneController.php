<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Phone;
use App\Entity\Product;
use App\Form\AddCustomerType;
use App\Form\AddPhoneType;
use App\Repository\CustomerRepository;
use App\Repository\PhoneRepository;
use App\Repository\ProductRepository;
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

        $form = $this->createForm(AddPhoneType::class, $phone);

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

    #[Route('/phone/all', name: 'app_phone_all')]
    public function getAllPhone(PhoneRepository $phoneRepository): Response
    {
        $phones = $phoneRepository->findAll();
        //dd($phones);
         return $this->render('phone/all.html.twig', [
             'phones' => $phones
         ]);
    }

    #[Route('/phone/{name}', name: 'app_phone_by_name')]
    public function getPhoneByName(PhoneRepository $phoneRepository, string $name): Response
    {
        $phones = $phoneRepository->getPhoneByName($name);
        return $this->render('phone/all.html.twig', [
            'phones' => $phones
        ]);
    }

    #[Route('/phone/add', name: 'app_phone_add')]
    public function addPhoneAction(Request $request,PhoneRepository $phoneRepository): Response
    {
        $phone = new Phone();
        $form =$this->createForm(AddPhoneType::class, $phone);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $phone=$form->getData();
            $phoneRepository->save($phone,true);
            $this->addFlash('success', 'Adding Phone Successfully!');
            return $this->redirectToRoute('app_phone_add');
        }
        return $this->render('phone/add.html.twig',[
            'form'=>$form
            ]);
    }
    #[Route('phone/edit', name:'app_phone_edit')]
    public function editPhoneAction(Request $request,PhoneRepository $phoneRepository,Phone $phone): Response
    {
        $phone=new Phone();
        $form=$this->createForm(AddPhoneType::class,$phone);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $phone=$form->getData();
            $phoneRepository->save($phone,true);
            //$this->editFlash('success','Adding Phone Successfully!');
            return $this->redirectToRoute('app_phone_edit');
        }
        return $this->render('phone/edit.html.twig',[
            'form'=>$form
        ]);
    }

    #[Route('/phone/delete/{id}', name: 'app_phone_delete')]
    public function deleteAction(Phone $phone, PhoneRepository $phoneRepository): Response
    {
        $phoneRepository->remove($phone, true);

        return $this->redirectToRoute('app_phone_all');
    }
}
