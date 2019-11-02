<?php

class ProdajaController extends \BaseController {

	public function ziralno(){
		
		$data = razduzenjeRadnika::where('nacin', 2)
									->where('kolicina','!=', 0)
									->orderBy('created_at', 'ASC');
		
		return View::make('welcome', array(
			'dataZiralno' => $data->get(), 
			'suma' => $data->sum('kolicina'), 
			'pom' => 4
		));

	}


	public function fakture(){
		
		$data = DB::table('kupci')->where('aktivan', 1)
								  ->get();
		return View::make('welcome', array(
			'kupci' => $data, 
			'pom' => 8
		));
	}


	public function izbor_kupca_faktura(){
		
		$kupac = DB::table('razduzenjeRadnika')->where('kupac', $_GET['faktura'])
												->where('nacin', 2)
												->orderBy('created_at', 'DESC')
												->distinct()
												->get(['created_at']);
		$suma = 0;
		$datum = [];
		$uplate_kupaca = DB::table('kupci_uplata')->where('kupac_id', $_GET['faktura'])/*
													->where('nacin', 2)*/
													->sum('iznos');
		foreach($kupac as $key => $kupac3) { 
			$kupac0[$key] = DB::table('razduzenjeRadnika')->where('kupac', $_GET['faktura'])
													->where('nacin', 2)/*
													->where('realiz_uplate', 0)*/
													->where('created_at', $kupac3->created_at)
													->get();
			//$brojac = [];

			foreach ($kupac0[$key] as $j => $value) {	

				if($value->realiz_uplate == 0){
					$suma = proizvodi::kolicina_pakovanje($value->kolicina, $value->pakovanje, $value->proizvod, $suma, $value->created_at);
				}
				$datum[$key] = $value->created_at;
			}
		}

		if (empty($kupac0)) {
			Session::flash('err', AdminOptions::lang(224, Session::get('jezik.AdminOptions::server()')));
			return Redirect::back();
		}

		$datumi = array_values(array_filter(array_unique($datum)));

		$datum_faktura = [];

		for ($i=0; $i < count($datumi); $i++) { 

			$datum_faktura[$i] = DB::table('razduzenjeRadnika')->where('created_at', $datumi[$i])
													/*->where('realiz_uplate', 0)*/
														->where('kupac', $_GET['faktura'])
														->where('nacin', 2)
														->get();
		}
		if (empty($datum_faktura[0])) {
				Session::flash('err', AdminOptions::lang(224, Session::get('jezik.AdminOptions::server()')));
				return Redirect::back();
		}

		return View::make('welcome', array(
			'razduzenja' => $kupac0,   
			'faktura' => $_GET['faktura'], 
			'pom' => 8,
			'zbir_uplata' => $uplate_kupaca,
			'datum_faktura' => $datum_faktura,
			'datumi' => $datumi,
			//'brojac' => $brojac,
			'pom_brojac' => count($datum),
			'suma' => $suma
		));

	}


	public function realiz_uplate_faktura(){
		
		$datas = DB::table('razduzenjeRadnika')->where('kupac', $_GET['faktura'])
											  ->where('created_at', $_GET['datum'])
											  ->where('nacin', 2)
											  ->get();

		foreach ($datas as $data){
			$data1 = razduzenjeRadnika::find($data->id);
			if (isset($_GET['storno']) && $_GET['storno'] == 1) {
				$data1->realiz_uplate = 0;
			}
			else{
				$data1->realiz_uplate = 1;
			}
			$data1->update();
		}

		if (isset($_GET['storno']) && $_GET['storno'] == 1) {
			
			$pom4 = DB::table('kupci_ziralna_uplata')->where('kupac_id', $_GET['faktura'])
													->where('iznos', $_GET['iznos'])
													->where('created_at', $_GET['datum'])
													->pluck('id');
			$storno_uplate = kupci_ziralna_uplata::find($pom4);
			$storno_uplate->delete();

			Session::flash('msg', AdminOptions::lang(240, Session::get('jezik.AdminOptions::server()')));
		}
		else{

			$ziralna_uplata = new kupci_ziralna_uplata();

			$ziralna_uplata->kupac_id = $_GET['faktura'];
			$ziralna_uplata->iznos = $_GET['iznos'];
			$ziralna_uplata->created_at = $_GET['datum'];
			$ziralna_uplata->save();

			Session::flash('msg', AdminOptions::lang(238, Session::get('jezik.AdminOptions::server()')));
		}

		return Redirect::to('/izbor_kupca_faktura?faktura='.$_GET["faktura"]);
	}

	public function otpis(){
		return View::make('welcome', array(

			'pom' => 15
		));
	}

	public function otpis1(){

		$data = new otpis();
		$data->proizvod = $_POST['proizvod'];
		$data->kupac = $_POST['kupac'];
		$data->kolicina = $_POST['kolicina'];
		$data->opis = $_POST['opis'];
		$data->created_at = date('Y-m-d');

		$trenutna_kolicina_proizvoda = proizvodi::proizvod_kolicina($_POST['proizvod']);
		if ($trenutna_kolicina_proizvoda < $_POST['kolicina']) {
			Session::flash('err', AdminOptions::lang(170, Session::get('jezik.AdminOptions::server()')));
			return Redirect::back();
		}
		else{
			$data->save();
			proizvodi::proizvod_kolicina_otpis($_POST['proizvod'], $_POST['kolicina']);
			Session::flash('msg', AdminOptions::lang(246, Session::get('jezik.AdminOptions::server()')));

			return View::make('welcome');
		}
	}

    public function dnevna_cena_proizvoda(){

    	$postojeci_datum = cene_datumi::where('created_at', date('Y-m-d'))->pluck('id');
    	$postojeci_proizvod = cene_datumi::where('proizvod_id', Input::get('proizvod'))->pluck('id');

    	/*if (!empty($postojeci_datum) && !empty($postojeci_proizvod)) {
    		$data = cene_datumi::find($postojeci_proizvod)->first();
    		$data->cene = Input::get('kolicina');
	    	$data->proizvod_id =  Input::get('proizvod');
	    	$data->update();
    	}
    	else{*/
	    	$dnevna_cena_proizvoda = new cene_datumi();
	    	$dnevna_cena_proizvoda->cene = Input::get('kolicina');
	    	$dnevna_cena_proizvoda->proizvod_id = Input::get('proizvod');
	    	$dnevna_cena_proizvoda->created_at = date('Y-m-d');
	    	$dnevna_cena_proizvoda->save(); 
	    /*}*/

    	Session::flash('msg', AdminOptions::lang(261, Session::get('jezik.AdminOptions::server()')));
		return Redirect::back();
    }
}