<?php

namespace CanalTP\SamEcoreUserManagerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Compiler pass to inject site context in extended services.
 */
class FormHandlerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $container->getDefinition('canaltp_user.registration.form.handler.default')
            ->addMethodCall('setBusinessRegistry', array(new Reference('sam.business_component')));

        $container->getDefinition('sam_user.profile.form.handler.default')
            ->addMethodCall('setBusinessRegistry', array(new Reference('sam.business_component')));
    }
}
