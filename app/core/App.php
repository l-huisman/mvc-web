<?php
class App{

    protected $controller = 'home';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        
        # Check for first part of url which is the controller
        if(file_exists('../app/controllers/' . $url[0] . '.php'))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }

        # Require the controller and create an instance
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;


        # Check for second part of url which is the method
        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        # Check for third part of url which is the parameters to pass to the method if not return an empty array
        $this -> params = $url ? array_values($url) : [];

        # Call the method and pass the parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl(){
        if(isset($_GET['url']))
        {
            echo $_GET['url'];
            # Sanitize the url and return an array
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return ['home', 'index'];
    }
}