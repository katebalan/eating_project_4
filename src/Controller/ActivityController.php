<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityFormType;

use Doctrine\ORM\EntityManagerInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ActivityController
 * @package App\Controller
 *
 * @Route("/activity")
 */
class ActivityController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ActivityController constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Show list of all activity
     *
     * @return mixed
     * @Route("/", name="activity_list")
     * @Template()
     */
    public function listAction()
    {
        $activity = $this->em->getRepository('App:Activity')->findAll();
        shuffle ($activity);

        return [
            'activity' => $activity
        ];
    }

    /**
     * Create new activity
     *
     * @param Request $request
     * @return mixed
     * @Route("/new", name="activity_new")
     * @Template()
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(ActivityFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $activity = $form->getData();
            $activity->setCreatedAt(new \DateTime('now'));

            $this->em->persist($activity);
            $this->em->flush();

            $this->addFlash('success', 'New activity is creted!');

            return $this->redirectToRoute('activity_show', ['id' => $activity->getId()]);
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * Show activity
     *
     * @param Activity $activity
     * @return array
     * @Route("/{id}", name="activity_show")
     * @Template()
     */
    public function showAction(Activity $activity)
    {
        return [
            'activity' => $activity
        ];
    }

    /**
     * Edit activity
     *
     * @param Request $request
     * @param Activity $activity
     * @return array|RedirectResponse
     * @Route("/{id}/edit", name="activity_edit")
     * @Template()
     */
    public function editAction(Request $request, Activity $activity)
    {
        if (!$activity) {
            throw $this->createNotFoundException('The product does not exist');
        }

        $form = $this->createForm(ActivityFormType::class, $activity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity = $form->getData();

            $this->em->persist($activity);
            $this->em->flush();

            $this->addFlash('success', 'Activity is updated!');

            return $this->redirectToRoute('activity_show', ['id' => $activity->getId()]);
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * Delete activity
     *
     * @param Activity|null $activity
     * @return RedirectResponse
     * @Route("/{id}/delete", name="activity_delete")
     */
    public function deleteAction(?Activity $activity)
    {
        if (!$activity) {
            throw $this->createNotFoundException('The activity does not exist');
        } else {
            $this->em->remove($activity);
            $this->em->flush();

            $this->addFlash('success', 'Activity '.$activity->getName().' was deleted!');
        }

        return $this->redirectToRoute('activity_list');
    }
}
