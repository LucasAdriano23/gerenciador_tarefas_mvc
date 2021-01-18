<?php

namespace App\Models;

use MF\Model\Model;

class Tarefa extends Model {
    private $id;
    private $descricao;
    private $data_inicio;
    private $data_conclusao;
    private $tipo;
    private $status;
    private $id_responsavel;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }

    public function insertTarefa(){
        $sql = "INSERT INTO tb_tarefas (descricao, data_inicio, data_conclusao, tipo, status, id_responsavel,data_cadastro) VALUES (:descricao, :data_inicio, :data_conclusao, :tipo, :status, :id_responsavel,CURDATE())";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':descricao',$this->__get('descricao'));
        $stmt->bindValue(':data_inicio',$this->__get('data_inicio'));
        $stmt->bindValue(':data_conclusao',$this->__get('data_conclusao'));
        $stmt->bindValue(':tipo',$this->__get('tipo'));
        $stmt->bindValue(':status',$this->__get('status'));
        $stmt->bindValue(':id_responsavel',$this->__get('id_responsavel'));

        $stmt->execute();

        return true;

    }

    public function getAll(){
		$sql = "SELECT t.id,t.descricao,t.data_conclusao,t.data_inicio, t.status, t.tipo, u.nome as responsavel
        FROM tb_tarefas as t
        left join tb_usuarios as u on t.id_responsavel = u.id
        WHERE t.id_responsavel = :id_responsavel
        ORDER BY t.data_inicio ASC";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id_responsavel',$this->__get('id_responsavel'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOne($id){
		$sql = "SELECT t.id,t.descricao,t.data_conclusao,t.data_inicio, t.status, t.tipo, u.nome as responsavel
        FROM tb_tarefas as t
        left join tb_usuarios as u on t.id_responsavel = u.id
        WHERE t.id = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':id',$id);
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateTarefa(){
        $sql = "UPDATE tb_tarefas
        SET descricao=:descricao, data_inicio= :data_inicio, data_conclusao= :data_conclusao, tipo= :tipo, status= :status
        WHERE id=:id ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id',$this->__get('id'));
        $stmt->bindValue(':descricao',$this->__get('descricao'));
        $stmt->bindValue(':data_inicio',$this->__get('data_inicio'));
        $stmt->bindValue(':data_conclusao',$this->__get('data_conclusao'));
        $stmt->bindValue(':tipo',$this->__get('tipo'));
        $stmt->bindValue(':status',$this->__get('status'));

        $stmt->execute();

        return true;
    }

    public function deleteTarefa($id){
        $sql = "DELETE FROM tb_tarefas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();

        return true;
    }

}
?>