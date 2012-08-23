<?php

namespace Core\EntranceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('core_entrance');
		$rootNode->children()
					->arrayNode('backend')
						->children()
							->scalarNode('template')
								->defaultValue('::backend.html.twig')
								->cannotBeEmpty()
							->end()
							->arrayNode('controller')
								->useAttributeAsKey('name')
								->prototype('array')
									->children()
										->scalarNode('route')
											->isRequired(true)
										->end()
										->scalarNode('categorie')
											->defaultValue('general')
										->end()
									->end()
								->end()
							->end()
						->end()
					->end()
				->end();
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
