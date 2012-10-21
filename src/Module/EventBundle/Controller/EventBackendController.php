<?php

namespace Module\EventBundle\Controller;

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
     * @return array
     * 
     */
    public function indexAction()
    {
       $entities = $this->getDoctrine()->getRepository('ModuleEventBundle:Event')->findAll();

        return array (
            '_method'    => 'render',
            'entities'   => $entities
        );
    }

    /**
     * Finds and displays a Event entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function showAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));
        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_method'      => 'render',
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Displays a form to create a new Event entity.
     *
     * @return array
     * 
     */
    public function newAction()
    {
        $entity = new Event();
        $form   = $this->createForm(new EventType(), $entity);

        return array (
            '_method'    => 'render',
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }

    /**
     * Creates a new Event entity.
     *
     * @return array
     * 
     */
    public function createAction()
    {
        $entity  = new Event();
        $form    = $this->createForm(new EventType(), $entity);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'The event was created successfully');
            
            return array (
                '_method' => 'redirect',
                'url'    => $this->generateUrl('events_show', array('id' => $entity->getId()))
            );
            
        }
        
        $this->get('session')->setFlash('error', 'The event could not be created');

        return array (
            '_method'    => 'render',
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function editAction($id)
    {        
        $entity = $this->findOneBy(array('id' => $id));
        
        $editForm = $this->createForm(new EventType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_method'      => 'render',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Edits an existing Event entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function updateAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));

        $form   = $this->createForm(new EventType(), $entity);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'The event was updated successfully');

            return array (
                '_method' => 'redirect',
                'url'    => $this->generateUrl('events_edit', array('id' => $id))
            );
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $this->get('session')->setFlash('error', 'The event could not be updated');
        
        return array (
            '_method'      => 'render',
            'entity'      => $entity,
            'edit_form'   => $form->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Deletes a Event entity.
     *
     * @param int $id
     * @return array
     * @todo Hierbei nochmal das vorgehen überdenken. Dies könnte man eventuell noch anders Handhaben
     * 
     */
    public function deleteAction($id)
    {
        $game = $this->findOneBy(array('id'=>$id));
        
        $this->removeEntity($game);
        
        $this->get('session')->setFlash('success', 'The event was deleted successfully');

        return array (
            '_method' => 'redirect',
            'url'    => $this->generateUrl('events')
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
