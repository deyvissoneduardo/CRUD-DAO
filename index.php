<?php

require_once("./config.php");
// Carrega Usuario
$user = new Usuario();
$user->loadById(2);
echo $user;
echo '-----------------------------------';
echo '-----------------------------------';
// Carrega lista de Usuario
$lista = Usuario::getList();
echo json_encode($lista);
echo '-----------------------------------';
echo '-----------------------------------';
// Carrega pesquisa na lista de Usuario 
$busca = Usuario::search("te");
echo json_encode($busca);
echo '-----------------------------------';
echo '-----------------------------------';
// Valida Usuario por login e senha 
$user->login("dudu", "123");
echo $user;
echo '-----------------------------------';
echo '-----------------------------------';
// Cria Usuario
$user->setLogin("Eduardo");
$user->setSenha("951");
$user->insert();
echo '-----------------------------------';
echo '-----------------------------------';
// Cria Usuario pelo construtor
$user = new Usuario("teste2", "7523");
$user->insert();
echo '-----------------------------------';
echo '-----------------------------------';
// Atualiza Usuario
$user->loadById(3);
$user->update("atualizado", "852");
echo $user;

