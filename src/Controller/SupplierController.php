<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\AddSupplierType;
use App\Repository\CustomerRepository;
use App\Repository\SupplierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends AbstractController
{
    #[Route('/supplier', name: 'app_supplier')]
    public function index(): Response
    {
        return $this->render('supplier/index.html.twig', [
            'controller_name' => 'SupplierController',
        ]);
    }

    #[Route('/supplier/add', name: 'app_supplier_add')]
    public function addSupplierAction(Request $request, SupplierRepository $supplierRepository): Response
    {
        $supplier = new Supplier();

        $form = $this->createForm(AddSupplierType::class, $supplier);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $supplier = $form->getData();
            $supplierRepository->save($supplier, true);
            $this->addFlash('success', 'Adding supplier successfully!');
            return $this->redirectToRoute('app_supplier_add');
        }

        return $this->render('supplier/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/supplier/all', name: 'app_supplier_all')]
    public function getAllCustomer(SupplierRepository $supplierRepository): Response
    {
        $suppliers = $supplierRepository->findAll();
//        dd($customers[0]->getPhoneNumber());

        return $this->render('supplier/all.html.twig', [
            'suppliers' => $suppliers
        ]);
    }
}
