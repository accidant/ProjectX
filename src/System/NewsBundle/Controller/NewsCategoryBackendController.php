<?php

namespace System\NewsBundle\Controller;

use Core\CoreBaseBundle\Controller\AbstractModuleController;

use System\NewsBundle\Entity\NewsCategory;
use System\NewsBundle\Form\NewsCategoryType;

/**
 * NewsCategory controller.
 *
 */
class NewsCategoryBackendController extends AbstractModuleController
{
    /**
     * Lists all NewsCategory entities.
     *
     * @return array
     * 
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('SystemNewsBundle:NewsCategory')->findAll();

        return array (
            '_method'    => 'render',
            'entities'  => $entities
        );
    }

    /**
     * Displays a detailed view of the Categorie
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
                'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Displays a form to create a new NewsCategory entity.
    *
    * @return array
     * 
    */
    public function newAction()
    {
        $entity = new NewsCategory();
        $form   = $this->createForm(new NewsCategoryType(), $entity);

        return array (
            '_method'    => 'render',
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }

    /**
     * Creates a new Category from the Formdata
     *
     * @return array
     * 
     */
    public function createAction()
    {
        $entity  = new NewsCategory();
        $form    = $this->createForm(new NewsCategoryType(), $entity);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'News Category created successfully');

            return array (
                    '_method' => 'redirect',
                    'url'     => $this->generateUrl('newscategory_show', array('id' => $entity->getId()))
            );
        }

        $this->get('session')->setFlash('error', 'The Category could not be created');

        return array (
            '_method'   => 'render',
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }


    /**
     * Displays a Form to edit the Entity
     *
     * @param int $id
     * @return array
     * 
     */
    public function editAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));

        $form = $this->createForm(new NewsCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array (
                '_method'     => 'render',
                'entity'      => $entity,
                'form'        => $form->createView(),
                'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Updates the Entity with the delivered Information from the form
     *
     * @param int $id
     * @return array
     * 
     */
    public function updateAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));

        $form   = $this->createForm(new NewsCategoryType(), $entity);
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
                $this->persistEntity($entity);
                $this->get('session')->setFlash('success', 'News Category successfully updated');

                return array (
                        '_method' => 'redirect',
                        'url'    => $this->generateUrl('newscategory_show', array('id' => $id))
                );
        }

        $deleteForm = $this->createDeleteForm($id);

        $this->get('session')->setFlash('error', 'News Category update failed');

        return array (
                '_method'      => 'render',
                'entity'      => $entity,
                'edit_form'   => $form->createView(),
                'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Deletes a NewsCategory entity.
     *
     * @param int $id
     * @return array 
     * @todo Hierbei nochmal das vorgehen überdenken. Dies könnte man eventuell noch anders Handhaben
     *
     */
    public function deleteAction($id)
    {
        $newsCategory = $this->findOneBy(array('id'=>$id));
        $newsExists = $this->exists(array('newsCategory' => $id), 'SystemNewsBundle:News');

        if ($newsExists) {
            $news = $this->findBy(array('newsCategory' => $id), 'SystemNewsBundle:News');

            $this->get('session')->setFlash('error', 'News Category deletion failed. At least one News exists for this Category.');

            return array (
                '_method' => 'redirect',
                'url'    => $this->generateUrl('newscategory_show', array('id'=>$id, 'news'=>$news))
            );
        }

        $this->removeEntity($newsCategory);

        $this->get('session')->setFlash('success', 'News Category successfully deleted.');
        
        return array (
            '_method' => 'redirect',
            'url'    => $this->generateUrl('newscategory')
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
