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
class NewsCategoryBackendController extends AbstractModuleController
{
    /**
     * Lists all NewsCategory entities.
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

        $entities = $em->getRepository('SystemNewsBundle:NewsCategory')->findAll();

        return array (
            '_template' => 'SystemNewsBundle:NewsCategory:index.html.twig',
            'entities'  => $entities,
            'message'   => $message,
            'status'    => $status
        );
    }

    /**
     * Finds and displays a NewsCategory entity.
     *
     */
    public function showAction()
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

        $entity = $em->getRepository('SystemNewsBundle:NewsCategory')->find($id);

        $news = $em->getRepository('SystemNewsBundle:News')->findByNewsCategory($entity->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_template'   => 'SystemNewsBundle:NewsCategory:show.html.twig',
            'entity'      => $entity,
            'news'        => $news,
            'delete_form' => $deleteForm->createView(),
            'status'      => $status,
            'message'     => $message
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
            '_template' => 'SystemNewsBundle:NewsCategory:new.html.twig',
            'entity'    => $entity,
            'form'      => $form->createView()
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
            try {
                $em->persist($entity);
                $em->flush();
            } catch (\PDOException $e) {
                return array (
                    '_template' => 'SystemNewsBundle:NewsCategory:new.html.twig',
                    'status'    => false,
                    'message'   => 'News Category creation failed. Probably the name is not unique.',
                    'entity'    => $entity,
                    'form'      => $form->createView()
                );
            }
           
            $news = $em->getRepository('SystemNewsBundle:News')->findByNewsCategory($entity->getId());

            return array (
                'method' => 'redirect',
                'url'    => $this->generateUrl('newscategory_show', array('id' => $entity->getId(), 'status'=>true, 'message'=>'News Category created successfully', 'news'=>$news)),
            );
        }

        return array (
            '_template' => 'SystemNewsBundle:NewsCategory:new.html.twig',
            'status'    => false,
            'message'   => 'News Category creation failed',
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing NewsCategory entity.
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

        $entity = $em->getRepository('SystemNewsBundle:NewsCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsCategory entity.');
        }

        $editForm = $this->createForm(new NewsCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array (
            '_template'   => 'SystemNewsBundle:NewsCategory:edit.html.twig',
            'message'     => $message,
            'status'      => $status,
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
            try {
                $em->persist($entity);
                $em->flush();
            } catch (\PDOException $e) {
                return array (
                    '_template'   => 'SystemNewsBundle:NewsCategory:edit.html.twig',
                    'entity'      => $entity,
                    'message'        => 'News Category update failed. Probably the name is not unique.',
                    'status'         => false,
                    'edit_form'   => $editForm->createView(),
                    'delete_form' => $deleteForm->createView()
                );
            }

            return array (
                'method' => 'redirect',
                'url'    => $this->generateUrl('newscategory_edit', array('id' => $id, 'message' => 'News Category successfully updated', 'status' => true))
            );
        }

        return array (
            '_template'   => 'SystemNewsBundle:NewsCategory:edit.html.twig',
            'entity'      => $entity,
            'message'     => 'News Category update failed',
            'status'      => false,
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
        
        /*$form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        var_dump($form->isValid());exit;
        if ($form->isValid()) {*/
            $em = $this->getDoctrine()->getEntityManager();
            $entityNewsCategory = $em->getRepository('SystemNewsBundle:NewsCategory')->find($id);
            $entityNews = $em->getRepository('SystemNewsBundle:News')->findOneByNewsCategory($id);

            if (!$entityNewsCategory) {
                throw $this->createNotFoundException('Unable to find NewsCategory entity.');
            }
            if ($entityNews) {
                $news = $em->getRepository('SystemNewsBundle:News')->findByNewsCategory($entity->getId());
                
                return array (
                    'method' => 'redirect',
                    'url'    => $this->generateUrl('newscategory_show', array('id'=>$id, 'news'=>$news, 'status'=>false, 'message'=>'News Category deletion failed. At least one News exists for this Category.'))
                );
            }

            $em->remove($entityNewsCategory);
            $em->flush();
        //}

        return array (
            'method' => 'redirect',
            'url'    => $this->generateUrl('newscategory', array('status'=>true, 'message'=>'News Category deleted successfully'))
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
