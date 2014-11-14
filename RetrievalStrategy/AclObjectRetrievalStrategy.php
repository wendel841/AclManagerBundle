<?php

namespace Problematic\AclManagerBundle\RetrievalStrategy;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\ObjectIdentityRetrievalStrategy;

/**
 * @author Johann Saunier <johann_27@hotmail.fr>
 */
class AclObjectRetrievalStrategy extends ObjectIdentityRetrievalStrategy implements AclObjectIdentityRetrievalStrategyInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param object $domainObject
     *
     * @return ObjectIdentity|\Symfony\Component\Security\Acl\Model\ObjectIdentityInterface
     */
    public function getObjectIdentity($domainObject)
    {
        //We allowed to retrieve objectIdentity from string !
        if (is_string($domainObject)) {
            return new ObjectIdentity($this->type, $domainObject);
        }

        return parent::getObjectIdentity($domainObject);
    }
}