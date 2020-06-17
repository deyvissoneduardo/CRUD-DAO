<?php

class Usuario{
    
    private $id;
    private $login;
    private $senha;
    private $dtCadastro;
    
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

      /**
     * Get the value of dtCadastro
     */ 
    public function getDtCadastro()
    {
        return $this->dtCadastro;
    }

    /**
     * Set the value of dtCadastro
     *
     * @return  self
     */ 
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;

        return $this;
    }

    /* 
    *  carrega dados do banco pelo 
    * id selecionado
    */
    public function loadById($id){

        $sql = new Sql(); // conexao com banco

        // executa query
        $result = $sql->select("SELECT * FROM usuario WHERE id = :ID", array(
            ":ID" => $id
        ));
        
        //valida id carregado
        if(count($result) > 0){
            //caso id valido carrega dados
            $this->setData($result[0]);
        }
    }

    /*
    * Lista todo usuarios da tabale
    */
    public static function getList(){

        $sql = new Sql(); // conexao com banco
        
        // executa query
        return $sql->select("SELECT * FROM usuario");

    }

    /*
    * busca por LIKE
    */ 
    public static function search($login){

        $sql = new Sql(); // conexao com banco

        return $sql->select("SELECT * FROM usuario WHERE login :SEARCH", array(
            ':SEARCH' => "%.$login.%"
        ));
    }


    /*
    * Atutentica usurio 
    */ 
    public function login($login, $passoword){

        $sql = new Sql(); // conexao com banco

        // executa query
        $result = $sql->select("SELECT * FROM usuario WHERE login = :LOGIN AND senha - :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $passoword
        ));
        
         if(count($result) > 0){
            $this->setData($result[0]);
        }else {
            throw new Exception("Login/Senha invalido", 1);
            
        }

    }
    public function setData($data){
        $this->setId($data['id']);     
        $this->setLogin($data['login']);
        $this->setSenha($data['senha']);
        $this->setDtCadastro(new DateTime($data['dtCadastro']));
    }


    /*
    * insert ao banco
    */
    public function insert(){

        $sql = new Sql(); // conexao com banco

        $result = $sql->select("CALL sp_usuario_insert(:LOGIN, :PASSWORD)", array(
            ":LOGIN" => $this->getLogin(),
            ":PASSWORD" => $this->getSenha()
        ));

        if(count($result) > 0) {
            $this->setData($result[0]);
        }
    }

    /*
    * insert com construtor
    */ 
    public function __construct($login = "", $password = ""){

        $this->setLogin($login);
		$this->setSenha($password);

    }
    
    /* 
    * update 
    */
    public function update($login, $passoword){
        // campos que pode atulizar
        $this->setLogin($login);
        $this->setSenha($passoword);

        $sql = new Sql(); // conexao com banco

        $sql->query("UPDATE usuario SET login = :LOGIN, senha = :PASSWORD WHERE id = :ID", array(
            ":LOGIN" => $this->getLogin(),
            ":PASSWORD" => $this->getSenha(),
            ":ID" => $this->getId()
        ));
    }

    /* 
    * method de exclusao
    */
    public function delete(){

        $sql = new Sql(); // conexao com banco

        // apago do banco
        $sql->query("DELETE FROM usuario WHERE id = :ID", array(
            ":ID" => $this->getId()
        ));

        // apaga da memoria do objeto
        $this->setId(0);
		$this->setLogin("");
		$this->setSenha("");
		$this->setDtcadastro(new DateTime());
    }

    public function __toString(){
        
        return json_encode(array(
            "id" => $this->getId(),
            "login" => $this->getLogin(),
            "senha" => $this->getSenha(),
            "dtCadastro" => $this->getDtCadastro()->fomart('d/M/Y')
        ));
    }
  
}