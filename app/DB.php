<?php

/**
 * DB Class
 *
 * @author Andika Bahari
 * @license MIT License
 */
class DB
{

  private static $dbname = '';
  private static $dbuser = 'root';
  private static $dbpass = '';
  private static $dbhost = 'localhost';

  public static function getInstance()
  {
    $dsn = 'mysql:host='.self::$dbhost.';dbname='.self::$dbname;

    $opt = [
      \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
      \PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try
    {
      return new \PDO($dsn, self::$dbuser, self::$dbpass, $opt);
    }
    catch (\PDOException $e)
    {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
  }
}
