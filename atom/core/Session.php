<?php

namespace Core;
class Session
{
    /**
     * @param $name
     * @return bool
     */
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public static function uagent_no_version()
    {
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regx = '/\/[a-zA-Z0-9.]+/';
        $newString = preg_replace($regx, '', $uagent);
        return $newString;
    }

    /**
     * Adds a session alert message
     * @param string $type Can be info,success,warning or danger
     * @param string $msg The message you want to display and alert
     */
    public static function addMsg(string $type, string $msg)
    {
        $sessionName = 'alert-' . $type;
        self::set($sessionName, $msg);
    }

    public static function displayMessage()
    {
        $alerts = ['alert-info', 'alert-success', 'alert-warning', 'alert-danger'];
        $html = '';
        foreach ($alerts as $alert) {
            if (self::exists($alert)) {
                $html .= '<div class = "alert ' . $alert . ' alert-dismissable" role="alert">';
                $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                $html .= self::get($alert);
                $html .= '</div>';
                self::delete($alert);
            }
        }
        return $html;
    }
}
