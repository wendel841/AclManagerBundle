<?php

namespace Problematic\AclManagerBundle;

use Problematic\AclManagerBundle\DependencyInjection\CompilerPass\OrmFilterCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProblematicAclManagerBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OrmFilterCompilerPass());
    }
}
