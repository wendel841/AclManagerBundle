<?php

namespace Problematic\AclManagerBundle\ORM;

use Doctrine\ORM\Query\Expr;

class ExtraCriteria
{
    const OPERATOR_AND = 'AND';
    const OPERATOR_OR = 'OR';

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var string
     */
    protected $expression;

    /**
     * @param string $operator
     * @param string $expression
     */
    public function __construct($operator, $expression)
    {
        $this->operator = $operator;
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }
} 