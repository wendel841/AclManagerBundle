<?php
namespace Problematic\AclManagerBundle\ORM;

trait AclFilterTrait
{
    /**
     * @var AclFilter
     */
    protected $aclFilter;

    /**
     * @param AclFilter $aclFilter
     */
    public function setAclFilter(AclFilter $aclFilter)
    {
        $this->aclFilter = $aclFilter;
    }
}
