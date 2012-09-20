<?php

namespace System\NewsBundle\Controller;

use Core\CoreBaseBundle\Controller\AbstractModuleController;
/**
 * Date: 27.08.12
 * Time: 14:39
 * @author Florin Hermey <Florian.Hermey@inform-software.com>
 */
class NewsBackendController extends AbstractModuleController{
    
        public function createAction() {
            $newsCategory = new NewsCategory();
            $news = new News();
            $news->setTitle("Test News 1");
            $news->setSubtitle("Subtitle News 1");
            $news->setContent("Dies ist die erste News und das ist ihr Inhalt:\nblablabla...");
            $news->setNewsCategory($newsCategory);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();
        }
    
	public function showAction(){
                $repository = $this->getDoctrine()->getRepository('SystemNewsBundle:News');
                $news = $repository->findAll();
		return array(
			'_template' => 'SystemNewsBundle:News:news.html.twig', 'news' => $news
		);
        }
        
        public function showNewsCategoriesAction(){
		return array(
			'_template' => 'SystemNewsBundle:News:index.html.twig'
		);
        }
}
