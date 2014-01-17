<?php

namespace Loader;
/**
 * Implements a lightweight PSR-0 compliant autoloader.
 *
 */
class Autoloader
{
    private $baseDir;
    private $prefix;

    /**
     * @param string $baseDirectory Base directory where the source files are located.
     */
    public function __construct($baseDirectory = null)
    {
        $this->baseDir = $baseDirectory ?: dirname(__FILE__);
        $this->prefix = __NAMESPACE__ . '\\';
    }

    /**
     * Registers the autoloader class with the PHP SPL autoloader.
     */
    public static function register()
    {
        spl_autoload_register(array(new self, 'autoload'));
    }

    /**
     * Loads a class from a file using its fully qualified name.
     *
     * @param string $className Fully qualified name of a class.
     */
    public function autoload($className)
    {
        $relativeClassName = substr($className, strlen($this->prefix));
        $classNameParts = explode('\\', $className);
        $file = $this->baseDir.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $classNameParts).'.php';
        if (file_exists($file))
        {
            require_once $file;
        }
        else
        {
           echo 'Unable to load ' . $file . "\n";
           exit ;
        }
    }
}
