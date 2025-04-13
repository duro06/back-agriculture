<?php

namespace App\Helpers\Routes;

class RouteHelper
{
    public static function includeRouteFiles(string $folder)
    {
        $dirIterator = new \RecursiveDirectoryIterator($folder);
        $iterator = new \RecursiveIteratorIterator($dirIterator);

        while ($iterator->valid()) {
            if (!$iterator->isDot() && $iterator->isFile() && $iterator->isReadable() && $iterator->current()->getExtension() === 'php') {
                require $iterator->key();
            }
            $iterator->next();
        }
    }
}
