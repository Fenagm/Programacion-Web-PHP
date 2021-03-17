<?php
session_start();
ini_set("display_errors",1);
  error_reporting(E_ALL);

date_default_timezone_set("America/Argentina/Buenos_Aires");


$config = $_SERVER["HTTP_HOST"] == "localhost" ? parse_ini_file(__DIR__."/../desarrollo.ini",true) : parse_ini_file(__DIR__."/../produccion.ini",true);

define("RUTA_USERS", __DIR__ . "/../" . $config["USERS"]["ruta_users"]);