<?php

namespace Problematic\AclManagerBundle\RetrievalStrategy;

use Symfony\Component\Security\Acl\Model\ObjectIdentityRetrievalStrategyInterface;

interface AclObjectIdentityRetrievalStrategyInterface extends ObjectIdentityRetrievalStrategyInterface
{
    /**
     * @param string $type
     */
    public function setType($type);
}
