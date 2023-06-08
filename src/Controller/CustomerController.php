<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
