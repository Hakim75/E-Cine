<?php
class Objects {
	private $id;
	private $table;
	private $fields;
	private $pkField;

	public function __construct()
	{

	}


	public function load($id, $table)
	{
		global $db;

		$this->fieldsNames = array();

		$this->id 	= (int)$id;

		$this->table = $table;

		$this->fields = $db->sqlFields($this->table);

		$this->pkField = $this->fields[0];

		$data = $db->sqlSingleResult("SELECT *
											FROM $table
											WHERE {$this->pkField} = {$this->id}");

		foreach($this->fields as $field) {
			@$this->{$field} = $data->{$field};
		}

		return $this;
	}

	public function save() {
		global $db;

		$params = array();
		$champs = array();

		foreach($this->fields as $field) {
			if($field != $this->pkField) {
				$valeur = $this->{$field};

				if($valeur == 'CURDATE()' || $valeur == 'NOW()' || strpos($valeur,'STR_TO_DATE') !== false) {
					$champs[] = "`".$field."` = {$valeur}";
				}
				else {
					$champs[] = "`".$field."` = ?";
					$params[$field] = $valeur;
				}
			}
		}

		$liste_champs = implode(',', $champs);

		$db->sqlSimpleQuery("UPDATE {$this->table} SET $liste_champs WHERE {$this->pkField} = {$this->id}", $params);

		return true;
	}

	public function insert($table, $data, $return = 'object') {
		global $db;

		$params 	= array();
		$donnees 	= array();

		$this->table = $table;

		$this->fields = $db->sqlFields($this->table);

		$this->pkField = $this->fields[0];

		$result = $db->sqlSingleResult("SELECT IFNULL(MAX(".$this->pkField."),0)+1 AS newId FROM {$this->table}");
			$this->id = $result->newId;

		foreach($data as $colonne => $valeur) {
			if(in_array($colonne, $this->fields)) {
				if($valeur == 'CURDATE()' || $valeur == 'NOW()' || strpos($valeur,'STR_TO_DATE') !== false) {
					$champs[] 	= "`".$colonne."`";
					$donnees[]	= $valeur;
				}
				else {
					$champs[] 	= "`".$colonne."`";
					$donnees[]	= '?';
					//array_push($params, array($colonne => $valeur));
					$params[$colonne] = $valeur;
				}

				$this->{$colonne} = $valeur;
			}
		}

		$liste_champs		= implode(',', $champs);
		$liste_donnees 	= implode(',', $donnees);

		$db->sqlSimpleQuery("INSERT INTO {$this->table}($liste_champs) VALUES($liste_donnees)", $params);

		if($return == 'object')
		{
			return $this;
		}
		elseif($return == 'id')
		{
			return $this->id;
		}
		else
		{
			return false;
		}
	}

	public static function objectsList($table, $where = NULL, $params = NULL, $tri = 1, $sens = 'ASC', $limit = NULL) {
		global $db;

		$query = "SELECT * FROM $table ";
		if(!is_null($where)) {
			$query .= "WHERE $where ";
		}
		$query .= "ORDER BY $tri $sens ";
		if(!is_null($limit)) {
			$query .= "LIMIT $limit ";
		}

		$data = $db->sqlManyResults($query, $params);

		return $data;
	}


}
?>
