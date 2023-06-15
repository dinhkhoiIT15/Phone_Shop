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
//        dd($customers);

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
    #[Route('/customer/edit/{id}', name: 'app_customer_edit')]
    public function editAction(Request $request, CustomerRepository $customerRepository, Customer $customer): Response
    {
        $form = $this->createForm(AddCustomerType::class, $customer);
        //dd($shoe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $customerRepository->save($customer, true);


            $this->addFlash('success', 'Customer information has been successfully updated');
            return $this->redirectToRoute('app_customer_all');
        }

        return $this->render('customer/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/customer/delete/{id}', name: 'app_customer_delete')]
    public function deleteAction(Customer $customer, CustomerRepository $customerRepository): Response
    {
        $customerRepository->remove($customer, true);

        return $this->redirectToRoute('app_customer_all');
    }
}
