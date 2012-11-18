<?php
namespace PGModel;

/**
 * PGModel class autoloader
 *
 * Appends an autoloader function to the SPL autoload stack to load
 * PGModel classes.
 *
 * It is not necessary to load this file if you have a namespace-aware
 * class autoloader already in your application.
 */

class Loader
{
    /**
     * Initialize the autoloader.
     *
     * @return boolean
     */
    public static function initialize()
    {
        $path = \dirname(__FILE__);
        $ext = \pathinfo(__FILE__, \PATHINFO_EXTENSION);
        \spl_autoload_register(
            function($class) use ($path, $ext) {
                $classPath = \explode('\\', $class);
                $prefix = \array_shift($classPath);
                if ($prefix !== 'PGModel') {
                    array_unshift($classPath, $prefix);
                    array_unshift($classPath, 'vendor');
                }
                \array_unshift($classPath, $path);
                $ds = \DIRECTORY_SEPARATOR;
                $classFilePath  = \implode($ds, $classPath);
                $classFilePath .= '.' . $ext;
                if (\is_file($classFilePath)) {
                    include $classFilePath;
                    if (\class_exists($class, false)) {
                        return true;
                    }
                }
                return false;
            }
        );
    }
}