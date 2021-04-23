<?php

	namespace bpsmartdesignMedecinApp\Controller\Page;

	class HomeController extends \bpsmartdesignMedecinApp\Controller\AppController{
		
		private function setTitle() {

			$p = isset($_GET['p']) ? stripcslashes(htmlentities($_GET['p'])) : 'p.accueil';
			$p = explode('.', $p);
			return strlen($p[1]) == 0 ? 'BpSmartDesign - Accueil' : 'BpSmartDesign - '.ucfirst($p[1]);
		}

		public function index() {

			$title = $this->setTitle();

			$this->render('p.index', compact('title'));
		}

		public function about() {

			$title = $this->setTitle();

			$this->render('p.about', compact('title'));
		}

		public function services() {

			$title = $this->setTitle();

			$this->render('p.services', compact('title'));
		}

		public function products() {

			$title = $this->setTitle();

			$this->render('p.products', compact('title'));
		}

		public function testimonies() {

			$title = $this->setTitle();

			$this->render('p.testimonies', compact('title'));
		}

		public function faq() {

			$title = $this->setTitle();

			$this->render('p.faq', compact('title'));
		}

		public function contact() {

			$title = $this->setTitle();

			$this->render('p.contact', compact('title'));
		}
	}
 ?>