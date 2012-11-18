<?php
namespace PGModel\Expression;

class Literal implements \PGModel\Expression\TableExpression,
                         \PGModel\Expression\ValueExpression {

    private $string;

    /**
     * Literal constructor
     *
     * @param string $string The literal SQL to include
     * @return \PGModel\Expression\Literal
     */
    function __construct($string) {
        if ($string instanceof \PGModel\Expression) {
            $string = $string->sql_string();
        }
        else if ((is_object($string) &&
                  !method_exists($string, '__toString')) ||
                 is_array($string)) {
            /* TODO: blow up */
        }

        $this->string = "$string";
    }

    /**
     * Literal sugary constructor
     *
     * Constructs a Literal object, or simply returns a
     * Literal object if passed a preconstructed one.
     *
     * @param string $string The literal SQL to include
     * @return \PGModel\Expression\Literal
     */
    public static function create($string) {
        if ($string instanceof self) {
            return $string;
        }
        else {
            return new static($string);
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
        return $this->string;
    }

    public function refname() {
    }
}
