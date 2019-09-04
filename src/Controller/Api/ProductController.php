<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Products;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductController
 * @package App\Controller\Api
 */
class ProductController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/product")
     */
    public function listAction()
    {
        $restresults = $this->getDoctrine()->getRepository('App:Products')->findAll();

        if ($restresults === null) {
            return new View("There are no products exist", Response::HTTP_NOT_FOUND);
        }

        $result = [];
        foreach ($restresults as $restresult) {
            $result[] = [
                'id' => $restresult->getId(),
                'name' => $restresult->getName(),
            ];
        }

        return $result;
    }

    /**
     * @Rest\Get("/api/product/{id}")
     */
    public function showAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('App:Products')->find($id);
        if ($singleresult === null) {
            return new View("Product not found", Response::HTTP_NOT_FOUND);
        }

        $result = [
            'id' => $singleresult->getId(),
            'name' => $singleresult->getName(),
        ];

        return $result;
    }

    /**
     * @Rest\Post("/api/product/new")
     */
    public function newAction(Request $request)
    {
        $element = new Products();

        $name = $request->get('name');
        $kkal = $request->get('kkal');
        $proteins = $request->get('proteins');
        $fats = $request->get('fats');
        $carbohydrates = $request->get('carbohydrates');
        $rating = $request->get('rating');

        if (empty($name) ||
            empty($kkal) ||
            empty($proteins) ||
            empty($fats) ||
            empty($carbohydrates) ||
            empty($rating)
        ) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }

        $element->setName($name);
        $element->setKkalPer100gr($kkal);
        $element->setProteinsPer100gr($proteins);
        $element->setFatsPer100gr($fats);
        $element->setCarbohydratesPer100gr($carbohydrates);
        $element->setRating($rating);
        $element->setCreatedAt(new \DateTime('now'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($element);
        $em->flush();

        return new View("Product was added successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/api/product/{id}")
     */
    public function updateAction($id, Request $request)
    {
        $name = $request->get('name');
        $kkal = $request->get('kkal');
        $proteins = $request->get('proteins');
        $fats = $request->get('fats');
        $carbohydrates = $request->get('carbohydrates');
        $rating = $request->get('rating');

        $sn = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('App:Products')->find($id);

        if (empty($product)) {
            return new View("Product not found", Response::HTTP_NOT_FOUND);
        }

        if (!empty($name)) {
            $product->setName($name);
        }

        if (!empty($kkal)) {
            $product->setKkalPer100gr($kkal);
        }

        if (!empty($proteins)) {
            $product->setProteinsPer100gr($proteins);
        }

        if (!empty($fats)) {
            $product->setFatsPer100gr($fats);
        }

        if (!empty($carbohydrates)) {
            $product->setCarbohydratesPer100gr($carbohydrates);
        }

        if (!empty($rating)) {
            $product->setRating($rating);
        }

        $sn->flush();
        return new View("Product was updated successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/api/product/{id}")
     */
    public function deleteAction($id)
    {
        $sn = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository('App:Products')->find($id);

        if (empty($product)) {
            return new View("Product not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($product);
            $sn->flush();
        }

        return new View("deleted successfully", Response::HTTP_OK);
    }
}
