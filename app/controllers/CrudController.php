<?php

class CrudController extends \BaseController {

	public function store()
	{
		$data = new Ulazna_stavka;
		$data->ulazna_stavka = Input::get('NovaStavka');
		$data->ulazna_stavka_nabavna_cena = Input::get('NabavnaCena');
		$data->ulazna_stavka_porez = Input::get('Porez');
		$data->ulazna_stavka_zaracunata_marza = Input::get('Marza');
		$data->ulazna_stavka_dobavljac = Input::get('Dobavljac');
		$data->save();

		Session::flash('success', AdminOptions::lang(94, Session::get("jezik.AdminOptions::server()")));
		return View::make("workers", array('pom' => 3));

	}

	public function noviDobavljac(){
		$data =  new dobavljaci();
		$data->naziv_dobavljaca = $_POST['noviDobavljac'];
		$data->timestamps = false;
		$data->save();
		$data->dobavljac_id = DB::table('dobavljaci')->max('id');
		$data->update();

		Session::flash('success', AdminOptions::lang(195, Session::get("jezik.AdminOptions::server()")));
		return Redirect::to("/admin-welcome");
	}

	public function unosKolicineDobavljac(){
		
		$datas = DB::table('dobavljaci')->get();
		$proizvodi = DB::table('proizvodi')->get();
		return View::make('welcome', array('datas' => $datas, 'proizvodi' => $proizvodi, 'pom' => 1, 'pom11' => 1));
	}


	public function kolicinedobavljaca(){
		
		if($_POST['novaKolicina'] <= 0){
			Session::flash('err', AdminOptions::lang(197, Session::get('jezik.AdminOptions::server()')));
			return View::make('welcome', array('pom' => 1));
		}

		$data = new kolicinedobavljaca();
		$data->dobavljac = $_POST['dobavljac'];
		$data->proizvod = $_POST['proizvod'];
		if(proizvodi::find($_POST['proizvod'])->tezina_pakovanja != 0){
			$data->kolicina = proizvodi::find($_POST['proizvod'])->tezina_pakovanja * $_POST['novaKolicina'];
			$data->pakovanje = $_POST['novaKolicina'];
			$data->tezina_pakovanja = proizvodi::find($_POST['proizvod'])->tezina_pakovanja;
		}
		else{
			$data->kolicina = $_POST['novaKolicina'];
		}
		$data->save();

		$kol = proizvodi::find($_POST['proizvod']);
		
		if($kol->tezina_pakovanja != 0){
			$kol->pakovanje = $kol->pakovanje + $_POST['novaKolicina'];
			$kol->kolicina_proizvoda = $kol->kolicina_proizvoda + $kol->tezina_pakovanja * $_POST['novaKolicina'];
			$kol->kolicina_pocetak = $kol->kolicina_pocetak + $kol->tezina_pakovanja * $_POST['novaKolicina'];
		}
		else{
			$kol->kolicina_proizvoda = $kol->kolicina_proizvoda + $_POST['novaKolicina'];
			$kol->kolicina_pocetak = $kol->kolicina_pocetak + $_POST['novaKolicina'];
		}
		$kol->update();

		$dobavljaci = dobavljaci::where('aktivan', 1)->get();
		$pom1 = [];
        $suma1 = kolicinedobavljaca::procenat_iznos();
        ($suma1 == 0) ? $suma1=1 : $suma1;
        foreach ($dobavljaci as $i => $dobavljac) {                    
            $pom1[$i] = kolicinedobavljaca::procenat_iznos1($dobavljac->id);
        }  

		Session::flash('msg', AdminOptions::lang(196, Session::get('jezik.AdminOptions::server()')));

		return Redirect::to('/grafik_dobavljaci');

		return View::make('welcome', array(
			'pom' => 9,
			'pom1' => $pom1,
			'suma1' => $suma1,
			'dobavljaci' => $dobavljaci
		));
	}

	public function upisProizvoda($id){
		
	}


