<?php

class Controller
{
    /**
     *
     * @var Zend_View
     */
    protected $_view;

    public function  __construct()
    {
        
    }
    /**
     *
     * @param array $params
     */
    public function run()
    {
        $oper = null;
        if ($this->getParam('oper') !== null) {
            $oper = $this->getParam('oper');
        }

        if ($this->getPost('oper') !== null && $oper == null) {
            $oper = $this->getPost('oper');
        }

        if ($oper === null) {
            $oper = 'index';
        }

        if ($oper !== null) {
            if (method_exists($this, $oper)) {
                echo call_user_func(array($this, $oper));
            }
        }
    }

    /**
     *
     * @param string $key
     * @return mixed
     */
    public function getParam($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
        return null;
    }

    /**
     *
     * @param string $key
     * @return mixed
     */
    public function getPost($key = null)
    {
        if ($key !== null) {
            if (isset($_POST[$key])) {
                return $_POST[$key];
            }
            return null;
        } else {
            return $_POST;
        }
    }

    /**
     *
     * @return array
     */
    public function  getParams()
    {
        return $_GET;
    }
}
