<?php

namespace System\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBaseBundle\Controller\AbstractModuleController;

use System\NewsBundle\Entity\News;
use System\NewsBundle\Form\NewsType;

/**
 * News controller.
 *
 */
class NewsController extends AbstractModuleController
{
    /**
     * Lists all News entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SystemNewsBundle:News')->findAll();

        return array (
            '_template' => 'SystemNewsBundle:News:index.html.twig',
            'entities'  => $entities
        );
    }

    /**
     * Finds and displays a News entity.
     *
     */
    public function showAction()
    {
        $id = $_GET['id'];
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SystemNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_template'   => 'SystemNewsBundle:News:show.html.twig',
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Displays a form to create a new News entity.
     *
     */
    public function newAction()
    {
        $entity = new News();
        $form   = $this->createForm(new NewsType(), $entity);
        $em = $this->getDoctrine()->getEntityManager();
        $newsCategories = $em->getRepository('SystemNewsBundle:NewsCategory')->findAll();
        $em->flush();
        return array (
            '_template'       => 'SystemNewsBundle:News:new.html.twig',
            'entity'          => $entity,
            'newsCategories'  => $newsCategories,
            'form'            => $form->createView()
        );
    }

    /**
     * Creates a new News entity.
     *
     */
    public function createAction()
    {
        $entity  = new News();
        $request = $this->getRequest();
        $form    = $this->createForm(new NewsType(), $entity);
          //      var_dump($form['_token']);exit;
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return array (
                'method' => 'redirect',
                'url'    => $this->generateUrl('news_show', array('id' => $entity->getId()))
            );
            
        }
        $em = $this->getDoctrine()->getEntityManager();
        $newsCategories = $em->getRepository('SystemNewsBundle:NewsCategory')->findAll();
        $em->flush();
        
        // needed if form was invalid
        $entity = new News();
        return array (
            '_template'    => 'SystemNewsBundle:News:new.html.twig',
            'entity'       => $entity,
            'newsCategories' => $newsCategories,
            'form'         => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     */
    public function editAction()
    {
        $id = $_GET['id'];
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SystemNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $editForm = $this->createForm(new NewsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_template'   => 'SystemNewsBundle:News:edit.html.twig',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Edits an existing News entity.
     *
     */
    public function updateAction()
    {
        $id = $_GET['id'];
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SystemNewsBundle:News')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find News entity.');
        }

        $editForm   = $this->createForm(new NewsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            return array (
                'method' => 'redirect',
                'url'    => $this->generateUrl('news_edit', array('id' => $id))
            );
        }

        return array (
            '_template'   => 'SystemNewsBundle:News:edit.html.twig',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Deletes a News entity.
     *
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        /*$form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);
        
        if ($form->isValid()) {*/
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SystemNewsBundle:News')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find News entity.');
            }

            $em->remove($entity);
            $em->flush();
        //}
        
        return array (
            'method' => 'redirect',
            'url'    => $this->generateUrl('news')
        );
    }

    private function createDeleteForm($id)
    {        
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
