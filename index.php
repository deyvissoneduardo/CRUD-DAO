<?php

require_once("./config.php");

$user = new Usuario();
$user->loadById(2);
echo $user;
echo '-----------------------------------';
$lista = Usuario::getList();
echo json_encode($lista);
echo '-----------------------------------';
$busca = Usuario::search("te");
echo json_encode($busca);
echo '-----------------------------------';
$user->login("dudu", "123");
echo $user;


