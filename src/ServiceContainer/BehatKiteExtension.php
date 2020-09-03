<?php

namespace Navitronic\BehatKite\ServiceContainer;

use Behat\Behat\Gherkin\ServiceContainer\GherkinExtension;
use Behat\Testwork\Cli\ServiceContainer\CliExtension;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Navitronic\BehatKite\Controller\BehatKiteController;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class BehatKiteExtension implements Extension
{
    public function process(ContainerBuilder $container)
    {
    }

    public function getConfigKey()
    {
        return 'behatkite';
    }

    public function initialize(ExtensionManager $extensionManager)
    {
    }

    public function configure(ArrayNodeDefinition $builder)
    {
    }

    public function load(ContainerBuilder $container, array $config)
    {
        $definition = new Definition(BehatKiteController::class, [
            new Reference(GherkinExtension::MANAGER_ID)
        ]);
        $definition->addTag(CliExtension::CONTROLLER_TAG, ['priority' => 1]);

        $container->setDefinition(CliExtension::CONTROLLER_TAG . '.behatkite', $definition);
    }
}