<?php

namespace Shaduli\JobeetBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Shaduli\JobeetBundle\Entity\Category;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
    /**
     * Lists all Category entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ShaduliJobeetBundle:Category')->findAll();

        return $this->render('ShaduliJobeetBundle:Category:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Category entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('ShaduliJobeetBundle:Category')->findOneBy(array('slug' => $slug));
        
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }
        else {
            $jobs = $em->getRepository('ShaduliJobeetBundle:Job')->getActiveJobs($category);
        }
        
        $format = $this->getRequest()->getRequestFormat();
        return $this->render('ShaduliJobeetBundle:Category:show.'.$format.'.twig', array(
            'category'      => $category,
            'jobs' => $jobs,
            'feedId' => sha1($this->get('router')->generate('shaduli_jobeet_job_category', array('slug' =>  $category->getSlug(), '_format' => 'atom'), true))
        ));
    }

}
