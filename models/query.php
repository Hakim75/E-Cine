<?php
class Query {

	public $cnx;
	public $stmt;

	public function __construct()
	{
		try {
			$this->cnx = new PDO(BDD_SGBD.':host='.BDD_HOST.';dbname='.BDD_DATABASE,BDD_USER,BDD_PASSWORD,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
		catch(Exception $e) {
			trigger_error($e->getMessage(),E_USER_ERROR);
		}

		return true;
	}

	public function __destruct()
	{

	}

	public function bindPrepare($params)
	{
		/*
		prefixe sur trois lettres suivi d'un underscore
		$params = array(array('pfx_sName','value1'),
										array('pfx_iAge','value2'));
		*/
		$index = 1;

		if(!empty($params)) {
			foreach($params as $key => $val) {

				// on se base sur le 1er caractère du paramètre, après le préfixe, pour connaitre le type de données attendu
				$tabParam = explode('_',$key);
				$dataTypeCode = $tabParam[1][0];

				switch($dataTypeCode) {
					case 'i':
						$type = PDO::PARAM_INT;
						break;
					case 'b':
						$type = PDO::PARAM_BOOL;
						break;
					case 'n':
						$type = PDO::PARAM_NULL;
						break;
					case 'f':
						$type = PDO::PARAM_STR;
						break;
					case 's':
						$type = PDO::PARAM_STR;
						break;
					default:
						$type = PDO::PARAM_STR;
						break;
				}

				$this->stmt->bindValue($index, $val, $type);

				$index++;
			}
		}

		return true;
	}

	public function executeQuery($query, $params = array())
	{
		$this->stmt = $this->cnx->prepare($query);

		$this->bindPrepare($params);

		$this->stmt->execute();

		return true;
	}

	public function sqlManyResults($query, $params = array()) {
		$data = array();

		$this->executeQuery($query, $params);

		while($ligne = $this->stmt->fetch(PDO::FETCH_OBJ)) {
			$data[] = $ligne;
		}

		@$this->stmt->closeCursor();

		return $data;
	}

	public function sqlManyResultsArray($query, $params = array()) {
		$data = array();

		$this->executeQuery($query, $params);

		while($ligne = $this->stmt->fetch_assoc()) {
			$data[] = $ligne;
		}

		@$this->stmt->closeCursor();

		return $data;
	}

	public function sqlSingleResult($query, $params = array()) {
		$data = array();

		$this->executeQuery($query, $params);

		$data = @$this->stmt->fetch(PDO::FETCH_OBJ);

		@$this->stmt->closeCursor();

		return $data;
	}

	public function sqlFields($table) {
		$data = array();
		$champs = array();

		$data = $this->sqlManyResults("SHOW COLUMNS FROM $table");

		foreach($data as $field) {
			$champs[] = $field->Field;
		}

		return $champs;
	}


	public function sqlSimpleQuery($query, $params = array()) {
		$result = $this->executeQuery($query, $params);

		return $result;
	}

}
?>
