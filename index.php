<?php

	////////////////////////////////////////////////////////////////////// I N T R O D U C T I O N
    define('ROOT', dirname(__FILE__)); // Constante qui contient nom du repertoire parent ==> C:\Users\MAMS\Desktop\Workspace_\__Laravel\bpsmartdesign.medecin
    
		require ROOT.'/App/App.php'; // Inclusion du fichier App.php [notre fichier principal]
		App::load(); // Appel de la fonction load() qui se trouve dans la classe statique App

	///////////////////////////////////////////////////////////////////// P E T I T   S Y S T E M E   D E   R O U T I N G
	$p = isset($_GET['p']) ? stripcslashes(htmlentities($_GET['p'])) : 'p.index'; // récupération de la page à charger
	$p = explode('.', $p); // division de la valeur de $p en un tableau de plusieurs éléments correspondants aux noms des fichiers à charger
	$controller = strtolower($p[0] != 'u') ? '\bpsmartdesignMedecinApp\Controller\Page\HomeController' : '\bpsmartdesignMedecinApp\Controller\Admin\AdminController'; // Appel du controleur correspondant
	
	if($p[1] == 'logout') {
		unset($_SESSION['bpsmartdesignMedecinLogToken']);
		header('Location: index');
		die();
	}

	//////////////////////////////////////////////////////////////////// C O N T R O L L E U R  E T  V U E
	$action = $p[1]; // Chargement de la méthode correspondante

	$controller = new $controller(); // Appel de la page correspondante
	$controller->$action(); // Appel de la page correspondante
?>