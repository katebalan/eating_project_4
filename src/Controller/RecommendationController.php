<?php
declare(strict_types=1);

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecommendationController
 * @package App\Controller
 *
 * @Route("/recommend")
 */
class RecommendationController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * RecommendationController constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Controller are used to recommend products
     *
     * @return array
     * @Route("/", name="recommendation_list")
     * @Template()
     */
    public function listAction()
    {
        $products = $this->em->getRepository('App:Products')->findAllOrderedByDescActive();

        $pr = array();

        $user = $this->getUser();

        $proteins = $user->getDailyProteins() - $user->getCurrentProteins();
        $fats = $user->getDailyFats() - $user->getCurrentFats();
        $carbohydrates = $user->getDailyCarbohydrates() - $user->getCurrentCarbohydrates();

        $sum = $proteins + $fats + $carbohydrates;
        $proteins = 100 * $proteins / $sum;
        $fats = 100 * $fats / $sum;
        $carbohydrates = 100 * $carbohydrates / $sum;

        foreach ($products as $i => $value) {
            $Dproteins = $products[$i]->getProteinsPer100gr() - $proteins;
            $Dfats = $products[$i]->getFatsPer100gr() - $fats;
            $Dcarbohydrates = $products[$i]->getCarbohydratesPer100gr() - $carbohydrates;

            if ($Dproteins * $Dproteins + $Dfats * $Dfats + $Dcarbohydrates * $Dcarbohydrates < 3000)
               $pr[] = $products[$i];

        }

        usort($pr, function($a, $b) {
            if ($a->getRating() > $b->getRating())
            {
                return -1;
            }
            else {
                return 1;
            }

        });

        if (!$pr) {
            $this->addFlash('error', 'You already eaten too much, forget the location of your refrigerator!');
        }

        return [
            'products' => $pr
        ];
    }
}
