<?php

	namespace bpsmartdesignMedecinApp\Table;
	use \Core\Table\Table;

	class DetteTable extends Table{

		public function findClient($id) {

			return $this->query('

					SELECT *
					FROM '.$this->table.'
					WHERE id_client = ?
				', [$id]);
		}

	}
?>