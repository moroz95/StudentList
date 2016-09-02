<?php

/**
 * Class App
 *
 * Create controller and call it methods
 *
 * @author Phrlog <phrlog@gmail.com>
 */
class App
{
    
    public $method = 'index';

    /**
     * App constructor.
     */
    public function __construct()
    {
        $url = $this->parseUrl();

        // Подключаем файл контроллера и создаем новый
        $this->controller = new Controller();

        // Был ли передан второй параметр?
        // Если да, это должен быть нужный метод контроллера
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        unset($url[0]);

        // Параметры или пустой массив, или оставшиеся элементы массива $url
        $this->params = $url ? array_values($url) : [];

        // Вызываем нужный метод контроллера с нужными параметрами
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parse url by /
     *
     * @return array
     */
    public function parseUrl()
    {
        return $url = explode('/', $_SERVER['REQUEST_URI']);
    }

}