<?php

namespace Core;
class View
{
    protected $_head, $_body, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout = DEFAULT_LAYOUT;

    /**
     * View constructor.
     */
    public function __construct() {}

    /**
     * Including necessary views
     * @param string $viewName
     * @return void
     */
    public function render($viewName)
    {
        $viewAry = explode('/', $viewName);
        $viewString = implode(DS, $viewAry);
        if (file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php')) {
            include(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php');
            include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout . '.php');
        } else {
            die('The view ' . $viewName . ' does not exist');
        }
    }

    /**
     * Checking where is content
     * @param string $type
     * @return bool|$_head|$_body
     */
    public function content($type)
    {
        if ($type == 'head') {
            return $this->_head;
        } else if ($type == 'body') {
            return $this->_body;
        }
        return false;
    }

    /**
     * Starting to write content to buffer
     * @param string $type
     * @return void
     */
    public function start($type)
    {
        $this->_outputBuffer = $type;
        ob_start();
    }

    /**
     * Stop buffering, writing is done
     * @return void
     */
    public function end()
    {
        if ($this->_outputBuffer == 'head') {
            $this->_head = ob_get_clean();
        } else if ($this->_outputBuffer == 'body') {
            $this->_body = ob_get_clean();
        } else {
            die('You must first run the start method');
        }
    }

    /**
     * Get Title
     * @return string
     */
    public function siteTitle()
    {
        return $this->_siteTitle;
    }

    /**
     * Set title
     * @param string $title
     * @return void
     */
    public function setSiteTitle($title)
    {
        $this->_siteTitle = $title;
    }

    /**
     * @param string $path
     * @return void
     */
    public function setLayout($path)
    {
        $this->_layout = $path;
    }

    /**
     * Include $path from views
     * @param string $path
     * @return void
     */
    public function insert($path)
    {
        include ROOT . DS . 'app' . DS . 'views' . DS . $path . '.php';
    }

    /**
     * Include $partial from partials
     * @param string $group
     * @param string $partial
     */
    public function partial($group,$partial)
    {
        include ROOT . DS . 'app' . DS . 'views' . DS . $group . DS . 'partials' . DS . $partial . '.php';
    }
}
