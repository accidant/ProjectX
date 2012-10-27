<?php

namespace Module\ApplicationBundle\Controller;

use Core\CoreBaseBundle\Controller\AbstractModuleController;

use Module\ApplicationBundle\Entity\Application;
use Module\ApplicationBundle\Form\ApplicationType;

/**
 * Application controller.
 *
 */
class ApplicationBackendController extends AbstractModuleController
{
    /**
     * Lists all Application entities.
     *
     * @return array
     * 
     */
    public function indexAction()
    {
       $entities = $this->getDoctrine()->getRepository('ModuleApplicationBundle:Application')->findAll();

        return array (
            '_method'    => 'render',
            'entities'   => $entities
        );
    }

    /**
     * Finds and displays a Application entity.
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
            '_method'     => 'render',
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Displays a form to create a new Application entity.
     *
     * @return array
     * 
     */
    public function newAction()
    {
        $entity = new Application();
        $form   = $this->createForm(new ApplicationType(), $entity);

        $games = $this->getDoctrine()->getRepository('ModuleGameBundle:Game')->findAll();
        
        return array (
            '_method'   => 'render',
            'entity'    => $entity,
            'form'      => $form->createView(),
            'games'     => $games
        );
    }

    /**
     * Creates a new Application entity.
     *
     * @return array
     * 
     */
    public function createAction()
    {
        $entity  = new Application();
        $form    = $this->createForm(new ApplicationType(), $entity);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'The application was created successfully');
            
            return array (
                '_method' => 'redirect',
                'url'     => $this->generateUrl('applications_show', array('id' => $entity->getId()))
            );
            
        }
        
        $this->get('session')->setFlash('error', 'The application could not be created');

        $games = $this->getDoctrine()->getRepository('ModuleGameBundle:Game')->findAll();
        
        return array (
            '_method'   => 'render',
            'entity'    => $entity,
            'form'      => $form->createView(),
            'games'     => $games
        );
    }

    /**
     * Displays a form to edit an existing Application entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function editAction($id)
    {        
        $entity = $this->findOneBy(array('id' => $id));
        
        $editForm = $this->createForm(new ApplicationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $games = $this->getDoctrine()->getRepository('ModuleGameBundle:Game')->findAll();
        
        return array (
            '_method'     => 'render',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'games'       => $games
        );
    }

    /**
     * Edits an existing Application entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function updateAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));

        $form   = $this->createForm(new ApplicationType(), $entity);
        $form->bindRequest($this->getRequest());

        $games = $this->getDoctrine()->getRepository('ModuleGameBundle:Game')->findAll();
        
        if ($form->isValid()) {
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'The application was updated successfully');

            return array (
                '_method' => 'redirect',
                'url'    => $this->generateUrl('applications_edit', array('id' => $id))
            );
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $this->get('session')->setFlash('error', 'The application could not be updated');
        
        return array (
            '_method'      => 'render',
            'entity'      => $entity,
            'edit_form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
            'games'       => $games
        );
    }

    /**
     * Deletes a Application entity.
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
        
        $this->get('session')->setFlash('success', 'The application was deleted successfully');

        return array (
            '_method' => 'redirect',
            'url'    => $this->generateUrl('applications')
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
