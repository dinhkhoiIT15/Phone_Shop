<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Sale;
use App\Entity\Supplier;
use App\Form\AddProductType;
use App\Form\AddSaleType;
use App\Form\AddSupplierType;
use App\Repository\ProductRepository;
use App\Repository\SaleRepository;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaleController extends AbstractController
{
    #[Route('/sale', name: 'app_sale')]
    public function index(): Response
    {
        return $this->render('sale/index.html.twig', [
            'controller_name' => 'SaleController',
        ]);
    }

    #[Route('/sale/all', name: 'app_sale_all')]
    public function getAllCustomer(SaleRepository $saleRepository): Response
    {
        $sales = $saleRepository->findAll();
//        dd($customers[0]->getPhoneNumber());

        return $this->render('sale/all.html.twig', [
            'sales' => $sales
        ]);
    }

    #[Route('/sale/add', name: 'app_sale_add')]
    public function addSaleAction(Request $request, SaleRepository $saleRepository): Response
    {
        $sale = new Sale();

        $form = $this->createForm(AddSaleType::class, $sale);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $sale = $form->getData();
            $saleRepository->save($sale, true);
            $this->addFlash('success', 'Adding sale successfully!');
            return $this->redirectToRoute('app_sale_add');
        }

        return $this->render('sale/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/sale/edit/{id}', name: 'app_sale_edit')]
    public function editSaleAction(Request $request, SaleRepository $saleRepository, Sale $sale): Response
    {
        $form = $this->createForm(AddSaleType::class, $sale);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $sale = $form->getData();
            $saleRepository->save($sale, true);
            $this->addFlash('success', 'Adding sale successfully!');
            return $this->redirectToRoute('app_sale_all');
        }

        return $this->render('sale/eidt.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/sale/details/{id}', name:'app_sale_details')]
    public function SaleDetails(Sale $sale): Response
    {
        return $this->render('sale/details.html.twig', [
            'sales' => $sale
        ]);
    }

    #[Route('/sale/delete/{id}', name: 'app_sale_delete')]
    public function deleteAction(Sale $sale, SaleRepository $saleRepository): Response
    {
        $saleRepository->remove($sale, true);

        return $this->redirectToRoute('app_sale_all');
    }
}
