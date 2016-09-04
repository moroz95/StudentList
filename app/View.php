<?php
/**
 * Class View
 *
 * Render pages
 *
 * @author Phrlog <phrlog@gmail.com>
 */
class View
{
    const VIEWS_BASEDIR = "../templates/";
    /**
     * @param string $template template name
     * @param array  $params   parameters
     * @return string
     */
    protected function fetchPartial($template, $params = array()){
        extract($params);
        ob_start();
        include self::VIEWS_BASEDIR.$template.'.php';
        return ob_get_clean();
    }
    /**
     * @param string $template template name
     * @param array  $params   parameters
     */
    public function renderPartial($template, $params = array()){
        echo $this->fetchPartial($template, $params);
    }
    /**
     * @param string $template template name
     * @param array  $params   parameters
     * 
     * @return string
     */
    protected function fetch($template, $params = array()){
        $content = $this->fetchPartial($template, $params);
        return $this->fetchPartial('main', array('content' => $content, 'url_template' => $params['url_template']));
    }
    /**
     * @param string $template template name
     * @param array  $params   parameters
     */
    public function render($template, $params = array()){
        echo $this->fetch($template, $params);
    }
}