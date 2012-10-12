<?php

namespace System\PageBundle\Controller;

use Core\CoreBaseBundle\Controller\AbstractModuleController;
use System\PageBundle\Entity\Page;
use System\PageBundle\Form\PageType;

/**
 * Date: 27.08.12
 * Time: 14:39
 * @author Thomas Joußen <tjoussen@databay.de>
 */
class PageController extends AbstractModuleController{

	/**
	 * @return array
	 */
	public function indexAction(){
		$entities = $this->getDoctrine()->getRepository('SystemPageBundle:Page')->findAll();

		return $this->generateView(array(
			'entities' => $entities
		));
	}

	public function showAction($id) {
		$entity = $this->findOneBy(array('id' => $id));

		return $this->generateView(array(
			'entity' => $entity
		));
	}

	public function newAction(){
		$entity = new Page();
		$form = $this->createForm(new PageType(), $entity);

		return $this->generateView(array(
			'entity' => $entity,
			'form' => $form
		));
	}

	public function createAction(){
		$entity = new Page();
		$form = $this->createForm(new PageType(), $entity);
		$form->bindRequest($this->getRequest());

		if($form->isValid()){
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($entity);
			$em->flush();

			$this->get('session')->setFlash('success', 'The Page has been created');

			return $this->generateRedirect('page');
		}

		$this->get('session')->setFlash('error', 'The Page could not be created');

		return $this->generateView(array(
			'entity' => $entity,
			'form' => $form
		));
	}

	public function editAction($id){
		$entity = $this->findOneBy(array('id' => $id));
		$form = $this->createForm(new PageType(), $entity);

		return $this->generateView(array(
			'entity' => $entity,
			'form' => $form
		));
	}

	public function updateAction($id){
		$entity = $this->findOneBy(array('id' => $id));

		$form = $this->createForm(new PageType(), $entity);
		$form->bindRequest($this->getRequest());

		if ($form->isValid()){
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($entity);
			$em->flush();

			$this->get('session')->setFlash('success', 'The Page has been updated');

			return $this->generateRedirect('page_show', array(
				'id' => $id
			));
		}

		return $this->generateView(array(
			'entity' => $entity,
			'form' => $form
		), 'SystemPageBundle:Page:edit.html.twig');

	}

	public function deleteAction($id){

	}
}
