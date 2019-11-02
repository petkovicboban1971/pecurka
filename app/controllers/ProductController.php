<?php

class ProductController extends \BaseController {

	
	public function index()
	{
		//
	}


	public function valute()
	{
		$data = Firma::find(1);
		$data->timestamps = false;
		$data->valuta = $_GET['valuta'];
		$data->update();
		return Redirect::back();
		
	}


	public function newProduct(){

		$data = new proizvodi;
		$data->naziv_proizvoda = $_POST['naziv_proizvoda'];
		$data->grupa_proizvoda = $_POST['grupa_proizvoda'];
		$data->cena_proizvoda = $_POST['cena_proizvoda'];
		$data->proizvodna_cena = $_POST['proizvodna_cena'];
		if(isset($_POST['tezina_pakovanja'])){
			$data->tezina_pakovanja = ($_POST['tezina_pakovanja'])/1000;
		}
		$data->save();
		$id = $data->id;

		$data = new cene_datumi();
		$data->cene = $_POST['cena_proizvoda']; 
		$data->proizvod_id = $id; 
		$data->created_at = date('Y-m-d');
		$data->save();

		Session::flash('success', AdminOptions::lang(106, Session::get("jezik.AdminOptions::server()")));
	    return View::make('workers', array('pom' => 8));
	}

	public function listProduct(){

		$data = DB::table('proizvodi')->get();
		return View::make("workers", array('pom' => 8));
	}


	public function findProduct($id){

		$data = proizvodi::find($id);		
		return View::make("workers", array('data'=> $data, 'pom' => 8));
	}


	public function updateProduct($id){
		
		$data = proizvodi::find($id);
		if ($_POST['naziv_proizvoda']) {
			$data->naziv_proizvoda = $_POST['naziv_proizvoda'];
		}
		if ($_POST['grupa_proizvoda'] != 0) {
			$data->grupa_proizvoda = $_POST['grupa_proizvoda'];
		}
		/*if ($_POST['kolicina_proizvoda']) {
			$data->kolicina_proizvoda = $_POST['kolicina_proizvoda'];
		}*/
		if ($_POST['cena_proizvoda']) {
			$data->cena_proizvoda = $_POST['cena_proizvoda'];
		}
		if ($_POST['proizvodna_cena']) {
			$data->proizvodna_cena = $_POST['proizvodna_cena'];
		}

		$data->update();

			Session::flash('success', AdminOptions::lang(108, Session::get("jezik.AdminOptions::server()")));
			return View::make("workers", array('pom' => 8));
		}


	public function deleteProduct($id){
		
		$data = proizvodi::find($id);
		$data->aktivan = 0;
		$data->update();

		Session::flash('success', AdminOptions::lang(107, Session::get("jezik.AdminOptions::server()")));
		return View::make('workers', array('pom' => 8));
	}

	public function new_warehouse(){

		$sql = DB::select("SHOW TABLES from pecurka LIKE 'magacin_%'");		
		$id = count($sql)+1; 
		$sql = DB::select("CREATE TABLE Magacin$id (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			radnici_id INT(6) NOT NULL,
			proizvodi_id INT(6) NOT NULL,
			kolicina DECIMAL(8,3) NOT NULL,
			magacin$id INT(6) NOT NULL)
			");
		
		Session::flash('kreiranMagacin', AdminOptions::lang(155, Session::get("jezik.AdminOptions::server()")));
		return Redirect::back();
	}


	public function stanjeMagacina(){	

		$magacini = veza::where('magacin', $_GET['magacin'])->get();
		$pom = 2;
		if (empty($magacini)) {
			$pom = 1;
		}

		$unikat_proizvod = veza::where('magacin', $_GET['magacin'])->distinct()->get(['proizvod']);
		$zbir = [];
		$zbir_proizvoda = [];
		for ($i=0; $i < count($unikat_proizvod); $i++) { 
			$zbir0 = 0;
			$zbir[$i] = veza::where('magacin', $_GET['magacin'])
							->where('proizvod', $unikat_proizvod[$i]->proizvod)
							->get();
			foreach($zbir[$i] as $value){
				$zbir0 = $zbir0 + proizvodi::odluka_brojcano($value->kolicina, $value->pakovanje);
			}
			$zbir_proizvoda[$i] = $zbir0; 
		}

		if (isset($_GET['choise'])){

			return View::make('welcome', array(
				'data' => $magacini,
				'unikat_proizvod' => $unikat_proizvod,
				'zbir_proizvoda' => $zbir_proizvoda,
			 	'pom' => $pom
			));
		}
		return View::make('pages.home', array(
				'data' => $magacini,
				'unikat_proizvod' => $unikat_proizvod,
				'zbir_proizvoda' => $zbir_proizvoda,
			 	'pom' => $pom
			));
	}


	public function glavniMagacin(){

		$data = proizvodi::where('aktivan', 1)->orderBy('grupa_proizvoda', 'ASC')->get();
		return View::make('welcome', array('data1' => $data));
	}

	public function tabela(){

		$data = DB::table('radnici')->get();
		return View::make('tabela', array('data' => $data, 'stranica' => 1, 'niz' => count(DB::table('radnici')->where('status', '=', 1)
									  ->orderBy('ime', 'ASC')
									  ->get())));
	}
}
