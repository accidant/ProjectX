<?php

namespace System\NewsBundle\Controller;

use Core\CoreBaseBundle\Controller\AbstractModuleController;
/**
 * Date: 27.08.12
 * Time: 14:39
 * @author Florin Hermey <Florian.Hermey@inform-software.com>
 */
class NewsCategoryBackendController extends AbstractModuleController{
           
        public function createAction() {
            $newsCategory->setName("Test Kategorie 1");
            $newsCategory->setDescription("Beschreibung zu Kategorie 1");
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($newsCategory);
            $em->flush();
        }
    
        public function showAction(){
		return array(
			'_template' => 'SystemNewsBundle:NewsCategory:newsCategories.html.twig'
		);
        }
}
