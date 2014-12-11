<?php

namespace Problematic\AclManagerBundle\ORM;

use Doctrine\ORM\Query\SqlWalker;

class AclWalker extends SqlWalker
{
    /**
     * @param $fromClause
     *
     * @return string
     */
    public function walkFromClause($fromClause)
    {
        $sql = parent::walkFromClause($fromClause);
        $aclMetadata = $this->getQuery()->getHint('acl.metadata');

        if ($aclMetadata) {
            foreach ($aclMetadata as $key => $metadata) {
                $alias = $metadata['alias'];
                $query = $metadata['query'];
                $table = $metadata['table'];
                $tableAlias = $this->getSQLTableAlias($table, $alias);
                $aclAlias = 'ta' . $key . '_';

                $aclSql = <<<ACL_SQL
INNER JOIN ({$query}) {$aclAlias} ON {$tableAlias}.id = {$aclAlias}.id
ACL_SQL;
                $sql .= ' ' . $aclSql;
            }
        }

        return $sql;
    }
} 