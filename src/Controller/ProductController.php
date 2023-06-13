<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Product;
use App\Form\AddCustomerType;
use App\Form\AddProductType;
use App\Repository\PhoneRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'product' => 'ProductController',
        ]);
    }

    #[Route('/product/add', name: 'app_product_add')]
    public function addProductAction(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();

        $form = $this->createForm(AddProductType::class, $product);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $product = $form->getData();
            $productRepository->save($product, true);
            $this->addFlash('success', 'Adding product successfully!');
            return $this->redirectToRoute('app_product_add');
        }

        return $this->render('product/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/product/all', name: 'app_product_all')]
    public function getAllProduct(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();
        //dd($product);

        return $this->render('product/all.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/product/delete/{id}', name: 'app_product_delete')]
    public function deleteAction(Product $product, ProductRepository $productRepository): Response
    {
        $productRepository->remove($product, true);

        return $this->redirectToRoute('app_product_all');
    }

    #[Route('/product/{name}', name: 'app_product_by_name')]
    public function getPhoneByName(ProductRepository $productRepository, string $name): Response
    {
        $products = $productRepository->getProductByName($name);
        return $this->render('product/all.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/product/edit/{id}', name: 'app_product_edit')]
    public function editAction(Request $request, ProductRepository $productRepository, Product $product): Response
    {
        $form = $this->createForm(AddProductType::class, $product);
        //dd($shoe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $productRepository->save($product, true);


            $this->addFlash('success', 'Customer information has been successfully updated');
            return $this->redirectToRoute('app_product_all');
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
