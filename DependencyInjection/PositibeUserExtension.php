<?php

namespace Positibe\Bundle\UserBundle\DependencyInjection;

use Positibe\Bundle\UserBundle\Form\Type\UserFormType;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
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

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->getDefinition(UserFormType::class)->addMethodCall(
            'setRoles',
            [array_merge($config['roles'], ['ROLE_ADMIN' => 'ROLE_ADMIN'])]
        );

        if ($container->getParameter('kernel.bundles')['PositibeMailingBundle']) {
            $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

            $loader->load('mailer.yml');
        }
    }
}
