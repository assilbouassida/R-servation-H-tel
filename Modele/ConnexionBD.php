<?php

if (!class_exists('ConnexionBD')) {
    if (!defined('DBHOST')) {
        define("DBHOST", "localhost");
    }
    if (!defined('DBUSER')) {
        define("DBUSER", "root");
    }
    if (!defined('DBPASS')) {
        define("DBPASS", "");
    }
    if (!defined('DBNAME')) {
        define("DBNAME", "hotel2");
    }

    class ConnexionBD {
        private static $con = null;

        public static function getInstance() {
            if (!self::$con) {
                $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

                try {
                    self::$con = new PDO($dsn, DBUSER, DBPASS);
                    self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die('Erreur : ' . $e->getMessage());
                }
            }
            return self::$con;
        }
    }
}
?>
