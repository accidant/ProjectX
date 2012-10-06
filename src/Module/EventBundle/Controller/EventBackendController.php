<?php

namespace Module\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBaseBundle\Controller\AbstractModuleController;

use Module\EventBundle\Entity\Event;
use Module\EventBundle\Form\EventType;

/**
 * Event controller.
 *
 */
class EventBackendController extends AbstractModuleController
{
    /**
     * Lists all Event entities.
     *
     */
    public function indexAction()
    {
        $message = "";
        $status = false;
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
        }
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
        }
        
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ModuleEventBundle:Event')->findAll();

        return array (
            '_template' => 'ModuleEventBundle:Event:index.html.twig',
            'entities'  => $entities,
            'status'    => $status,
            'message'   => $message
        );
    }

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction()
    {
        $id = $_GET['id'];
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ModuleEventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_template' => 'ModuleEventBundle:Event:show.html.twig',
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Displays a form to create a new Event entity.
     *
     */
    public function newAction()
    {
        $entity = new Event();
        $form   = $this->createForm(new EventType(), $entity);

        return array (
            '_template' => 'ModuleEventBundle:Event:new.html.twig',
            'status'    => false,
            'message'   => '',
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }

    /**
     * Creates a new Event entity.
     *
     */
    public function createAction()
    {
        $entity  = new Event();
        $request = $this->getRequest();
        $form    = $this->createForm(new EventType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return array (
                'method' => 'redirect',
                'url'    => $this->generateUrl('events_show', array('id' => $entity->getId()))
            );
            
        }

        return array (
            '_template' => 'ModuleEventBundle:Event:new.html.twig',
            'status'    => false,
            'message'   => 'Event creation failed.',
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAction()
    {
        $id = $_GET['id'];
        
        $message = "";
        $status = false;
        if (isset($_GET['message'])) {
            $message = $_GET['message'];
        }
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
        }
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ModuleEventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $editForm = $this->createForm(new EventType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_template'   => 'ModuleEventBundle:Event:edit.html.twig',
            'message'     => $message,
            'status'      => $status,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Event entity.
     *
     */
    public function updateAction()
    {
        $id = $_GET['id'];
                
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ModuleEventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $editForm   = $this->createForm(new EventType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return array (
                'method' => 'redirect',
                'url'    => $this->generateUrl('events_edit', array('id' => $id, 'message' => 'Event successfully updated', 'status' => true))
            );
        }

        return array (
            '_template'   => 'ModuleEventBundle:Event:edit.html.twig',
            'message'     => 'Event update failed',
            'status'      => false,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Event entity.
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
        $entity = $em->getRepository('ModuleEventBundle:Event')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $em->remove($entity);
        $em->flush();
        //}

        return array (
            'method' => 'redirect',
            'url'    => $this->generateUrl('events', array('message' => 'Event successfully deleted', 'status' => true))
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
