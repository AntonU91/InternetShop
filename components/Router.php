<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routersPath = include(ROOT . '/config/routes.php');
        $this->routes = $routersPath;
    }

    private function getURI()
    {
        if (!empty($_SERVER["REQUEST_URI"])) {
            // print_r($_SERVER["REQUEST_URI"]);
            return trim($_SERVER ["REQUEST_URI"], '/');
        }
    }

    public function run()
    {
        // Вызываем ф-ю getURI () и передаем значение (введенный в браузере запрос) переменной
        $uri = $this->getURI();
        /// теперь сравниваем при помощи регулярных выражений значение  $uri и значение $this->routes
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("#^$uriPattern$#", $uri)) {
                // создаем переменную которая хранит значение внутреннего роута
                $internalRoute = preg_replace("#^$uriPattern$#", $path, $uri);
//                print_r($internalRoute);
                $internalRoute = explode('/', $internalRoute);
                //print_r($internalRoute);

//             static $i =1;
//            echo "Результат проверки<br>";
//              print_r($internalRoute);
//              echo "<br>". "Конец итерации №$i ";
//              echo '<br>';
//              $i++;

                $controllerName = ucfirst(array_shift($internalRoute) . 'Controller');

                $actionName = "action" . ucfirst(array_shift($internalRoute));
                ///в переменную $args c учетом механизма работы ф-и array_shift ()
                ///  и шаблона ключей  значений массива в файле routes.php, помещаем возможные аргументы для ф-й контролеров
                $parameters = $internalRoute;
//                print_r($parameters);

                // Подключаем файл контролера
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                //echo $controllerFile;
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) break;

            }


        }


    }
}