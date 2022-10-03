<?php declare(strict_types=1);

// Autoloader 
spl_autoload_register(
    function ($class)
    {
        $prefix = (string) '';
        
        /*💬*/ //echo BASE_DIR . PHP_EOL;

        $len = (int) strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0)
        {
            return;
        }
        $relative_class = substr($class, $len);
        $file = BASE_DIR . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file))
        {
            require $file;
        }
    }
);