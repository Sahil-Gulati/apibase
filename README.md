# apibase
Utility for creating light weight API's


### Installation
> composer require sahil-gulati/apibase

#### Example
```php

<?php

require_once 'vendor/autoload.php';

# Register routes
APIBase\URL\Router::registerRoutes("/api/v1", array(
    array(
        METHOD => "GET",
        ROUTE => "/payments",
        HANDLER => "helloWorld"
    )
));

# Process request
APIBase\URL\Invoker::processRequest();

function helloWorld(){
    echo json_encode(array("message" => "Hello from sahil!"));
}
```
