<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model {
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }

    public function salvar_usuario(){
        $sql = "INSERT INTO tb_usuarios(nome, email, senha,data_cadastro) VALUES(:nome, :email, :senha, CURDATE())";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome',$this->__get('nome'));
        $stmt->bindValue(':email',$this->__get('email'));
        $stmt->bindValue(':senha',$this->__get('senha'));
        $stmt->execute();

        return $this;

    }

    public function deleteUsuario($id){
        $sql = "DELETE FROM tb_usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();

        return true;
    }

    public function validar_cadastro_usuario(){
        $valido = true;

        if(strlen($this->__get('nome')) < 3 ){
            $valido = false;
        }

        if(strlen($this->__get('email')) < 3){
            $valido = false;
        }

        if(strlen($this->__get('senha')) < 3){
            $valido = false;
        }

        return $valido;
    }

    public function getUsuarioPorEmail(){
		$sql = "SELECT nome,email FROM tb_usuarios WHERE email = :email";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':email',$this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);	

    }
    
    public function autenticar(){
        $sql = "SELECT id, nome, email FROM tb_usuarios WHERE email = :email AND senha = :senha";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue('email',$this->__get('email'));
        $stmt->bindValue('senha',$this->__get('senha'));
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if($usuario['id'] !='' && $usuario['nome'] !=''){   
            $this->__set('id',$usuario['id']);
            $this->__set('nome',$usuario['nome']);
        }
        
        return $this;

    }

}
?>