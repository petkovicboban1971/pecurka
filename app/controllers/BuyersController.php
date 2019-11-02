<?php

class BuyersController extends \BaseController {

	public function index()
	{
		//
	}

	public function create()
	{
		//
	}

	public function newBuyer(){
		$data = new Buyers;
		$data->naziv = $_POST['NoviKupac'];
		$data->grad = $_POST['Grad'];
		$data->ulica = $_POST['Ulica'];
		$data->broj = $_POST['Broj'];
		$data->PIB = $_POST['Pib'];
		$data->racun = $_POST['Racun'];
		if ($_POST['grupa_kupac']) {
			$data->grupa_kupac = $_POST['grupa_kupac'];
		}		
		$data->save();
		$data->kupac_id = $data->id;
		$data->update();

		$data1 = new kupci_uplata();
		$data1->iznos = 0;
		$data1->nacin = 2;
		$data1->kupac_id = $data->id;
		$data1->created_at = date('Y-m-d');
		$data1->save();
	      	
		Session::flash('success', AdminOptions::lang(93, Session::get("jezik.AdminOptions::server()")));
	    return View::make('workers', array('pom' => 6));
	}

	public function show($id=1){
		
		return View::make('listOfBuyers');
	}

	public function edit($id)
	{
		//
	}

	public function updateBuyer($id){
		
		$data = Buyers::find($id);
		if ($_POST['naziv']) {
			$data->naziv = $_POST['naziv'];
		}
		if ($_POST['grad']) {
			$data->grad = $_POST['grad'];
		}
		if ($_POST['ulica']) {
			$data->ulica = $_POST['ulica'];
		}
		if ($_POST['broj']) {
			$data->broj = $_POST['broj'];
		}
		if ($_POST['PIB']) {
			$data->PIB = $_POST['PIB'];
		}		
		if ($_POST['racun']) {
			$data->racun = $_POST['racun'];
		}
		if ($_POST['grupa_kupac']) {
			$data->grupa_kupac = $_POST['grupa_kupac'];
		}		
		
		$data->update();
		Session::flash('success', AdminOptions::lang(92, Session::get("jezik.AdminOptions::server()")));
		return View::make('workers', array('pom' => 6));
	}

	public function findBuyer($id){

		$data = Buyers::find($id);		
		return View::make("workers", array(
			'data'=> $data, 
			'pom' => 6
		));
	}

	public function deleteBuyer($id){
		
		$buyer = Buyers::find($id);
		$buyer->aktivan = 0;
		$buyer->update();
		Session::flash('success', AdminOptions::lang(91, Session::get("jezik.AdminOptions::server()")));
		return View::make('workers', array('pom' => 6));
	}

	public function uplate_kupaca(){

		$reversi = [];
		$reversi_zbir = [];
		$naplaceni_reversi = [];
		$data = Buyers::where('aktivan', 1)->get();
		foreach ($data as $k1 => $kupac) {
			$suma_revers = 0;
			$svi_reversi = razduzenjeRadnika::where('kupac', $kupac->id)
											->where('nacin', 3)
											->get();
			foreach ($svi_reversi as $revers) {
				$suma_revers = proizvodi::kolicina_pakovanje($revers->kolicina, $revers->pakovanje, $revers->proizvod, $suma_revers, $revers->created_at);
			}
			if($suma_revers != 0){
				$reversi[$k1] = $kupac->id;
				$reversi_zbir[$k1] = $suma_revers;
				$naplaceni_reversi[$k1] = kupci_uplata::where('kupac_id', $kupac->id)->sum('iznos');
				//echo $suma_revers."<br>";
			}
		}
		
		return View::make("welcome", array(
			'svi_reversi'=> $svi_reversi, 
			'reversi'=> $reversi, 
			'reversi_zbir'=> $reversi_zbir, 
			'naplaceni_reversi'=> $naplaceni_reversi, 
			'kupci'=> $data, 
			'pom' => 5
		));
	}


	public function snimi_uplatu(){

		if ($_POST['iznos_uplate'] <= 0){
			Session::flash('err', AdminOptions::lang(258, Session::get('jezik.AdminOptions::server()')) );
			return Redirect::back();
		}

		$data = new kupci_uplata();

		$data->kupac_id = $_POST['uplata_kupac'];
		$data->nacin = 1;
		$data->iznos = -$_POST['iznos_uplate'];
		$data->created_at = date('Y-m-d');
		$data->save();

		Session::flash('msg', AdminOptions::lang(247, Session::get('jezik.AdminOptions::server()')) );
		$data = DB::table('kupci_uplata')->where('kupac_id', $_POST['uplata_kupac'])
										 ->orderBy('created_at', 'DESC')
										 ->get();
		return Redirect::to('/uplate_kupaca');
		/*return View::make("welcome", array(
			'uplate'=> $data, 
			'pom' => 6
		));*/
	}


