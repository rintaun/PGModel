<?php
namespace PGModel\Expression\Value;

class String extends \PGModel\Expression\Aliasable
             implements \PGModel\Expression\ValueExpression {
    protected $string;

    /**
     * String constructor
     *
     * @param string $string The SQL string to include
     * @return \PGModel\Expression\Value\String
     */
    function __construct($string) {
        if ($string instanceof self) {
            $string = $string->string;
        }
        else if ($string instanceof \PGModel\Expression) {
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
     * String sugary constructor
     *
     * Constructs a String object, or simply returns a
     * String object if passed a preconstructed one.
     *
     * @param string $string The SQL string to include
     * @return \PGModel\Expression\Value\String
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
        return "'" . pg_escape_string($this->string) . "'";
    }
}
