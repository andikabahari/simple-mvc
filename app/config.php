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
