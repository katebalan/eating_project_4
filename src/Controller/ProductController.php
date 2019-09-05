<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsFormType;

use Doctrine\ORM\EntityManagerInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductsController
 * @package App\Controller
 *
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ProductController constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Controller are used for show list of all products
     *
     * @return mixed
     * @Route("/", name="product_list")
     * @Template()
     */
    public function listAction()
    {
        $products = $this->em->getRepository('App:Products')->findAllOrderedByDescActive();

        return [
            'products' => $products
        ];
    }

    /**
     * Controller are used to create new product
     *
     * @param Request $request
     * @return array|RedirectResponse
     * @Route("/new", name="product_new")
     * @Template()
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(ProductsFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $product->setCreatedAt(new \DateTime('now'));

            $this->em->persist($product);
            $this->em->flush();

            $this->addFlash('success', 'New product is created!');

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Products $product
     * @return mixed
     * @Route("/{id}", name="product_show")
     * @Template()
     */
    public function showAction(?Products $product)
    {
        if (!$product) {
            throw $this->createNotFoundException('The product does not exist');
        }

        return [
            'product' => $product
        ];
    }

    /**
     * @param Request $request
     * @param Products|null $product
     * @return mixed
     * @Route("/{id}/edit", name="product_edit")
     * @Template()
     */
    public function editAction(Request $request, ?Products $product)
    {
        if (!$product) {
            throw $this->createNotFoundException('The product does not exist');
        }

        $form = $this->createForm(ProductsFormType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $this->em->persist($product);
            $this->em->flush();

            $this->addFlash('success', 'Product is updated!');

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @param Products|null $product
     * @return RedirectResponse
     * @Route("/{id}/delete", name="product_delete")
     */
    public function deleteAction(?Products $product)
    {
        if (!$product) {
            throw $this->createNotFoundException('The product does not exist');
        } else {
            $this->em->remove($product);
            $this->em->flush();

            $this->addFlash('success', 'Product '.$product->getName().' was deleted!');
        }

        return $this->redirectToRoute('product_list');
    }
}
