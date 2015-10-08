<?php
namespace Problematic\AclManagerBundle\RetrievalStrategy;

use Symfony\Component\Security\Acl\Model\ObjectIdentityRetrievalStrategyInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

class DoctrineProxyIdRetrievalStrategy implements ObjectIdentityRetrievalStrategyInterface
{
	const PROXY_CLASS_NAME = 'Doctrine\ORM\Proxy\Proxy';

    /**
     * {@inheritDoc}
     */
    public function getObjectIdentity($domainObject) {
        if (!is_object($domainObject)) {

            return null;
        }

        if ($domainObject instanceof DomainObjectInterface) {

            return new ObjectIdentity($domainObject->getObjectIdentifier(), $this->getObjectClass($domainObject));
        } elseif (method_exists($domainObject, 'getId')) {

            return new ObjectIdentity($domainObject->getId(), $this->getObjectClass($domainObject));
        }

        return null;
    }

    protected function getObjectClass($domainObject){
        if(in_array(self::PROXY_CLASS_NAME, class_implements($domainObject))){
            return get_parent_class($domainObject);
        }

        return get_class($domainObject);
    }
}
