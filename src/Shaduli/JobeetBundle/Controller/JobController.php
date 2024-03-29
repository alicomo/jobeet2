<?php

namespace Shaduli\JobeetBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Shaduli\JobeetBundle\Entity\Job;
use Shaduli\JobeetBundle\Form\JobType;

/**
 * Job controller.
 *
 */
class JobController extends Controller
{
    /**
     * Lists all Job entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ShaduliJobeetBundle:Category')->getWithJobs();
        $format = $this->getRequest()->getRequestFormat();
        return $this->render('ShaduliJobeetBundle:Job:index.'.$format.'.twig', array(
            'categories' => $categories,
            'lastUpdated' => !is_null($em->getRepository('ShaduliJobeetBundle:Job')->getLatestPost())?$em->getRepository('ShaduliJobeetBundle:Job')->getLatestPost()->getCreatedAt()->format(DATE_ATOM):null,
            'feedId' => sha1($this->get('router')->generate('shaduli_jobeet_homepage', array('_format'=> 'atom'), true)),
        ));
    }
    /**
     * Finds and displays a Job entity.
     *
     */
    public function showAction($company, $location, $id, $position)
    {
        $em = $this->getDoctrine()->getManager();

        $job = $em->getRepository('ShaduliJobeetBundle:Job')->find($id);

        if (!$job) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ShaduliJobeetBundle:Job:show.html.twig', array(
            'job'      => $job,
            'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to create a new Job entity.
     *
     */
    public function newAction()
    {
        $entity = new Job();
        $form   = $this->createForm(new JobType(), $entity);

        return $this->render('ShaduliJobeetBundle:Job:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Job entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Job();
        $form = $this->createForm(new JobType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('shaduli_jobeet_job_show_user', array('id' => $entity->getId())));
        }

        return $this->render('ShaduliJobeetBundle:Job:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Job entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $job = $em->getRepository('ShaduliJobeetBundle:Job')->find($id);

        if (!$job) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $editForm = $this->createForm(new JobType(), $job);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ShaduliJobeetBundle:Job:edit.html.twig', array(
            'job'      => $job,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Job entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ShaduliJobeetBundle:Job')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Job entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new JobType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('job_edit', array('id' => $id)));
        }

        return $this->render('ShaduliJobeetBundle:Job:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Job entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ShaduliJobeetBundle:Job')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Job entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('job'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
