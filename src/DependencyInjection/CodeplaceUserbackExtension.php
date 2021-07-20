<?php
declare(strict_types=1);

namespace Codeplace\UserbackBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

final class CodeplaceUserbackExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $container
            ->findDefinition('Codeplace\UserbackBundle\Service\WidgetRenderer')
            ->setArgument(0, $config['enable'])
            ->setArgument(1, $config['access_token']);

        $container
            ->findDefinition('Codeplace\UserbackBundle\EventListener\WidgetListener')
            ->setArgument(0, $config['auto_inject']);
    }
}