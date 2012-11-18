<?php
namespace PGModel\Database;

use \PGModel\Database\Types\UnsupportedTypeException;

class Types {
    static protected $types = [];

    public static function register($type_name, \Closure $in,
                                    \Closure $out) {
        $type_name = strtolower($type_name);
        static::$types[$type_name] = [
            'in'  => $in,
            'out' => $out,
        ];
    }

    public static function in($type_name, $value) {
        $type_name = strtolower($type_name);
        if (empty(static::$types[$type_name])) {
            $message = sprintf("No such type '%s'", $type_name);
            throw new \UnsupportedTypeException($message);
        } else if (!(static::$types[$type_name]['in'] instanceof
                     \Closure)) {
            $message = sprintf("No 'in' callback found for type '%s'",
                               $type_name);
            throw new \RuntimeException($message);
        }
        return static::$types[$type_name]['in']();

    }

    public static function out($type_name, $value) {
        $type_name = strtolower($type_name);
        if (empty(static::$types[$type_name])) {
            $message = sprintf("No such type '%s'", $type_name);
            throw new \UnsupportedTypeException($message);
        } else if (!(static::$types[$type_name]['in'] instanceof
                     \Closure)) {
            $message = sprintf("No 'out' callback found for type '%s'",
                               $type_name);
            throw new \RuntimeException($message);
        }
        return static::$types[$type_name]['out']();
    }
}
