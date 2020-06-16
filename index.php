<?php

require_once("config.php");

$sql = new Sql();

$usuario = $sql->select("SELECT * FROM usuario");

echo $sql;
