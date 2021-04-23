<?php

	namespace bpsmartdesignMedecinApp\Table;
	use \Core\Table\Table;

	class PersonnelTable extends Table{

		public function allByFonction($function) {

			return $this->query('
					SELECT *
					FROM '.$this->table.'
					WHERE fonction = ?
				',[$function]);
		}

	}
?>