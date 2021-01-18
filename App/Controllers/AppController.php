<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

    public function tarefas(){
        session_start();

        if($_SESSION['id'] !='' && $_SESSION['nome'] !=''){

            $tarefa = Container::getModel('Tarefa');

            $tarefa->__set('id_responsavel',$_SESSION['id']);

            $tarefas = $tarefa->getAll();

            $this->view->tarefas = $tarefas;

            $this->render('tarefas');
        }else{
            header('Location: /?login=erro');
        }
    }

    public function cadastrar_tarefa(){
        session_start();

        if($_SESSION['id'] !='' && $_SESSION['nome'] !=''){

            $this->render('cadastrar_tarefa');

        }else{
            header('Location: /?login=erro');
        }
    }

    public function cadastro_tarefa(){
        session_start();

        if($_SESSION['id'] !='' && $_SESSION['nome'] !=''){

            $tarefa = Container::getModel('Tarefa');

            $tarefa->__set('descricao',$_POST['descricao']);
            $tarefa->__set('tipo',$_POST['tipo']);
            $tarefa->__set('status',$_POST['status']);
            $tarefa->__set('data_inicio',($_POST['data_inicio'] !='' ? date('Y-m-d', strtotime(str_replace("/", "-", $_POST["data_inicio"]))) : '0000-00-00'));
            $tarefa->__set('data_conclusao',($_POST['data_conclusao'] !='' ? date('Y-m-d', strtotime(str_replace("/", "-", $_POST["data_conclusao"]))) : '0000-00-00'));
            $tarefa->__set('id_responsavel',$_SESSION['id']);

            $tarefa->insertTarefa();

            $tarefas = $tarefa->getAll();

            $this->view->tarefas = $tarefas;

            $this->render('tarefas');

        }else{
            header('Location: /?login=erro');
        }
    }

    public function alterar_tarefa(){
        session_start();

        if($_SESSION['id'] !='' && $_SESSION['nome'] !=''){

            $tarefa = Container::getModel('Tarefa');

            $dados = $tarefa->getOne($_GET['id']);

            $this->view->tarefa = $dados;

            $this->render('alterar_tarefa');

        }else{
            header('Location: /?login=erro');
        }
    }

    public function alteracao_tarefa(){
        session_start();

        if($_SESSION['id'] !='' && $_SESSION['nome'] !=''){

            $tarefa = Container::getModel('Tarefa');

            $tarefa->__set('id',$_POST['id_tarefa']);
            $tarefa->__set('descricao',$_POST['descricao']);
            $tarefa->__set('tipo',$_POST['tipo']);
            $tarefa->__set('status',$_POST['status']);
            $tarefa->__set('data_inicio',($_POST['data_inicio'] !='' ? date('Y-m-d', strtotime(str_replace("/", "-", $_POST["data_inicio"]))) : '0000-00-00'));
            $tarefa->__set('data_conclusao',($_POST['data_conclusao'] !='' ? date('Y-m-d', strtotime(str_replace("/", "-", $_POST["data_conclusao"]))) : '0000-00-00'));

            $tarefa->updateTarefa();

            $tarefa->__set('id_responsavel',$_SESSION['id']);

            $tarefas = $tarefa->getAll();

            $this->view->tarefas = $tarefas;

            $this->render('tarefas');

        }else{
            header('Location: /?login=erro');
        }
    }

    public function excluir_tarefa(){
        session_start();

        if($_SESSION['id'] !='' && $_SESSION['nome'] !=''){

            $tarefa = Container::getModel('Tarefa');

            $tarefa->deleteTarefa($_GET['id']);

            $tarefa->__set('id_responsavel',$_SESSION['id']);

            $tarefas = $tarefa->getAll();

            $this->view->tarefas = $tarefas;

            $this->render('tarefas');

        }else{
            header('Location: /?login=erro');
        }
    }
}

?>