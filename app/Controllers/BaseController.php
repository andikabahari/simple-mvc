<?php

require_once MODEL_PATH.'Model.php';

/**
 * BaseController
 *
 * @author Andika Bahari
 * @license MIT License
 */
class BaseController
{

  public function home()
  {
    $games = Model::games();
    require_once VIEW_PATH.'home.php';
  }

  public function contact()
  {
    require_once VIEW_PATH.'contact.php';
  }
}
