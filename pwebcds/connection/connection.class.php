<?php
   
  class Connection {
   
      public static $instance;
   
      private function __construct() {
          //
      }
   
      public static function getInstance() {
          if (!isset(self::$instance)) {
              self::$instance = new PDO('mysql:host='.HOSTNAME.';dbname='.DBNAME,DBUSER,DBPASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
              self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
   
          return self::$instance;
      }
   
  }
?>