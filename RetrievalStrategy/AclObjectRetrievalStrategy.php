<?php

namespace Problematic\AclManagerBundle\RetrievalStrategy;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\ObjectIdentityRetrievalStrategy;

/**
 * @author Johann Saunier <johann_27@hotmail.fr>
 */
class AclObjectRetrievalStrategy extends ObjectIdentityRetrievalStrategy implements AclObjectIdentityRetrievalStrategyInterface
{
	const PROXY_CLASS_NAME = 'Doctrine\ORM\Proxy\Proxy';

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
        if ($domainObject instanceof DomainObjectInterface) {

            return new ObjectIdentity($domainObject->getObjectIdentifier(), $this->getObjectClass($domainObject));
        } elseif (method_exists($domainObject, 'getId')) {

            return new ObjectIdentity($domainObject->getId(), $this->getObjectClass($domainObject));
        }


        //We allowed to retrieve objectIdentity from string !
        if (is_string($domainObject)) {
            return new ObjectIdentity($this->type, $domainObject);
        }

        return parent::getObjectIdentity($domainObject);
    }

    protected function getObjectClass($domainObject){

        if(in_array(self::PROXY_CLASS_NAME, class_implements($domainObject))){
            return get_parent_class($domainObject);
        }

        return get_class($domainObject);
    }
}
