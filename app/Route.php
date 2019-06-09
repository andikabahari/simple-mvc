<?php

/**
 * Route Class
 *
 * @author Andika Bahari
 * @license MIT License
 */
class Route
{

  /**
   * @var string
   */
  public $ruri;

  /**
   * @var string
   */
  public $method;

  /**
   * @var string
   */
  public $baseURL;

  /**
   * @var string
   */
  public $segment;

  /**
   * @var string
   */
  public $route;

  /**
   * @var array
   */
  public $controllers = [];

  /**
   * @var array
   */
  public $routes = [];

  /**
   * @var array
   */
  public $getRoutes = [];

  /**
   * @var array
   */
  public $postRoutes = [];

  /**
   * @var array
   */
  public $getActions = [];

  /**
   * @var array
   */
  public $postActions = [];

  public function __construct(array $config)
  {
    $this->baseURL = $config['base_url'];
    $this->controllers = $config['controllers'];
    $this->routes = $config['routes'];
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->ruri = $_SERVER['REQUEST_URI'];
    $this->segment = str_replace('/index.php', '', str_replace(explode('/', str_replace(['http://', 'https://'], '', rtrim($this->baseURL, '/'))), '', ltrim($this->ruri, '/')));
    $this->segment = preg_replace('/\?(.*)?/', '', $this->segment);
    $this->route = preg_replace('/\/([a-zA-Z0-9\/_-]+)/', rtrim($this->segment, '/'), $this->segment);
  }

  /**
   * @param string $route
   * @param array $action
   * @return array
   */
  public function get(string $route, array $action): array
  {
    array_push($this->getRoutes, $route);
    array_push($this->getActions, [
      'route' => $route,
      'action' => $action
    ]);

    return [
      'route' => $route,
      'action' => $action
    ];
  }

  /**
   * @param string $route
   * @param array $action
   * @return array
   */
  public function post(string $route, array $action): array
  {
    array_push($this->postRoutes, $route);
    array_push($this->postActions, [
      'route' => $route,
      'action' => $action
    ]);

    return [
      'route' => $route,
      'action' => $action
    ];
  }

  /**
   * @return void
   */
  public function route(): void
  {
    try
    {
      $this->run();
    }
    catch (RouteException $e)
    {
      echo '[route error] '.$e;
    }
    catch(Exception $e)
    {
      echo '[unexpected error] '.$e;
    }
  }

  /**
   * @throws RouteException
   * @return void
   */
  private function run(): void
  {
    if (in_array($this->route, $this->{strtolower($this->method).'Routes'}))
    {
      $success = false;

      foreach ($this->{strtolower($this->method).'Actions'} as $action)
      {
        if ($action['route'] == $this->route)
        {
          $success = $this->check($action['route'], $action['action']);
          $controller = key($action['action']);
          $method = $action['action'][$controller];
        }
      }

      if ( ! $success)
      {
        throw new RouteException('Page not found!');
      }

      $this->call($controller, $method);
    }
    else
    {
      throw new RouteException('Page not found!');
    }
  }

  /**
   * @param string $route
   * @param array $action
   * @return bool
   */
  private function check(string $route, array $action): bool
  {
    if ($this->route == $route)
    {
      $controller = key($action);
      $method = $action[$controller];

      if (array_key_exists($controller, $this->controllers)  &&
          in_array($method, $this->controllers[$controller]) &&
          in_array($route, $this->routes))
      {
        return true;
      }
    }

    return false;
  }

  /**
   * @param string $controller
   * @param string $method
   * @return void
   */
  private function call(string $controller, string $method): void
  {
    require_once CONTROLLER_PATH.$controller.'.php';

    $controller = new $controller();
    $controller->{$method}();
  }
}
