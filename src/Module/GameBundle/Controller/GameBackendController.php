<?php

namespace Module\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBaseBundle\Controller\AbstractModuleController;

use Module\GameBundle\Entity\Game;
use Module\GameBundle\Form\GameType;

/**
 * Game controller.
 *
 */
class GameBackendController extends AbstractModuleController
{
    /**
     * Lists all Game entities.
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

        $entities = $em->getRepository('ModuleGameBundle:Game')->findAll();

        return array (
            'method'    => 'render',
            '_template' => 'ModuleGameBundle:Game:index.html.twig',
            'entities'  => $entities,
            'status'    => $status,
            'message'   => $message
        );
    }

    /**
     * Finds and displays a Game entity.
     *
     */
    public function showAction()
    {
        $id = $_GET['id'];
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ModuleGameBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array (
            'method'      => 'render',
            '_template'   => 'ModuleGameBundle:Game:show.html.twig',
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        );
    }

    /**
     * Displays a form to create a new Game entity.
     *
     */
    public function newAction()
    {
        $entity = new Game();
        $form   = $this->createForm(new GameType(), $entity);
        
        $icons = array ();
        
        $folder = opendir($_SERVER['DOCUMENT_ROOT'].'/ProjectX/web/bundles/coreentrance/images/icons_games');
        while($file = readdir($folder)) 
        {  
            $info = @getimagesize($file);  
            if(!is_dir($file)) 
            {
                $icons[]="/ProjectX/web/bundles/coreentrance/images/icons_games/".$file;
            }
        }
        closedir($folder); 

        return array (
            'method'    => 'render',
            '_template' => 'ModuleGameBundle:Game:new.html.twig',
            'status'    => false,
            'message'   => '',
            'icons'     => $icons,
            'entity'    => $entity,
            'form'      => $form->createView()
        );
    }

    /**
     * Creates a new Game entity.
     *
     */
    public function createAction()
    {
        $entity  = new Game();
        $request = $this->getRequest();
        $form    = $this->createForm(new GameType(), $entity);
        $form->bindRequest($request);
        
        $icons = array ();
        
        $folder = opendir($_SERVER['DOCUMENT_ROOT'].'/ProjectX/web/bundles/coreentrance/images/icons_games');
        while($file = readdir($folder)) 
        {  
            $info = @getimagesize($file);  
            if(!is_dir($file)) 
            {
                $icons[]="/ProjectX/web/bundles/coreentrance/images/icons_games/".$file;
            }
        }
        closedir($folder); 

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            try {
                $em->persist($entity);
                $em->flush();
            } catch (\PDOException $e) {
                return array (
                    'method'    => 'render',
                    '_template' => 'ModuleGameBundle:Game:new.html.twig',
                    'status'    => false,
                    'message'   => 'Game creation failed. Probably the name is not unique.',
                    'entity'    => $entity,
                    'form'      => $form->createView(),
                    'icons'     => $icons
                );
            }

            return array (
                'method' => 'redirect',
                'url'    => $this->generateUrl('games_show', array('id' => $entity->getId(), 'status'=>true, 'message'=>'Game created successfully'))
            );
            
        }

        return array (
            'method'    => 'render',
            '_template' => 'ModuleGameBundle:Game:new.html.twig',
            'status'    => false,
            'message'   => 'Game creation failed.',
            'entity'    => $entity,
            'form'      => $form->createView(),
            'icons'     => $icons
        );
    }

    /**
     * Displays a form to edit an existing Game entity.
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

        $entity = $em->getRepository('ModuleGameBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $editForm = $this->createForm(new GameType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        
        $icons = array ();
        
        $folder = opendir($_SERVER['DOCUMENT_ROOT'].'/ProjectX/web/bundles/coreentrance/images/icons_games');
        while($file = readdir($folder)) 
        {  
            $info = @getimagesize($file);  
            if(!is_dir($file)) 
            {
                $icons[]="/ProjectX/web/bundles/coreentrance/images/icons_games/".$file;
            }
        }
        closedir($folder); 
        
        return array (
            'method'      => 'render',
            '_template'   => 'ModuleGameBundle:Game:edit.html.twig',
            'message'     => $message,
            'status'      => $status,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'icons'       => $icons
        );
    }

    /**
     * Edits an existing Game entity.
     *
     */
    public function updateAction()
    {
        $id = $_GET['id'];
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ModuleGameBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $editForm   = $this->createForm(new GameType(), $entity);
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
                    '_template'   => 'ModuleGameBundle:Game:edit.html.twig',
                    'message'     => 'Game update failed. Probably the name is not unique.',
                    'status'      => false,
                    'entity'      => $entity,
                    'edit_form'   => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                );
            }

            return array(
                'method' => 'redirect',
                'url'    => $this->generateUrl('games_edit', array('id' => $id, 'message' => 'Game successfully updated', 'status' => true))
            );
        }

        return array (
            'method'      => 'render',
            '_template'   => 'ModuleGameBundle:Game:edit.html.twig',
            'message'     => 'Game update failed',
            'status'      => false,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Game entity.
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
        $entity = $em->getRepository('ModuleGameBundle:Game')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Game entity.');
        }

        $em->remove($entity);
        $em->flush();
        //}

        return array (
            'method' => 'redirect',
            'url'    => $this->generateUrl('games', array('message' => 'Game successfully deleted', 'status' => true))
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
