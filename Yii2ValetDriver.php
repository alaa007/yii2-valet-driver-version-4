<?php

namespace Valet\Drivers\Custom;

use Valet\Drivers\ValetDriver;

class Yii2ValetDriver extends ValetDriver
{
    /**
     * Determine if the driver serves the request.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return bool
     */
    public function serves(string $sitePath, string $siteName, string $uri): bool
    {
        if (file_exists($sitePath.'/../vendor/yiisoft/yii2/Yii.php') || file_exists($sitePath.'/vendor/yiisoft/yii2/Yii.php')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the incoming request is for a static file.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string|false
     */
    public function isStaticFile(string $sitePath, string $siteName, string $uri)/*: string|false */
    {
    
        if (file_exists($staticFilePath = $sitePath.'/frontend/web/'.$uri) && !is_dir($sitePath.'/frontend/web/'.$uri)) {
            return $staticFilePath;
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string
     */
    public function frontControllerPath(string $sitePath, string $siteName, string $uri): string
    {
         if(strpos($uri, '/backend/filemanager')!==false){
            $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];
            $_SERVER['SCRIPT_FILENAME'] = $sitePath.'/frontend/web/backend/filemanager/dialog.php';
            $_SERVER['SCRIPT_NAME'] = '/backend/filemanager/dialog.php';
            $_SERVER['PHP_SELF'] = '/backend/filemanager/dialog.php';
            $_SERVER['DOCUMENT_ROOT'] = $sitePath;
             return $sitePath.'/frontend/web/backend/filemanager/dialog.php';
        }

        if(strpos($uri, '/backend')!==false){
            $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];
            $_SERVER['SCRIPT_FILENAME'] = $sitePath.'/frontend/web/backend/index.php';
            $_SERVER['SCRIPT_NAME'] = '/backend/index.php';
            $_SERVER['PHP_SELF'] = '/backend/index.php';
            $_SERVER['DOCUMENT_ROOT'] = $sitePath;
            //if (strpos($_SERVER['REQUEST_URI'], '/backend') === 0) {
              //  $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], 8);
                //var_dump($_SERVER['REQUEST_URI']);
                // /die;
            //}
            return $sitePath.'/frontend/web/backend/index.php';
        }elseif(strpos($uri, '/employer')!==false){
            $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];
            $_SERVER['SCRIPT_FILENAME'] = $sitePath.'/frontend/web/employer/index.php';
            $_SERVER['SCRIPT_NAME'] = '/employer/index.php';
            $_SERVER['PHP_SELF'] = '/employer/index.php';
            $_SERVER['DOCUMENT_ROOT'] = $sitePath;
            //if (strpos($_SERVER['REQUEST_URI'], '/backend') === 0) {
              //  $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], 8);
                //var_dump($_SERVER['REQUEST_URI']);
                // /die;
            //}
            return $sitePath.'/frontend/web/employer/index.php';
        }else{
            $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];
            $_SERVER['SCRIPT_FILENAME'] = $sitePath.'/frontend/web/index.php';
            $_SERVER['SCRIPT_NAME'] = '/index.php';
            $_SERVER['PHP_SELF'] = '/index.php';
            $_SERVER['DOCUMENT_ROOT'] = $sitePath;

            return $sitePath.'/frontend/web/index.php';
        }
    }
}
