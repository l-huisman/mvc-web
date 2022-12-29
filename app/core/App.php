<?php
class App
{
    # Default controller, method and parameters
    protected $controller = 'home';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        # Get the url
        $url = $this->parseUrl();

        # Check if the $url has data in it
        if (isset($url[0])) {

            # Check for first part of url which is the controller
            if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            }

            # Check for second part of url which is the method
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
        }

        # Require the controller and create an instance
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        # Check for third part of url which is the parameters to pass to the method if not return an empty array
        $this->params = $url ? array_values($url) : [];

        # Call the method and pass the parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        # Get the requested URI
        $uri = $_SERVER['REQUEST_URI'];

        # Sanitize the URI and return an array
        $url_parts = explode('/', filter_var(rtrim($uri, '/'), FILTER_SANITIZE_URL));

        # Remove the first element of the array
        $url_parts = array_values($url_parts);

        return array_slice($url_parts, 1);
    }
}
