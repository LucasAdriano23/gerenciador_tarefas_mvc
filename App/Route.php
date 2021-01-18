<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['inscreverse'] = array(
			'route' => '/cadastrar',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar_usuario'] = array(
			'route' => '/registrar_usuario',
			'controller' => 'indexController',
			'action' => 'registrar_usuario'
		);

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);

		$routes['tarefas'] = array(
			'route' => '/tarefas',
			'controller' => 'AppController',
			'action' => 'tarefas'
		);

		$routes['cadastrar_tarefa'] = array(
			'route' => '/cadastrar_tarefa',
			'controller' => 'AppController',
			'action' => 'cadastrar_tarefa'
		);

		$routes['cadastro_tarefa'] = array(
			'route' => '/cadastro_tarefa',
			'controller' => 'AppController',
			'action' => 'cadastro_tarefa'
		);

		$routes['alterar_tarefa'] = array(
			'route' => '/alterar_tarefa',
			'controller' => 'AppController',
			'action' => 'alterar_tarefa'
		);

		$routes['alteracao_tarefa'] = array(
			'route' => '/alteracao_tarefa',
			'controller' => 'AppController',
			'action' => 'alteracao_tarefa'
		);

		$routes['excluir_tarefa'] = array(
			'route' => '/excluir_tarefa',
			'controller' => 'AppController',
			'action' => 'excluir_tarefa'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'logout'
		);

		$this->setRoutes($routes);
	}

}

?>