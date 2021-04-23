<?php

	namespace bpsmartdesignMedecinApp\Controller\Admin;


	class AdminController extends \bpsmartdesignMedecinApp\Controller\AppController {

		private function secureData($string) {

			if(ctype_digit($string)) {

				$string = intval($string);
			}else {

				//$string = mysql_real_escape_string($string);
				$string = addcslashes($string, '%');
			}

			return $string;
		}

		private function postControl() {

			if(empty($_POST)) {

				header('Location: index');
				die();
			}
		}

		private function setTitle() {

			$p = stripcslashes(htmlentities($_GET['p']));
			$p = explode('.', $p);
			return 'Démo Coif - '.ucfirst($p[3]).'s';
		}

		private function adminVerification($type = 'personnel') {

			if(!isset($_SESSION['bpsmartdesignMedecinLogToken'])) {

				header('Location: forbidden');
				die();
			}else {

				if($_SESSION['ç_exphairedegreeaoejmfalnfma'] != $type) {

					$superUsers = $this->loadModel('user')->find($_SESSION['id_lkjaldkafpoijdmfaexphair']);
					
					if($superUsers->niveau == 'patron') {
					
						$_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] = 99;
					}else {
						header('Location : '.$_SERVER['HTTP_REFERER']);
						die();
					}
				}else {
					
					if($_SESSION['ç_exphairedegreeaoejmfalnfma'] == 'personnel') {

						$_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] = 1;
					}elseif($_SESSION['ç_exphairedegreeaoejmfalnfma'] == 'patron') {

						$_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] = 99;
					}
				}
			}
		}

		public function controlLog() {
		    
			$username = $this->secureData(strtoupper($_POST['username'])); 
			$admin = $this->loadModel('user')->all();

			foreach($admin as $v) {

				if(strtoupper($v->username) == $username) {
					$_SESSION['id_lkjaldkafpoijdmfaexphair'] = $v->id;
				}
			}

			if(isset($_SESSION['id_lkjaldkafpoijdmfaexphair'])) {

				$actualUser = $this->loadModel('user')->find($_SESSION['id_lkjaldkafpoijdmfaexphair']);
				if(sha1(md5($this->secureData($_POST['password']))) == $actualUser->password) {
					$_SESSION['bpsmartdesignMedecinLogToken'] = $username;
					$_SESSION['ç_exphairedegreeaoejmfalnfma'] = $actualUser->niveau;
					$_SESSION['success'] = 'Welcome '.$username.' !';
					header('Location: index');
					die();
				}else {
					header('Location: '.$_SERVER['HTTP_REFERER']);
					die();
				}
			}else {
				header('Location: '.$_SERVER['HTTP_REFERER']);
				die();
			}
		}

		public function addElement() {

			$this->postControl();
			$this->adminVerification();
			
			$title = $this->setTitle();
			$table = $this->secureData($_POST['table']);
			$type = isset($_POST['type']) ? $this->secureData($_POST['type']) : null ;
			$form = new \Core\HTML\BootstrapForm;

			$this->render('admin.form.add'.ucfirst($table), compact('title', 'form', 'type'));
		}

		public function modElement() {

			$this->postControl();
			$this->adminVerification();
			
			$title = $this->setTitle();
			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$form = new \Core\HTML\BootstrapForm;

			$old = $this->loadModel($table)->find($id);

			$this->render('admin.form.add'.ucfirst($table), compact('title', 'form', 'old'));
		}

		public function sellElement() {

			$this->postControl();
			$this->adminVerification();
			
			$title = $this->setTitle();
			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$form = new \Core\HTML\BootstrapForm;

			$elt = $this->loadModel($table)->find($id);

			$this->render('admin.form.sell'.$table, compact('title', 'form', 'elt'));
		}

		public function buyElement() {

			$this->postControl();
			$this->adminVerification();
			
			$title = $this->setTitle();
			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$form = new \Core\HTML\BootstrapForm;

			$elt = $this->loadModel($table)->find($id);

			$this->render('admin.form.buy'.$table, compact('title', 'form', 'elt'));
		}

		public function delElement() {

			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$_SESSION['success'] = 'Element supprimé avec Succès !!!';			

			$this->loadModel($table)->delete($id);
			
			header('Location: '.$_SERVER['HTTP_REFERER']);
			die();
		}

		public function buyProduit() {

			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$nom = $this->secureData($_POST['nom']);
			$prix = $this->secureData($_POST['prix']);
			$_SESSION['success'] = 'Produit Acheté !!!';

			$this->loadModel('produit')->update($id, ['statut' => 1]);
			$this->loadModel('log')->create([
				'id_auteur' => $_SESSION['id_lkjaldkafpoijdmfaexphair'],
				'elt' => 'produit',
				'nom' => $nom,
				'action' => 'achat',
				'prix' => $prix,
				'qte' => 1,
				'date' => date('y/m/d'),
				'heure' => date('H:i:s')
			]);

			header('Location: '.$_SERVER['HTTP_REFERER']);
			die();
		}

		public function finirProduit() {

			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);

			$this->loadModel('produit')->update($id, ['statut' => 0]);

			header('Location: '.$_SERVER['HTTP_REFERER']);
			die();
		}

		public function payer() {

			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$personnel = $this->loadModel('personnel')->find($id);

			$nom = $personnel->nom_complet;
			$prix = $personnel->salaire;

			$this->loadModel($table)->update($id, ['salaire' => 0]);
			$this->loadModel('log')->create([
				'id_auteur' => $_SESSION['id_lkjaldkafpoijdmfaexphair'],
				'elt' => 'salaire',
				'nom' => $nom,
				'action' => 'achat',
				'prix' => $prix,
				'qte' => 1,
				'date' => date('y/m/d'),
				'heure' => date('H:i:s')
			]);

			$_SESSION['success'] = $personnel->nom_complet.' a été payé son salaire avec succès !';

			header('Location: '.$_SERVER['HTTP_REFERER']);
			die();
		}

		public function rembourserDette() {

			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$dette = $this->loadModel('dette')->find($id);
			$client = $this->loadModel('client')->find($dette->id_client);

			$nom = $client->nom_complet;
			$prix = $dette->montant;

			$this->loadModel($table)->delete($id);
			$this->loadModel('log')->create([
				'id_auteur' => $_SESSION['id_lkjaldkafpoijdmfaexphair'],
				'elt' => 'dette',
				'nom' => $nom,
				'action' => 'vente',
				'prix' => $prix,
				'qte' => 1,
				'date' => date('y/m/d'),
				'heure' => date('H:i:s')
			]);

			$_SESSION['success'] = 'La dette de '.$client->nom_complet.' a été payé avec succès !';

			header('Location: '.$_SERVER['HTTP_REFERER']);
			die();
		}

		public function virer() {

			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);

			$this->loadModel($table)->update($id, ['statut' => 0]);

			header('Location: '.$_SERVER['HTTP_REFERER']);
			die();
		}

		public function coiffer() {

			$title = $this->setTitle();

			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$type = $this->secureData($_POST['type']);
			$form = new \Core\HTML\BootstrapForm;

			$coiffure = $this->loadModel('coiffure')->find($id);
			$produits = $this->loadModel('produit')->all();
			$personnels = $this->loadModel('personnel')->all();
			$clients = $this->loadModel('client')->all();

			$this->render('admin.form.coiffer', compact('title', 'success', 'err', 'id', 'table', 'type', 'form', 'coiffure', 'produits', 'personnels', 'clients'));
		}

		public function esthetiquer() {

			$title = $this->setTitle();

			$table = $this->secureData($_POST['table']);
			$id = $this->secureData($_POST['id']);
			$form = new \Core\HTML\BootstrapForm;

			$coiffure = $this->loadModel('esthetique')->find($id);
			$produits = $this->loadModel('produit')->all();
			$personnels = $this->loadModel('personnel')->all();
			$clients = $this->loadModel('client')->all();

			$this->render('admin.form.coiffer', compact('title', 'success', 'err', 'id', 'table', 'form', 'coiffure', 'produits', 'personnels', 'clients'));
		}

		public function logout() {
			var_dump(header('Location : http://localhost/Workspace_/coif')); die();

			$this->postControl();
			$this->adminVerification();

			$title = $this->setTitle();
			
			unset($_SESSION['bpsmartdesignMedecinLogToken']);
			unset($_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf']);
			unset($_SESSION['ç_exphairedegreeaoejmfalnfma']);

			header('Location : http://localhost/Workspace_/coif');
			die();
			// $this->renderLogOut('admin.home.forbidden', compact('title'));
		}

		public function forbidden() {

			$title = $this->setTitle();

			$this->renderForbidden('admin.home.forbidden', compact('title'));
		}

		public function nofound() {

			$title = $this->setTitle();

			$this->renderForbidden('admin.home.nofound', compact('title'));
		}

		public function __controlElement() {

			$this->postControl();
			$this->adminVerification();

			if(!isset($_POST['table'])) {

				die('Tu as fais comment pour arriver ici?');
			}else {

				$table = $this->secureData($_POST['table']);
				
				if($table == 'coiffure') { // Coiffures
					if(!isset($_POST['action'])) {

						$nom = $this->secureData($_POST['nom']);
						$prix = $this->secureData($_POST['prix']);
						$description = $this->secureData($_POST['description']);
						$type = $this->secureData($_POST['type']);
						$nbr_coiffeur = $this->secureData($_POST['nbr_coiffeur']);
						$nbr_coiffeur = $this->secureData($_POST['nbr_coiffeur']);
						$nbr_produit = $this->secureData($_POST['nbr_produit']);
						$oldName = $this->secureData($_POST['oldName']);

						if(isset($_POST['modCoiffure'])) {

							if($nom != $oldName) {

								if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

									$_SESSION['err'] = 'Une Coiffure du même nom existe déjà dans la base de données !!!';
									
									header('Location: gestion_coiffure_'.$type);
									die();
								}
							}

							$this->loadModel($table)->update($_POST['id'], [
								'nbr_produit' => $nbr_produit,
								'nbr_coiffeur' => $nbr_coiffeur,
								'nom' => $nom,
								'prix' => $prix,
								'description' => $description,
								'type' => $type
								]);

							$_SESSION['success'] = 'La Coiffure '.$nom.' a été correctement modifié de la base de données';

							header('Location: gestion_coiffure_'.$type);
							die();
						}else {

							if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

								$_SESSION['err'] = 'Une Coiffure du même nom existe déjà dans la base de données !!!';
								
								header('Location: gestion_coiffure_'.$type);
								die();
							}

							$this->loadModel('coiffure')->create([
								'nbr_produit' => $nbr_produit,
								'nbr_coiffeur' => $nbr_coiffeur,
								'nom' => $nom,
								'prix' => $prix,
								'description' => $description,
								'type' => $type
								]);

							$_SESSION['success'] = 'La Coiffure '.$nom.' a été correctement ajouté à la base de données';

							header('Location: gestion_coiffure_'.$type);
							die();
						}
					}else {

						$url = $this->secureData($_POST['url']);
						$type_coiffure = isset($_POST['type']) ? $this->secureData($_POST['type']) : 'esthetique';
						$nom = $this->secureData($_POST['nom']);
						$prix = $this->secureData($_POST['prix']);
						$avance = $this->secureData($_POST['avance']);
						$reste = $this->secureData($_POST['reste']);
						$id_client = $this->secureData($_POST['id_client']);
						$nbr_coiffeur = $this->secureData($_POST['nbr_coiffeur']);

						$client = $this->loadModel('client')->find($id_client);
						
						$coiffeur_0 = isset($_POST['coiffeur_0']) ? $this->secureData($_POST['coiffeur_0']) : null;
						$coiffeur_1 = isset($_POST['coiffeur_1']) ? $this->secureData($_POST['coiffeur_1']) : null;
						$coiffeur_2 = isset($_POST['coiffeur_2']) ? $this->secureData($_POST['coiffeur_2']) : null;
						$coiffeur_3 = isset($_POST['coiffeur_3']) ? $this->secureData($_POST['coiffeur_3']) : null;

						if(isset($_POST['coiffeur_0'])) {

							$personnel = $this->loadModel('personnel')->find($coiffeur_0);
							$newSalaire = $personnel->salaire;
							$newSalaire += ($prix * 15) / 100;
							$this->loadModel('personnel')->update($coiffeur_0,['salaire' => $newSalaire]);
						}
						if(isset($coiffeur_1)) {

							$personnel = $this->loadModel('personnel')->find($coiffeur_1);
							$newSalaire = $personnel->salaire;
							$newSalaire += ($prix * 15) / 100;
							$this->loadModel('personnel')->update($coiffeur_1,['salaire' => $newSalaire]);
						}
						if(isset($coiffeur_2)) {

							$personnel = $this->loadModel('personnel')->find($coiffeur_2);
							$newSalaire = $personnel->salaire;
							$newSalaire += ($prix * 15) / 100;
							$this->loadModel('personnel')->update($coiffeur_2,['salaire' => $newSalaire]);
						}
						if(isset($coiffeur_3)) {

							$personnel = $this->loadModel('personnel')->find($coiffeur_3);
							$newSalaire = $personnel->salaire;
							$newSalaire += ($prix * 15) / 100;
							$this->loadModel('personnel')->update($coiffeur_3,['salaire' => $newSalaire]);
						}

						if($type_coiffure == 'esthetique') {
							$elt = 'esthetique';
						}else{
							$elt = 'coiffure_'.$type_coiffure;
						}

						$this->loadModel('log')->create([
							'id_auteur' => $_SESSION['id_lkjaldkafpoijdmfaexphair'],
							'elt' => $elt,
							'nom' => $nom,
							'action' => 'vente',
							'prix' => $avance,
							'qte' => 1,
							'date' => date('y/m/d'),
							'heure' => date('H:i:s')
						]);
						$this->loadModel('client')->update($id_client,[
							'nbr_coiffure' => $client->nbr_coiffure + 1,
							'depense' => $client->depense + $avance
						]);
						if($reste > 0) {

							$this->loadModel('dette')->create([
								'id_client' => $id_client,
								'montant' => $reste,
								'date' => date('y/m/d')
							]);
						}

						$_SESSION['success'] = 'Coiffure de '.$client->nom_complet.' enrégistrée avec succès';
						header('Location: '.$url);
						die();
					}
				}elseif($table == 'esthetique') { // Estétique

					$nom = $this->secureData($_POST['nom']);
					$prix = $this->secureData($_POST['prix']);
					$description = $this->secureData($_POST['description']);
					$nbr_coiffeur = $this->secureData($_POST['nbr_coiffeur']);
					$nbr_produit = $this->secureData($_POST['nbr_produit']);
					$oldName = $this->secureData($_POST['oldName']);

					if(isset($_POST['modEsthetique'])) {

						if($nom != $oldName) {

							if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

								$_SESSION['err'] = 'Un modèle du même nom existe déjà dans la base de données !!!';
								
								header('Location: gestion_esthetique');
								die();
							}
						}

						$this->loadModel($table)->update($_POST['id'], [
							'nbr_produit' => $nbr_produit,
							'nbr_coiffeur' => $nbr_coiffeur,
							'nom' => $nom,
							'description' => $description,
							'prix' => $prix
							]);

						$_SESSION['success'] = 'Le modèle '.$nom.' a été correctement modifié de la base de données';

						header('Location: gestion_esthetique');
						die();
					}else {

						if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

							$_SESSION['err'] = 'Un modèle du même nom existe déjà dans la base de données !!!';
							
							header('Location: gestion_esthetique');
							die();
						}

						$this->loadModel($table)->create([
							'nbr_produit' => $nbr_produit,
							'nbr_coiffeur' => $nbr_coiffeur,
							'nom' => $nom,
							'description' => $description,
							'prix' => $prix
							]);

						$_SESSION['success'] = 'Le modèle '.$nom.' a été correctement ajouté à la base de données';

						header('Location: gestion_esthetique');
						die();
					}
				}elseif($table == 'restauration') { // Restauration

					$nom = $this->secureData($_POST['nom']);
					$prix = $this->secureData($_POST['prix']);
					$description = $this->secureData($_POST['description']);
					$oldName = $this->secureData($_POST['oldName']);

					if(isset($_POST['modRestauration'])) {

						if($nom != $oldName) {

							if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

								$_SESSION['err'] = 'Un élément du même nom existe déjà dans la base de données !!!';
								
								header('Location: gestion_restauration');
								die();
							}
						}

						$this->loadModel($table)->update($_POST['id'], [
							'nom' => $nom,
							'description' => $description,
							'prix' => $prix
							]);

						$_SESSION['success'] = 'L\'élément '.$nom.' a été correctement modifié de la base de données';

						header('Location: gestion_restauration');
						die();
					}else {

						if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

							$_SESSION['err'] = 'Un élément du même nom existe déjà dans la base de données !!!';
							
							header('Location: gestion_restauration');
							die();
						}

						$this->loadModel($table)->create([
							'nom' => $nom,
							'description' => $description,
							'prix' => $prix
							]);

						$_SESSION['success'] = 'L\'élément '.$nom.' a été correctement ajouté à la base de données';

						header('Location: gestion_restauration');
						die();
					}
				}elseif($table == 'boisson') { // boissons
					
					$nom = $this->secureData($_POST['nom']);
					$prix_achat = $this->secureData($_POST['prix_achat']);
					$prix_vente = $this->secureData($_POST['prix_vente']);
					$qte = $this->secureData($_POST['qte']);
					$oldName = $this->secureData($_POST['oldName']);

					if(isset($_POST['modBoisson'])) {

						if($nom != $oldName) {

							if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

								$_SESSION['err'] = 'Une boisson du même nom existe déjà dans la base de données !!!';
								
								header('Location: gestion_bar');
								die();
							}
						}

						$this->loadModel($table)->update($_POST['id'], [
							'nom' => $nom,
							'prix_achat' => $prix_achat,
							'prix_vente' => $prix_vente,
							'qte' => $qte
							]);

						$_SESSION['success'] = 'La Boisson '.$nom.' a été correctement modifié de la base de données';

						header('Location: gestion_bar');
						die();
					}else {

						if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

							$_SESSION['err'] = 'Une boisson du même nom existe déjà dans la base de données !!!';
							
							header('Location: gestion_bar');
							die();
						}

						$this->loadModel('boisson')->create([
							'nom' => $nom,
							'prix_achat' => $prix_achat,
							'prix_vente' => $prix_vente,
							'qte' => $qte
							]);

						$_SESSION['success'] = 'La Boisson '.$nom.' a été correctement ajouté à la base de données';

						header('Location: gestion_bar');
						die();
					}
				}elseif($table == 'produit') { // produits
					
					$nom = $this->secureData($_POST['nom']);
					$description = $this->secureData($_POST['description']);
					$prix = $this->secureData($_POST['prix']);
					$oldName = $this->secureData($_POST['oldName']);

					if(isset($_POST['modProduit'])) {

						if($nom != $oldName) {

							if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

								$_SESSION['err'] = 'Un prduit du même nom existe déjà dans la base de données !!!';
								
								header('Location: gestion_produit');
								die();
							}
						}

						$this->loadModel($table)->update($_POST['id'], [
							'nom' => $nom,
							'description' => $description,
							'prix' => $prix,
							'date_achat' => date('y/m/d')
							]);

						$_SESSION['success'] = 'Le Produit '.$nom.' a été correctement modifié de la base de données';

						header('Location: gestion_produit');
						die();
					}else {

						if($this->loadModel($table)->already_exist($nom, 'nom') == '1') {

							$_SESSION['err'] = 'Un prduit du même nom existe déjà dans la base de données !!!';
							
							header('Location: gestion_produit');
							die();
						}

						$this->loadModel('produit')->create([
							'nom' => $nom,
							'description' => $description,
							'prix' => $prix,
							'date_achat' => date('y/m/d')
							]);

						$_SESSION['success'] = 'Le Produit '.$nom.' a été correctement ajouté à la base de données';

						header('Location: gestion_produit');
						die();
					}
				}elseif($table == 'fonction') { // Fonctions

					$designation = $this->secureData($_POST['designation']);
					$description = $this->secureData($_POST['description']);
					$salaire_de_base = $this->secureData($_POST['salaire_de_base']);
					$oldName = $this->secureData($_POST['oldName']);

					if(isset($_POST['modFonction'])) {

						if($designation != $oldName) {

							if($this->loadModel($table)->already_exist($designation, 'designation') == '1') {

								$_SESSION['err'] = 'Une fonction du même nom existe déjà dans la base de données !!!';
								
								header('Location: _fonction');
								die();
							}
						}

						$this->loadModel($table)->update($_POST['id'], [
							'designation' => $designation,
							'description' => $description,
							'salaire_de_base' => $salaire_de_base
							]);

						$_SESSION['success'] = 'La fonction '.$designation.' a été correctement modifié de la base de données';

						header('Location: _fonction');
						die();
					}else {

						if($this->loadModel($table)->already_exist($designation, 'designation') == '1') {

							$_SESSION['err'] = 'Une fonction du même nom existe déjà dans la base de données !!!';
							
							header('Location: _fonction');
							die();
						}

						// var_dump($designation); die();

						$this->loadModel($table)->create([
							'designation' => $designation,
							'description' => $description,
							'salaire_de_base' => $salaire_de_base
							]);

						$_SESSION['success'] = 'La fonction '.$designation.' a été correctement ajouté à la base de données';

						header('Location: _fonction');
						die();
					}
				}elseif($table == 'personnel') { // Personnel 

					$id_fonction_personnel = $this->secureData($_POST['id_fonction_personnel']);
					$nom_complet = $this->secureData($_POST['nom_complet']);
					$localisation = $this->secureData($_POST['localisation']);
					$contact = $this->secureData($_POST['contact']);
					$date_entree = $this->secureData($_POST['date_entree']);
					$oldName = $this->secureData($_POST['oldName']);

					$fonction = $this->loadModel('fonction')->find($id_fonction_personnel);
					$salaire_de_base = $fonction->salaire_de_base;

					if(isset($_POST['modPersonnel'])) {

						if($nom_complet != $oldName) {

							if($this->loadModel($table)->already_exist($nom_complet, 'nom_complet') == '1') {

								$_SESSION['err'] = 'Un employé du même nom existe déjà dans la base de données !!!';
								
								header('Location: _personnel');
								die();
							}
						}

						$this->loadModel($table)->update($_POST['id'], [
							'id_fonction_personnel' => $id_fonction_personnel,
							'nom_complet' => $nom_complet,
							'localisation' => $localisation,
							'contact' => $contact,
							'salaire' => $salaire_de_base,
							'date_entree' => $date_entree
							]);

						$_SESSION['success'] = 'L\'employé '.$nom_complet.' a été correctement modifié de la base de données';

						header('Location: _personnel');
						die();
					}else {

						if($this->loadModel($table)->already_exist($nom_complet, 'nom_complet') == '1') {

							$_SESSION['err'] = 'Un employé du même nom existe déjà dans la base de données !!!';
							
							header('Location: _personnel');
							die();
						}

						$this->loadModel($table)->create([
							'id_fonction_personnel' => $id_fonction_personnel,
							'nom_complet' => $nom_complet,
							'localisation' => $localisation,
							'contact' => $contact,
							'salaire' => $salaire_de_base,
							'date_entree' => $date_entree
							]);

						$_SESSION['success'] = 'L\'employé '.$nom_complet.' a été correctement ajouté à la base de données';

						header('Location: _personnel');
						die();
					}
				}elseif($table == 'user') { // Utilisateurs

					$nom_complet = $this->secureData($_POST['nom_complet']);
					$username = $this->secureData($_POST['username']);
					$password = isset($_POST['password']) ? sha1(md5($this->secureData($_POST['password']))) : null;
					$localisation = $this->secureData($_POST['localisation']);
					$contact = $this->secureData($_POST['contact']);
					$niveau = $this->secureData($_POST['niveau']);
					$oldName = $this->secureData($_POST['oldName']);

					if(isset($_POST['modUser'])) {

						if($username != $oldName) {

							if($this->loadModel($table)->already_exist($username, 'username') == '1') {

								$_SESSION['err'] = 'Un Utilisateur du même nom existe déjà dans la base de données !!!';
								
								header('Location: _utilisateur');
								die();
							}
						}

						$this->loadModel($table)->update($_POST['id'], [
							'username' => $username,
							'nom_complet' => $nom_complet,
							'contact' => $contact,
							'localisation' => $localisation,
							'niveau' => $niveau
							]);

						$_SESSION['success'] = 'L\'utilisateur '.$nom_complet.' a été correctement modifié de la base de données';

						header('Location: _utilisateur');
						die();
					}else {

						if($this->loadModel($table)->already_exist($nom_complet, 'nom_complet') == '1') {

							$_SESSION['err'] = 'Un Utilisateur du même nom existe déjà dans la base de données !!!';
							
							header('Location: _utilisateur');
							die();
						}

						$this->loadModel($table)->create([
							'username' => $username,
							'password' => $password,
							'nom_complet' => $nom_complet,
							'contact' => $contact,
							'localisation' => $localisation,
							'niveau' => $niveau
							]);

						$_SESSION['success'] = 'L\'utilisateur '.$nom_complet.' a été correctement ajouté à la base de données';

						header('Location: _utilisateur');
						die();
					}
				}elseif($table == 'client') { // Clients

					$nom_complet = $this->secureData($_POST['nom_complet']);
					$oldName = $this->secureData($_POST['oldName']);

					if(isset($_POST['modClient'])) {

						if($nom_complet != $oldName) {

							if($this->loadModel($table)->already_exist($nom_complet, 'nom_complet') == '1') {

								$_SESSION['err'] = 'Un Client du même nom existe déjà dans la base de données !!!';
								
								header('Location: gestion_client');
								die();
							}
						}

						$this->loadModel($table)->update($_POST['id'], ['nom_complet' => $nom_complet]);

						$_SESSION['success'] = 'Le Client '.$nom_complet.' a été correctement modifié de la base de données';

						header('Location: gestion_client');
						die();
					}else {

						if($this->loadModel($table)->already_exist($nom_complet, 'nom_complet') == '1') {

							$_SESSION['err'] = 'Un Client du même nom existe déjà dans la base de données !!!';
							
							header('Location: gestion_client');
							die();
						}

						$this->loadModel($table)->create(['nom_complet' => $nom_complet]);

						$_SESSION['success'] = 'Le Client '.$nom_complet.' a été correctement ajouté à la base de données';

						header('Location: gestion_client');
						die();
					}
				}
			}
		}

		public function __sell() {

			$this->postControl();
			$this->adminVerification();

			if(!isset($_POST['table'])) {

				die('Tu as fais comment pour arriver ici?');
			}else {

				$table = $this->secureData($_POST['table']);
				$id = $this->secureData($_POST['id']);
				
				if($table == 'boisson') { // Boissons

					$nom = $this->secureData($_POST['nom']);
					$prix_achat = $this->secureData($_POST['prix_achat']);
					$prix_vente = $this->secureData($_POST['prix_vente']);
					$qte_dispo = $this->secureData($_POST['qte_dispo']);
					
					$prix_vendu = $this->secureData($_POST['prix_vendu']);
					$qte_vendu = $this->secureData($_POST['qte_vendu']);

					$rest = $qte_dispo - $qte_vendu;

					$this->loadModel('boisson')->update($id, ['qte' => $rest]);

					$this->loadModel('log')->create([
						'id_auteur' => $_SESSION['id_lkjaldkafpoijdmfaexphair'],
						'elt' => 'boisson',
						'nom' => $nom,
						'action' => 'vente',
						'prix' => $prix_vendu,
						'qte' => $qte_vendu,
						'date' => date('Y/m/d'),
						'heure' => date('H:i:s')
					]);

					$_SESSION['success'] = $qte_vendu.' '.$nom.' a/ont été marqué(s) comme vendu(s) et soustraits de la base de données';

					header('Location: gestion_bar');
					die();
				}
			}
		}

		public function __buy() {

			$this->postControl();
			$this->adminVerification();

			if(!isset($_POST['table'])) {

				die('Tu as fais comment pour arriver ici?');
			}else {

				$table = $this->secureData($_POST['table']);
				$id = $this->secureData($_POST['id']);
				
				if($table == 'boisson') { // boissons

					$nom = $this->secureData($_POST['nom']);
					$prix_achat = $this->secureData($_POST['prix_achat']);
					$prix_vente = $this->secureData($_POST['prix_vente']);
					$qte_dispo = $this->secureData($_POST['qte_dispo']);
					
					$qte_achete = $this->secureData($_POST['qte_achete']);

					$new = $qte_dispo + $qte_achete;

					$this->loadModel('boisson')->update($id, ['qte' => $new]);

					$this->loadModel('log')->create([
						'id_auteur' => $_SESSION['id_lkjaldkafpoijdmfaexphair'],
						'elt' => 'boisson',
						'nom' => $nom,
						'action' => 'achat',
						'prix' => $prix_achat,
						'qte' => $qte_achete,
						'date' => date('Y/m/d'),
						'heure' => date('H:i:s')
					]);

					$_SESSION['success'] = $qte_achete.' '.$nom.' a/ont été marqué(s) comme acheté(s) et ajoutés à la base de données';

					header('Location: gestion_bar');
					die();
				}
			}
		}

		public function index() {
			
			$this->adminVerification();

			$title = 'Démo Coif - Dashboard';
			$today = date('Y/m/d');

			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;

			$_SESSION['success'] = null;

			$this->render('admin.home.index', compact('title', 'dayAchat', 'dayVente', 'monthAchat', 'monthVente', 'success'));
		}

		public function gestion_bar() {

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$boissons = $this->loadModel('boisson')->all();

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.gestion.gestion_bar', compact('title', 'success', 'err', 'boissons'));
		}

		public function gestion_coiffure_homme() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$coiffures = $this->loadModel('coiffure')->all();

			$this->render('admin.gestion.gestion_coiffure_homme', compact('title', 'success', 'err', 'coiffures'));
		}

		public function gestion_coiffure_femme() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$coiffures = $this->loadModel('coiffure')->all();

			$this->render('admin.gestion.gestion_coiffure_femme', compact('title', 'success', 'err', 'coiffures'));
		}

		public function gestion_coiffure_enfant() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$coiffures = $this->loadModel('coiffure')->all();

			$this->render('admin.gestion.gestion_coiffure_enfant', compact('title', 'success', 'err', 'coiffures'));
		}

		public function gestion_esthetique() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$esthetiques = $this->loadModel('esthetique')->all();

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.gestion.gestion_esthetique', compact('title', 'success', 'err', 'esthetiques'));
		}

		public function gestion_restauration() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$restaurations = $this->loadModel('restauration')->all();

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.gestion.gestion_restauration', compact('title', 'success', 'err', 'restaurations'));
		}

		public function gestion_produit() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$produits = $this->loadModel('produit')->all();

			$this->render('admin.gestion.gestion_produit', compact('title', 'success', 'err', 'produits'));
		}

		public function gestion_client() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$clients = $this->loadModel('client')->all();

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.gestion.gestion_client', compact('title', 'success', 'err', 'clients'));
		}

		public function gestion_dette() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$dettes = $this->loadModel('dette')->all();

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.gestion.gestion_dette', compact('title', 'success', 'err', 'dettes'));
		}

		public function rapport_general() {

			$this->adminVerification();
			$form = new \Core\HTML\BootstrapForm;
			$title = $this->setTitle();
			$logs = $this->loadModel('log')->all();

			$this->render('admin.rapport.rapport_general', compact('title', 'logs', 'form'));
		}

		public function rapport_bar() {

			$this->adminVerification();
			$form = new \Core\HTML\BootstrapForm;
			$title = $this->setTitle();
			$logs = $this->loadModel('log')->all();

			$this->render('admin.rapport.rapport_bar', compact('title', 'logs', 'form'));
		}

		public function rapport_coiffure_homme() {

			$this->adminVerification();
			$form = new \Core\HTML\BootstrapForm;
			$logs = $this->loadModel('log')->all();
			$title = $this->setTitle();

			$this->render('admin.rapport.rapport_coiffure_homme', compact('title', 'logs', 'form'));
		}

		public function rapport_coiffure_femme() {

			$this->adminVerification();
			$form = new \Core\HTML\BootstrapForm;
			$logs = $this->loadModel('log')->all();
			$title = $this->setTitle();

			$this->render('admin.rapport.rapport_coiffure_femme', compact('title', 'logs', 'form'));
		}

		public function rapport_coiffure_enfant() {

			$this->adminVerification();
			$form = new \Core\HTML\BootstrapForm;
			$logs = $this->loadModel('log')->all();
			$title = $this->setTitle();

			$this->render('admin.rapport.rapport_coiffure_enfant', compact('title', 'logs', 'form'));
		}

		public function rapport_esthetique() {

			$this->adminVerification();
			$form = new \Core\HTML\BootstrapForm;
			$logs = $this->loadModel('log')->all();
			$title = $this->setTitle();

			$this->render('admin.rapport.rapport_esthetique', compact('title', 'logs', 'form'));
		}

		public function rapport_restauration() {

			$this->adminVerification();
			$form = new \Core\HTML\BootstrapForm;
			$logs = $this->loadModel('log')->all();
			$title = $this->setTitle();

			$this->render('admin.rapport.rapport_restauration', compact('title', 'logs', 'form'));
		}

		public function rapport_caisse() {

			$this->adminVerification();
			$form = new \Core\HTML\BootstrapForm;
			$logs = $this->loadModel('log')->all();
			$title = $this->setTitle();

			$this->render('admin.rapport.rapport_caisse', compact('title', 'logs', 'form'));
		}

		public function _utilisateur() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$users = $this->loadModel('user')->all();

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.admin._utilisateur', compact('title', 'success', 'err', 'users'));
		}

		public function _personnel() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$personnels = $this->loadModel('personnel')->all();

			$this->render('admin.admin._personnel', compact('title', 'success', 'err', 'personnels'));
		}

		public function _client() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.admin._client', compact('title', 'success', 'err'));
		}

		public function _boisson() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.admin._boisson', compact('title', 'success', 'err'));
		}

		public function _coiffure() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.admin._coiffure', compact('title', 'success', 'err'));
		}

		public function _esthetique() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.admin._esthetique', compact('title', 'success', 'err'));
		}

		public function _produit() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.admin._produit', compact('title', 'success', 'err'));
		}

		public function _restauration() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.admin._restauration', compact('title', 'success', 'err'));
		}

		public function _fonction() {

			$this->adminVerification();

			$title = $this->setTitle();
			$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
			$err = isset($_SESSION['err']) ? $_SESSION['err'] : null;

			$fonctions = $this->loadModel('fonction')->all();

			$_SESSION['success'] = null;
			$_SESSION['err'] = null;

			$this->render('admin.admin._fonction', compact('title', 'success', 'err', 'fonctions'));
		}
	}
 ?>