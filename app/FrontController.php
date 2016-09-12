<?php

/**
 * Class FrontController
 *
 * Create controller and call it methods
 *
 * @author Phrlog <phrlog@gmail.com>
 */
class FrontController
{

    public $method = 'index';

    /**
     * FrontController constructor.
     *
     * @param boolean $mode if true development mode, else production
     */
    public function __construct($mode)
    {
        if ($mode === true) {
            ini_set("display_errors", 1);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 'Off');
        }
    }

    public function start()
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