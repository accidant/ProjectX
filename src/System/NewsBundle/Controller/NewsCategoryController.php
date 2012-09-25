<?php

namespace System\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBaseBundle\Controller\AbstractModuleController;

use System\NewsBundle\Entity\NewsCategory;
use System\NewsBundle\Form\NewsCategoryType;

/**
 * NewsCategory controller.
 *
 */
class NewsCategoryController extends AbstractModuleController
{
    /**
     * Lists all NewsCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('SystemNewsBundle:NewsCategory')->findAll();

        return array (
            'SystemNewsBundle:NewsCategory:index.html.twig',
            'entities' => $entities
        );
    }

    /**
     * Finds and displays a NewsCategory entity.
     *
     */
    public function showAction()
    {
        $id = $_GET['id'];
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SystemNewsBundle:NewsCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array (
            'SystemNewsBundle:NewsCategory:show.html.twig',
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Displays a form to create a new NewsCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new NewsCategory();
        $form   = $this->createForm(new NewsCategoryType(), $entity);

        return array (
            'SystemNewsBundle:NewsCategory:new.html.twig',
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new NewsCategory entity.
     *
     */
    public function createAction()
    {
        $entity  = new NewsCategory();
        $request = $this->getRequest();
        $form    = $this->createForm(new NewsCategoryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            return array (
                'method' => 'redirect',
                'url' => $this->generateUrl('newscategory_show', array('id' => $entity->getId())),
            );
        }

        return array (
            '_template' => 'SystemNewsBundle:NewsCategory:new.html.twig',
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing NewsCategory entity.
     *
     */
    public function editAction()
    {
        $id = $_GET['id'];
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SystemNewsBundle:NewsCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsCategory entity.');
        }

        $editForm = $this->createForm(new NewsCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_template' => 'SystemNewsBundle:NewsCategory:edit.html.twig',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );
        
    }

    /**
     * Edits an existing NewsCategory entity.
     *
     */
    public function updateAction()
    {
        $id = $_GET['id'];
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('SystemNewsBundle:NewsCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsCategory entity.');
        }

        $editForm   = $this->createForm(new NewsCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return array (
                'method' => 'redirect',
                'url' => $this->generateUrl('newscategory_edit', array('id' => $id))
            );
        }

        return array (
            '_template' => 'SystemNewsBundle:NewsCategory:edit.html.twig',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Deletes a NewsCategory entity.
     *
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('SystemNewsBundle:NewsCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NewsCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return array (
            'method' => 'redirect',
            'url' => $this->generateUrl('newscategory')
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
