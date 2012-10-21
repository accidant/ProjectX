<?php

namespace Module\GameBundle\Controller;

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
     * @return array
     * 
     */
    public function indexAction()
    {        
        $entities = $this->getDoctrine()->getRepository('ModuleGameBundle:Game')->findAll();

        return array (
            '_method'    => 'render',
            'entities'  => $entities
        );
    }

    /**
     * Finds and displays a Game entity.
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
     * Displays a form to create a new Game entity.
     *
     * @return array
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
            '_method'    => 'render',
            'entity'    => $entity,
            'form'      => $form->createView(),
            'icons'     => $icons
        );
    }

    /**
     * Creates a new Game entity.
     *
     * @return array
     * 
     */
    public function createAction()
    {
        $entity  = new Game();
        $form    = $this->createForm(new GameType(), $entity);
        $form->bindRequest($this->getRequest());
        
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
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'The game was created successfully');

            return array (
                '_method' => 'redirect',
                'url'    => $this->generateUrl('games_show', array('id' => $entity->getId()))
            );            
        }
        $this->get('session')->setFlash('error', 'The game could not be created');

        return array (
            '_method'    => 'render',
            'entity'    => $entity,
            'form'      => $form->createView(),
            'icons'     => $icons
        );
    }

    /**
     * Displays a form to edit an existing Game entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function editAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));
        
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
            '_method'      => 'render',
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'icons'       => $icons
        );
    }

    /**
     * Edits an existing Game entity.
     *
     * @param int $id
     * @return array
     * 
     */
    public function updateAction($id)
    {
        $entity = $this->findOneBy(array('id' => $id));

        $form   = $this->createForm(new GameType(), $entity);
        $form->bindRequest($this->getRequest());

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
            $this->persistEntity($entity);
            $this->get('session')->setFlash('success', 'The game was updated successfully');
            
            return array(
                '_method' => 'redirect',
                'url'    => $this->generateUrl('games_edit', array('id' => $id))
            );
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $this->get('session')->setFlash('error', 'The game could not be updated');
        
        return array (
            '_method'      => 'render',
            'entity'      => $entity,
            'edit_form'   => $form->createView(),
            'delete_form' => $deleteForm->createView()
        );
    }

    /**
     * Deletes a Game entity.
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
        
        $this->get('session')->setFlash('success', 'The game was deleted successfully');

        return array (
            '_method' => 'redirect',
            'url'    => $this->generateUrl('games')
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
