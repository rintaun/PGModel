<?php
namespace PGModel;

class Query extends \PGModel\Expression\Aliasable
            implements \PGModel\Expression\Table {
    public function sql_string() {
    }

    public function refname() {
    }

    /**
     * _QueryLiteral sugary constructor
     *
     * Constructs a _QueryLiteral object, or simply returns a
     * _QueryLiteral object if passed a preconstructed one.
     *
     * @param string $string The literal SQL to include
     * @return _QueryLiteral
     */
    public static function lit($string) {
        return \PGModel\Expression\Literal::create($string);
    }

    /**
     * _QueryString sugary constructor
     *
     * Constructs a _QueryString object, or simply returns a
     * _QueryString object if passed a preconstructed one.
     *
     * @param string $string The SQL string to include
     * @return _QueryString
     */
    public static function string($string) {
        return \PGModel\Expression\Value\String::create($string);
    }

    /**
     * _QueryIdentifier sugary constructor
     *
     * Constructs a _QueryIdentifier object, or simply returns a
     * _QueryIdentifier object if passed a preconstructed one.
     *
     * @param string $identifier The SQL identifier to include
     * @return _QueryIdentifier
     */
    public static function ident($identifier) {
        return \PGModel\Expression\Identifier::create($identifier);
    }
}
