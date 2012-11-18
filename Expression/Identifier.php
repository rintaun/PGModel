<?php
namespace PGModel\Expression;

class Identifier extends Aliasable
                 implements \PGModel\Expression\TableExpression,
                            \PGModel\Expression\ValueExpression {
    protected $identifier;

    /**
     * Identifier constructor
     *
     * @param string $identifier The SQL identifier to include
     * @return \PGModel\Expression\Identifier
     */
    function __construct($identifier) {
        if ($identified instanceof self) {
            $identifier = $identifier->identifier;
        }
        else if ($identifier instanceof \PGModel\Expression) {
            $identifier = $identifier->sql_string();
        }
        else if ((is_object($identifier) &&
                  !method_exists($identifier, '__toString')) ||
                 is_array($identifier)) {
            /* TODO: blow up */
        }

        $this->identifier = "$identifier";
    }

    /**
     * Identifier sugary constructor
     *
     * Constructs an Identifier object, or simply returns an
     * Identifier object if passed a preconstructed one.
     *
     * @param string $identifier The SQL identifier to include
     * @return \PGModel\Expression\Identifier
     */
    public static function create($identifier) {
        if ($identifier instanceof self) {
            return $identifier;
        }
        else {
            return new static($identifier);
        }
    }

    /**
     * Produce SQL code from this object.
     *
     * Processes this expression and returns the resulting SQL
     * string.
     *
     * @return string
     */
    public function sql_string() {
        return Database::quote_identifier($this->identifier);
    }

    public function refname() {
    }
}
