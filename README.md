# simple-mvc

A simple Model-View-Controller

## Configuration

Setup the configuration for your site url, controllers, and routes.

File is located at ./app/config.php

```php
<?php

// This is your site url
$config['base_url'] = 'http://localhost/simple-mvc/';

// These are controllers and their methods
$config['controllers'] = [
  'BaseController' => ['home', 'contact']
];

// These are page routes
$config['routes'] = [
  '/',
  '/home',
  '/contact'
];
```

## Routing

Setup the page route and specify the method of the controller.

File is located at ./index.php

```php
$route->get('/', ['BaseController' => 'home']);
$route->get('/home', ['BaseController' => 'home']);
$route->get('/contact', ['BaseController' => 'contact']);
```
