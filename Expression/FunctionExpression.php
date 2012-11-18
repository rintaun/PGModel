<?php
namespace PGModel\Expression;

interface FunctionExpression extends \PGModel\Expression {
    public function name();
    public function arguments();
}
