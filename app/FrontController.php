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

        $controller = new Controller();

        if (isset($url[1])) {
            if (method_exists($controller, $url[1])) {
                $this->method = $url[1];
            } elseif ($url[1]!=="") {
                $this->method = 'notFound';
            }
        }
        call_user_func([$controller,  $this->method]);
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