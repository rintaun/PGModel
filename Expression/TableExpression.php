<?php
namespace PGModel\Expression;

interface TableExpression extends \PGModel\Expression {
    public function refname();
}
