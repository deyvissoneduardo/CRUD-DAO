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
            $row = $result[0];
            
            //caso id valido carrega dados
            $this->setId($row['id']);     
            $this->setLogin($row['login']);
            $this->setSenha($row['senha']);
            $this->setDtCadastro(new DateTime($row['dtCadastro']));

        }
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