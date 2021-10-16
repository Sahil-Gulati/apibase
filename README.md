# apibase
Utility for creating light weight API's


### usage
composer require sahil-gulati/apibase

#### example
```php

<?php

require_once 'vendor/autoload.php';

# Register routes
APIBase\URL\Router::registerRoutes("/api/v1", array(
    array(
        METHOD => "GET",
        ROUTE => "/payments",
        HANDLER => array("X", "a")
    )
));

# Process request
APIBase\URL\Invoker::processRequest();
```
