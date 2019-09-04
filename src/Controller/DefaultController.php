<?php
declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends Controller
{
    /**
     * Controller are used to generate homepage
     *
     * @return mixed
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $userId = null;
        if( $user ) {
            $userId = $user->getId();
        }
        // replace this example code with whatever you need
        return $this->render('index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'userId' => $userId
        ]);
    }
}