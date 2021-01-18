<?php

namespace App;

class Connection {

	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=localhost;dbname=gerenciador_tarefas;charset=utf8",
				"root",
				"lu231997" 
			);

			return $conn;

		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>