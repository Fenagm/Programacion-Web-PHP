<?php
require_once("../secciones/config.php");
session_destroy();

header("Location:../index.php");