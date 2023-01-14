<?php
class Session
{
    public function start()
    {
        session_start();
    }
    public function stop()
    {
        session_destroy();
    }
    public function isStarted()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }
    public function get($name)
    {
        return isset($_SESSION[$name]);
    }
    public function remove($name)
    {
        unset($_SESSION[$name]);
    }
}
