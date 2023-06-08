<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Supplier;
use App\Form\AddCustomerType;
use App\Form\AddSupplierType;
use App\Repository\CustomerRepository;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(): Response
    {
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }

    #[Route('/customer/all', name: 'app_customer_all')]
    public function getAllCustomer(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();
//        dd($customers[0]->getPhoneNumber());

        return $this->render('customer/all.html.twig', [
            'customers' => $customers
        ]);
    }

    #[Route('/customer/add', name: 'app_customer_add')]
    public function addSupplierAction(Request $request, CustomerRepository $customerRepository): Response
    {
        $customer = new Customer();

        $form = $this->createForm(AddCustomerType::class, $customer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $customer = $form->getData();
            $customerRepository->save($customer, true);
            $this->addFlash('success', 'Adding customer successfully!');
            return $this->redirectToRoute('app_customer_add');
        }

        return $this->render('customer/add.html.twig', [
            'form' => $form
        ]);
    }
}
