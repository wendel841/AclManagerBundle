<?php
/**
* This file is part of the AQF.
* (c) johann (johann_27@hotmail.fr)
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
**/

namespace Problematic\AclManagerBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class OrmFilterCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        //Compile only if doctrine ORM is loaded
        if(!$container->has('doctrine.orm.entity_manager')){
            return;
        }

        $aclFilterDef = new Definition('Problematic\AclManagerBundle\ORM\AclFilter', [
            new Reference('doctrine'),
            new Reference('security.context'),
            [ 'Problematic\AclManagerBundle\ORM\AclWalker', $container->getParameter('security.role_hierarchy.roles') ]
        ]);

        $container->setDefinition('problematic.acl.orm.filter', $aclFilterDef);
    }
} 