<?php
function autoLoad($classname)
{
    $arrayPath = array(
        '/models/',
        '/components/'
    );

    foreach ($arrayPath as $path) {
        $filePath = ROOT . $path . $classname . "pfp";
        if (file_exists($filePath)) {
            include_once ($filePath);
        }

    }
}