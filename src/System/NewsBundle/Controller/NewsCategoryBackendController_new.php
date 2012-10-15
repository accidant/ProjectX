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
        $entities = $this->getDoctrine()->getRepository('SystemNewsBundle:NewsCategory')->findAll();

        return array (
            '_method'    => 'render',
            'entities'  => $entities,
        );
    }

	/**
	 * Displays a detailed view of the Categorie
	 *
	 * @param int $id
	 * @return array
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
     * Finds and displays a NewsCategory entity.
     *
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
            '_method'      => 'render',
            '_template'   => 'SystemNewsBundle:NewsCategory:show.html.twig',
            'entity'      => $entity,
            'news'        => $news,
            'delete_form' => $deleteForm->createView(),
            'status'      => $status,
            'message'     => $message
        );
    }  */

    /**
	 * Displays a form to create a new NewsCategory entity.
	 *
	 * @return array
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
				'url'    => $this->generateUrl('newscategory_show', array(
					'id' => $entity->getId()
				)),
			);
		}

		$this->get('session')->setFlash('error', 'The Category could not be created');

		return array (
			'_method'    => 'render',
			'entity'    => $entity,
			'form'      => $form->createView()
		);
	}

    /**
     * Creates a new NewsCategory entity.
     *
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
                    '_method'    => 'render',
                    '_template' => 'SystemNewsBundle:NewsCategory:new.html.twig',
                    'status'    => false,
                    'message'   => 'News Category creation failed. Probably the name is not unique.',
                    'entity'    => $entity,
                    'form'      => $form->createView()
                );
            }
           
            $news = $em->getRepository('SystemNewsBundle:News')->findByNewsCategory($entity->getId());

            return array (
                '_method' => 'redirect',
                'url'    => $this->generateUrl('newscategory_show', array('id' => $entity->getId(), 'status'=>true, 'message'=>'News Category created successfully', 'news'=>$news)),
            );
        }
	return array (
            '_method'    => 'render',
            '_template' => 'SystemNewsBundle:NewsCategory:new.html.twig',
            'status'    => false,
            'message'   => 'News Category creation failed',
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }*
	 */

	/**
	 * Displays a Form to edit the Entity
	 *
	 * @param int $id
	 * @return array
	 */
	public function editAction($id)
	{
		$entity = $this->findOneBy(array('id' => $id));

		$form = $this->createForm(new NewsCategoryType(), $entity);
		$deleteForm = $this->createDeleteForm($id);

		return array (
			'_method'      => 'render',
			'entity'      => $entity,
			'form'   => $form->createView(),
			'delete_form' => $deleteForm->createView()
		);

	}

    /**
     * Displays a form to edit an existing NewsCategory entity.
     *

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
            '_method'      => 'render',
            '_template'   => 'SystemNewsBundle:NewsCategory:edit.html.twig',
            'message'     => $message,
            'status'      => $status,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );

    }
	 * */

	/**
	 * Updates the Entity with the delivered Information from the form
	 *
	 * @param int $id
	 * @return array
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
				'method' => 'redirect',
				'url'    => $this->generateUrl('newscategory_show', array('id' => $id))
			);
		}

		$deleteForm = $this->createDeleteForm($id);

		$this->get('session')->setFlash('error', 'News Category update failed');

		return array (
			'method'      => 'render',
			'_template'   => 'SystemNewsBundle:NewsCategoryBackend:edit.html.twig',
			'entity'      => $entity,
			'edit_form'   => $form->createView(),
			'delete_form' => $deleteForm->createView()
		);
	}

    /**
     * Edits an existing NewsCategory entity.
     *

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
                    'method'      => 'render',
                    '_template'   => 'SystemNewsBundle:NewsCategory:edit.html.twig',
                    'entity'      => $entity,
                    'message'     => 'News Category update failed. Probably the name is not unique.',
                    'status'      => false,
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
            'method'      => 'render',
            '_template'   => 'SystemNewsBundle:NewsCategory:edit.html.twig',
            'entity'      => $entity,
            'message'     => 'News Category update failed',
            'status'      => false,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }
	 *
	 */


    /**
     * Deletes a NewsCategory entity.
	 *
	 * @todo Hierbei nochmal das vorgehen überdenken. Dies könnte man eventuell noch anders Handhaben
     *
     */
    public function deleteAction($id)
    {
        
        /*$form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        var_dump($form->isValid());exit;
        if ($form->isValid()) {*/
            $newsCategory = $this->findOneBy(array('id'=>$id));
            $newsExists = $this->exists(array('newsCategory' => $id), 'SystemNewsBundle:News');

            if (!$newsCategory) {
                throw $this->createNotFoundException('Unable to find NewsCategory entity.');
            }
            if ($newsExists) {
                $news = $this->findBy(array('newsCategory' => $id), 'SystemNewsBundle:News');
                
                $this->get('session')->setFlash('success', 'News Category deletion failed. At least one News exists for this Category.');
                
                return array (
                    'method' => 'redirect',
                    'url'    => $this->generateUrl('newscategory_show', array('id'=>$id, 'news'=>$news))
                );
            }

            $this->removeEntity($newsCategory);
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
