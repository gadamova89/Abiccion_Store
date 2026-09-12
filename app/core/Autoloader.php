<?php
class Autoloader{
    private static $baseDirs =[
        'app'. DIRECTORY_SEPARATOR . 'controllers',
        'app'. DIRECTORY_SEPARATOR . 'models',
        'app'. DIRECTORY_SEPARATOR . 'core',
    ];

    public static function register(){
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    
    public static function autoload($class){
        $classPath = DIRECTORY_SEPARATOR . $class .'.php';

        foreach (self::$baseDirs as $baseDir ) {
            $file = getcwd(). DIRECTORY_SEPARATOR . $baseDir . $classPath;
            //getcwd hace referencia al directorio actual de trabajo

            if(file_exists($file)){
                require $file;
                return;
            }

        }
        echo ("<p>El archivo para la clase {$class} no fue encontrado.</p>");
        error_log("El archivo para la clase {$class} no fue encontrado.");

    }

}
Autoloader::register();
?>