	public function pregled_uplata($id=0){

		if ($id == 0) {
			$data = DB::table('kupci_uplata')->where('iznos', '>', 0)
			 								 ->orderBy('created_at', 'DESC');
		}
		else{
			$data = DB::table('kupci_uplata')->where('iznos', '>', 0)
											 ->where('nacin', $id)
			 								 ->orderBy('created_at', 'DESC');
		}
		$suma = $data->sum('iznos');
		return View::make("welcome", array(
			'uplate'=> $data->get(), 
			'suma' => $suma, 
			'pom' => 7
		));
	}


	public function pregled_uplata_kupca(){

		$data = DB::table('kupci_uplata')->where('kupac_id', $_GET['kupac'])
										 ->orderBy('created_at', 'DESC');
		$suma = $data->sum('iznos');
		return View::make("welcome", array(
			'uplate'=> $data->get(), 
			'suma' => $suma, 
			'pom' => 7
		));
	}


	public function izbor_nacina_prodaje(){

		$data = DB::table('kupci_uplata')->where('nacin', $_GET['nacin'])
										 ->orderBy('created_at', 'DESC');
		$suma = $data->sum('iznos');
		return View::make("welcome", array(
			'uplate'=> $data->get(), 
			'suma' => $suma, 
			'pom' => 7
		));
	}

	public function pregled_ziralnih_uplata(){

		$data = DB::table('kupci_ziralna_uplata')->orderBy('created_at', 'DESC')
												 ->orderBy('kupac_id', 'ASC');

		$suma = $data->sum('iznos');
		return View::make("welcome", array(
			'uplate'=> $data->get(), 
			'suma' => $suma, 
			'pom' => 7
		));

	}

	public function istorija_transakcija(){

		$data = DB::table('kupci')->where('grupa_kupac', 0)
								  ->where('aktivan', 1)
								  ->get();		
		return View::make("welcome", array(
			'svi_kupci'=> $data, 
			'pom' => 14
		));
	}

	public function istorija_transakcija2(){
		
		$data = [];
		if(null == $_POST['pocetni']){
			$_POST['pocetni'] = "01/01/1970";
			$_POST['krajnji'] = date("d/m/Y");
		}
		$pom1 = $_POST['pocetni'];
		$niz1 = (str_split($pom1));
		$niz2 = $niz1;
		$niz2[0] = $niz1[3];
		$niz2[1] = $niz1[4];
		$niz2[3] = $niz1[0];
		$niz2[4] = $niz1[1];
		$_POST['pocetni'] = join($niz2);

		$pocetni = date_format(date_create($_POST['pocetni'].' 00:00:00'), "Y-m-d H:i:s");

		if (null == $_POST['krajnji']) {
			$_POST['krajnji'] = $_POST['pocetni'];
			$pom2 = $pom1;
		}
		else{
			$pom2 = $_POST['krajnji'];
			$niz1 = (str_split($pom2));
			$niz2 = $niz1;
			$niz2[0] = $niz1[3];
			$niz2[1] = $niz1[4];
			$niz2[3] = $niz1[0];
			$niz2[4] = $niz1[1];
			$_POST['krajnji'] = join($niz2);
		}
		
		$krajnji = date_format(date_create($_POST['krajnji'].' 23:59:59'), "Y-m-d H:i:s");
		if ($krajnji > date("Y-m-d")) {
			$krajnji = date("Y-m-d H:i:s");
		}

		if ($krajnji < $pocetni) {
			Session::flash('err', AdminOptions::lang(230, Session::get('jezik.AdminOptions::server()')));
			return Redirect::back();
		}

		$kupci = DB::table('kupci')->where('id', $_POST['kupac'])
									->orderBy('created_at', 'DESC')
									->get();
		$podkupci = DB::table('kupci')->where('grupa_kupac', $_POST['kupac'])
									->orderBy('created_at', 'DESC')
									->get();
		if ($podkupci == null){
			$podkupci = $kupci;
		}
		//echo $pocetni, $krajnji;
		$iznos = 0;
		$grupa_kupac = Buyers::where('grupa_kupac', '=', $_POST['kupac'])->pluck('id');
		foreach($podkupci as $key => $podkupac){
			$data[$key] = DB::table('razduzenjeRadnika')->where(function ($query) 
													use ($grupa_kupac){
													$query->where('kupac', $_POST['kupac'])
														->orWhere('kupac', $grupa_kupac);
													})
														->where('created_at', '>=', $pocetni)
													  	->where('created_at', '<=', $krajnji)
														->orderBy('created_at', 'DESC')
														->get();
			
		}

		for ($i=0; $i < count($data); $i++) { 
			
			foreach ($data[$i] as $value) {
				$iznos = $iznos + cene_datumi::cena_proizvoda($value->proizvod, $value->created_at) * proizvodi::odluka_brojcano($value->kolicina, $value->pakovanje);
			}	
		}
		$iznos = $iznos + DB::table('kupci_uplata')->where(function ($query) 
												use ($grupa_kupac){
												$query->where('kupac_id', $_POST['kupac'])
													->orWhere('kupac_id', $grupa_kupac);
												})
												->sum('iznos');
		/*var_dump($data);
		die();*/
		return View::make("welcome", array(
			'kupci'=> $kupci, 
			'data_podkupaca'=> $data, 
			'iznos'=> $iznos, 
			'podkupci'=> $podkupci, 
			'pom' => 14
		));
	}
}