	public function update($id)
	{
		$data = Ulazna_stavka::find($id);
		if ($_POST['stavka']) {
			$data->ulazna_stavka = $_POST['stavka'];
		}
		if ($_POST['nabavna_cena']) {
			$data->ulazna_stavka_nabavna_cena = $_POST['nabavna_cena'];
		}
		if ($_POST['porez']) {
			$data->ulazna_stavka_porez = $_POST['porez'];
		}
		if ($_POST['marza']) {
			$data->ulazna_stavka_zaracunata_marza = $_POST['marza'];
		}
		if ($_POST['dobavljac']) {
			$data->ulazna_stavka_dobavljac = $_POST['dobavljac'];
		}
		$data->update();

		Session::flash('success', AdminOptions::lang(95, Session::get("jezik.AdminOptions::server()")));
		return View::make("workers", array('pom' => 3));
	}

	public function destroy($id){	
		$item = ulazna_stavka::find($id);
		$item->aktivan = 0;
		$item->update();

		Session::flash('success', AdminOptions::lang(96, Session::get("jezik.AdminOptions::server()")));
		return View::make('workers', array('pom' => 3 ));
	}

	public function finding($id){

		$data = Ulazna_stavka::find($id);		
		return View::make("workers", array(
			'data'=> $data, 
			'pom' => 3
		));
	}

	public function grafik_dobavljaci(){

		$dobavljaci = dobavljaci::where('aktivan', 1)->get();
		$proizvodi = DB::table('proizvodi')->where('aktivan', 1)
										   ->where('kolicina_proizvoda', '!=', 0) 
										   ->orWhere('pakovanje', '!=', 0)
										   ->orderBy('grupa_proizvoda', 'ASC')
										   ->get();
		$sema = DB::table('kolicinedobavljaca')->orderBy('id', 'ASC')->get();
		return View::make('welcome', array(
			'pom' => 3, 
			'dobavljaci' => $dobavljaci, 
			'proizvodi' => $proizvodi, 
			'sema' => $sema
		));
	}

	public function isplate_dobavljacima($id=0){

		$dobavljaci = DB::table('dobavljaci')->where('aktivan', 1)->get();
		$nacin = vrsta_prodaje::all();

		$pom1 = [];
        $suma1 = kolicinedobavljaca::procenat_iznos();
        ($suma1 == 0) ? $suma1=1 : $suma1;
        foreach ($dobavljaci as $i => $dobavljac) {                    
            $pom1[$i] = kolicinedobavljaca::procenat_iznos1($dobavljac->id);
        }                            


			$kupci = DB::table('kupci')->where('aktivan', 1)->get();
			$vrsta_prodaje = vrsta_prodaje::all();
			$izracunata_isplata = [0];
			$uplate = [0];
			$zbir_nacin = [0];
			$ispaceni_dobavljaci = dobavljaci_isplata::sum('iznos');
			foreach ($kupci as $k1 => $kupac){
				$dugovanje1 = 0;
				$uplate1 = 0;
				foreach ($vrsta_prodaje as $k2 => $nacin){
					if($nacin->id == 2){
						$kupac_uplata[$k1][$k2] = DB::table('kupci_ziralna_uplata')->where('kupac_id', $kupac->id)->sum('iznos');
					}
					elseif($nacin->id == 3){
						$kupac_uplata[$k1][0] = kupci_uplata::uplate_kupca($kupac->id, 3);	 
						$uplate[$k1] = $uplate1 + $kupac_uplata[$k1][0];
						$uplate1 = $uplate[$k1];
						$kupac_uplata[$k1][2] = -$uplate1;
					}
					else{
						$kupac_uplata[$k1][$k2] = kupci_uplata::uplate_kupca($kupac->id, 1); 
						$uplate[$k1] = $uplate1 + $kupac_uplata[$k1][$k2];
						$uplate1 = $uplate[$k1];
					}
					$kupac1[$k1][$k2] = RazduzenjeRadnika::razduzenja($kupac->id, $nacin->id);
					$dugovanje[$k1][$k2] = $kupac1[$k1][$k2];
					$suma[$k1][$k2] = $dugovanje[$k1][$k2] - $kupac_uplata[$k1][$k2];
				}
			}

			for ($i=0; $i < count($vrsta_prodaje); $i++) { 
				$zbir1 = 0;
				foreach (Buyers::all() as $key => $value) {					
					$zbir_nacin[$i] = $zbir1 + $suma[$key][$i];
					$zbir1 = $zbir_nacin[$i];
				}
			}

			foreach ($dobavljaci as $i => $dobavljac) {
				$izracunata_isplata[$i] = round(($pom1[$i]/$suma1) * ($zbir_nacin[0] - dobavljaci_isplata::sum('iznos')) * 100)/100;
			}

			if ($id != 0) {
				foreach ($dobavljaci as $i => $dobavljac) {
					$data = new dobavljaci_isplata();
					$data->dobavljaci_id = $dobavljac->id;
					$data->nacin = 1;
					$data->iznos = $izracunata_isplata[$i];
					$data->created_at = date("Y-m-d");
					$data->save();
				}
			
				Session::flash('msg', AdminOptions::lang(222, Session::get('jezik.AdminOptions::server()')) );

				return Redirect::back();
			}


		return View::make('welcome', array(
			'pom' => 9,
			'pom1' => $pom1,
			'suma1' => $suma1,
			'nacin' => $nacin,
			'zbir_nacin' => $zbir_nacin,
			'izracunata_isplata' => $izracunata_isplata,
			'dobavljaci' => $dobavljaci
		));
	}

