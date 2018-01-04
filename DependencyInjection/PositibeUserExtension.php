<?php

namespace Positibe\Bundle\UserBundle\DependencyInjection;

use Positibe\Bundle\UserBundle\Form\Type\UserFormType;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class PositibeUserExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->getDefinition(UserFormType::class)->addMethodCall(
            'setRoles',
            [array_merge($config['roles'], ['ROLE_ADMIN' => 'ROLE_ADMIN'])]
        );
    }
}
