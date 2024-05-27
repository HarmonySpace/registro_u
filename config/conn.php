<?php
/* to GET the database connection */
class Connection
{
  private $host = 'localhost';
  private $dbname = 'registro_u';
  private $user = 'postgres';
  private $pass = '';
  private $port = '5432';
  private $driver = 'pgsql';
  private static $connection;

  private function __construct()
  {
  }

  public static function getConnection()
  {
    if (!self::$connection) {
      try {
        $connection = new self();
        self::$connection = new PDO($connection->driver . ":host=" . $connection->host . ";port=" . $connection->port . ";dbname=" . $connection->dbname, $connection->user, $connection->pass);
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
      }
    }
    return self::$connection;
    // try {
    //   $connection = new Connection();
    //   $connection->connect = new PDO("{$connection->driver}:host={$connection->host};port={$connection->port};dbname={$connection->dbname}", $connection->user . $connection->pass);
    //   //echo "connection established";
    //   $connection->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   return $connection->connect;
    // } catch (PDOException $e) {
    //   echo 'Error: ' . $e->getMessage();
    // }
  }
}