	public function unos_isplate_dobavljaca(){

		$data = new dobavljaci_isplata();
		$data->dobavljaci_id = $_POST['dobavljac_isplata'];
		if (isset($_POST['nacin_isplate'])) {
			$data->nacin = $_POST['nacin_isplate'];
		}
		$data->iznos = $_POST['iznos_isplate'];
		$data->created_at = date("Y-m-d");
		$data->save();
	
		Session::flash('msg', AdminOptions::lang(222, Session::get('jezik.AdminOptions::server()')) );

		return Redirect::back();
	}

	public function pregled_ispl_dobavljaca(){

		$dobavljac = dobavljaci::find($_GET['id']);
		$isplate_dobavljaca = dobavljaci_isplata::where('dobavljaci_id', $_GET['id'])->get();

		return View::make('welcome', array(
			'isplate_dobavljaca' => $isplate_dobavljaca,
			'dobavljac' => $dobavljac,
			'mod' => 1
		));
	}


	public function create_article(){
		return View::make('welcome', array(
			'pom' => 16
		));
	}

	public function create_ajax(){

		$clanak = Firma::find(1);
		if (null != Input::file('file')) {
			
	        $image = Input::file('file');
	        $max_image_size = 2048;
	        $max_images = 10;
	        $success = false;
	 
	        $validator = Validator::make(
	            array('file' => 'mimes:jpg,png,jpeg|max:'.strval($max_image_size)),
	            array(
	                'mimes' => 'Neodgovarajući format slike. Dozvoljeni formati su jpg, png i jpeg.',
	                'max' => 'Maksimalna veličina slike je '.strval($max_image_size / 1000).' MB.',
	                )
	            );
	        if($validator->fails()){
	            $success = false;
	            $error_message = $validator->messages()->first();
	            break;
	        }else{
	            $success = true;
	        }
	            
	        if($success){
	        	//$file = $image->picture_path;
		        $filename ='images/pecurka1.png';
		        File::delete($filename);
		        //File::delete('favicon.ico');
		      	//$fileName = Input::file('file')->getClientOriginalName(); // getting image name
		      	$path = __DIR__.'/../../images/';
				$clanak->image = 'pecurka1.png'; 
		      	Input::file('file')->move($path, $clanak->image);
		      	 
		    }
	    }
	    	
		$clanak->opis = $_POST['tekstClanka'];
		$clanak->timestamps = false;
      	$clanak->update();	      	
		Session::flash('msg', AdminOptions::lang(266, Session::get('jezik.AdminOptions::server()'))); 

      	return Response::json(array('msg'=>true));
      	
	}

}
