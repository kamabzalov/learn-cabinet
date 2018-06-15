<?php
/**
 * Класс конфигурации базы данных
 */
class DB
{

    const USER  = "codetoge_cabinet";
    const PASS  = "d~#P-,k+}8U&";
    const HOST  = "localhost";
    const DB    = "codetoge_cabinet";

    public static function connToDB() {
        $user   = self::USER;
        $pass   = self::PASS;
        $host   = self::HOST;
        $db     = self::DB;
        $conn   = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
        $conn->exec("SET NAMES 'utf8'");
        return $conn;
    }

}
