<?php

namespace System\NewsBundle\Controller;

use Core\CoreBaseBundle\Controller\AbstractModuleController;

use System\NewsBundle\Entity\News;
use System\NewsBundle\Form\NewsType;

/**
 * News controller.
 *
 */
class NewsBackendController extends AbstractModuleController
{
    /**
     * Lists all News entities.
     *
     * @return array
     * 
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('SystemNewsBundle:News')->findAll();

        return array (
            '_method'    => 'render',
            'entities'  => $entities
        );
    }

    /**
     * Finds and displays a News entity.
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
     * Displays a form to create a new News entity.
     *
     * @return array
     * 
     */
    public function newAction()
    {
        $entity = new News();
        $form   = $this->createForm(new NewsType(), $entity);
        
        $newsCategories = $this->getDoctrine()->getRepository('SystemNewsBundle:NewsCategory')->findAll();
        
        return array (
            '_method'          => 'render',
            'entity'          => $entity,
            'form'            => $form->createView(),
            'newsCategories'  => $newsCategories
        );
    }

    /**
     * Creates a new News entity.
     *
     * @return array
     * 
     */
    public function createAction()
    {
        $entity  = new News();
        $form    = $this->createForm(new NewsType(), $entity);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'The news was created successfully');
            
            return array (
                '_method' => 'redirect',
                'url'    => $this->generateUrl('news_show', array('id' => $entity->getId()))
            );    
        }
        $this->get('session')->setFlash('error', 'The news could not be created');
        
        $newsCategories = $this->getDoctrine()->getRepository('SystemNewsBundle:NewsCategory')->findAll();
        
        return array (
            '_method'        => 'render',
            'entity'         => $entity,
            'form'           => $form->createView(),
            'newsCategories' => $newsCategories
        );
    }

    /**
     * Displays a form to edit an existing News entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function editAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));

        $editForm = $this->createForm(new NewsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        
        $newsCategories = $this->getDoctrine()->getRepository('SystemNewsBundle:NewsCategory')->findAll();

        return array (
            '_method'        => 'render',
            'entity'         => $entity,
            'edit_form'      => $editForm->createView(),
            'delete_form'    => $deleteForm->createView(),
            'newsCategories' => $newsCategories
        );
    }

    /**
     * Edits an existing News entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function updateAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));

        $form   = $this->createForm(new NewsType(), $entity);
        $form->bindRequest($this->getRequest());
        
        $newsCategories = $this->getDoctrine()->getRepository('SystemNewsBundle:NewsCategory')->findAll();

        if ($form->isValid()) {
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'The news was updated successfully');
            
            return array (
                '_method' => 'redirect',
                'url'    => $this->generateUrl('news_edit', array('id' => $id))
            );
        }

        $deleteForm = $this->createDeleteForm($id);        
        $this->get('session')->setFlash('error', 'The news could not be updated');
        
        return array (
            '_method'        => 'render',
            'entity'         => $entity,
            'edit_form'      => $form->createView(),
            'delete_form'    => $deleteForm->createView(),
            'newsCategories' => $newsCategories
        );
    }

    /**
     * Deletes a News entity.
     *
     * @param int $id
     * @return array
     * @todo Hierbei nochmal das vorgehen überdenken. Dies könnte man eventuell noch anders Handhaben
     * 
     */
    public function deleteAction($id)
    {        
        $news = $this->findOneBy(array('id'=>$id));
        
        $this->removeEntity($news);
        
        $this->get('session')->setFlash('success', 'The news was successfully deleted');
        
        return array (
            '_method' => 'redirect',
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
