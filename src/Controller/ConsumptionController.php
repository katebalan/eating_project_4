<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\ConsumptionFormType;
use App\Service\CountService;

use Doctrine\ORM\EntityManagerInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ConsumptionController
 * @package App\Controller
 */
class ConsumptionController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ConsumptionController constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Controller are used for create new consumption only for user,
     * that is log in system, and change current values in user entity
     *
     * @param Request $request
     * @param User $user
     * @param CountService $countService
     * @return RedirectResponse|array
     * @throws \Exception
     *
     * @Route("/consumption/{id}/new", name="consumption_new")
     * @Template()
     */
    public function newAction(CountService $countService, Request $request, User $user)
    {
        $form = $this->createForm(ConsumptionFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $consumption = $form->getData();

            $consumption->setUser($user);
            $consumption->setCreatedAt(new \DateTime('now'));

            $user = $countService->countCurrentValues($user, $consumption->getHowMuch(), $consumption->getProduct());

            $this->em->persist($consumption);
            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('success', 'You have eaten ' . $consumption->getProduct()->getName() . '!');

            return $this->redirectToRoute('user_show', [
                'id' => $user->getId()
            ]);
        }

        return [
            'form' =>$form->createView()
        ];
    }

    /**
     * @param User $user
     * @param CountService $countService
     * @return array
     * @Route("/user/{id}/history", name="consumption_history")
     * @Template()
     */
    public function historyAction(User $user, CountService $countService)
    {
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if (!$this->isGranted('ROLE_ADMIN') && $this->getUser() != $user) {
            throw new AccessDeniedException('This user does not have access to this action.');
        }

        $day_consumption = $countService->consumptionToArray($user, 5);

        return [
            'user' => $user,
            'days_consumption' => $day_consumption
        ];
    }

}
