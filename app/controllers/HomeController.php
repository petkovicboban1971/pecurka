<?php

class HomeController extends BaseController {

	public function live(){
		return Redirect::to("AdminOptions::findSession('firma', 'web_sajt')");
	}

	public function showWelcome($id=0){        
        Session::forget('jezik.AdminOptions::server()');
        Session::forget('log_sesija.AdminOptions::server()');
        Session::forget('brojac');
        Session::forget('blink');
        if ($id == 1) {
	        Session::put('dash', 1);
	    }
    	return View::make('login');
	}

	public function preWelcome(){        	
		Session::put('jezik.AdminOptions::server()', $_POST['jezik']);
		return View::make('login');
	}

	public function welcome(){
		$danas = date('Y-m-d');
		if(isset($_GET['menu1']) && $_GET['menu1'] == 1){
			$kupci = Buyers::where('aktivan', 1)->get();
			$vrsta_prodaje = vrsta_prodaje::all();
			//$dugovanje = [0];
			$uplate = [0];
			$zbir_nacin = [0];
			$ispaceni_dobavljaci = dobavljaci_isplata::sum('iznos');
			foreach ($kupci as $k1 => $kupac){
				$dugovanje1 = 0;
				$uplate1 = 0;
				foreach ($vrsta_prodaje as $k2 => $nacin){
					if($nacin->id == 2){
						$kupac_uplata[$k1][$k2] = kupci_ziralna_uplata::where('kupac_id', $kupac->id)->sum('iznos');
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
					$kupac1[$k1][$k2] = RazduzenjeRadnika::razduzenja($kupac->id, $nacin->id, $kupac->created_at);
					$dugovanje[$k1][$k2] = $kupac1[$k1][$k2];
					$suma[$k1][$k2] = $dugovanje[$k1][$k2] - $kupac_uplata[$k1][$k2];
				}
			}

			if (empty($suma)) {
				$suma = 0;
			}

			for ($i=0; $i < count($vrsta_prodaje); $i++) { 
				$zbir1 = 0;
				foreach (Buyers::all() as $key => $value) {					
					$zbir_nacin[$i] = $zbir1 + $suma[$key][$i];
					$zbir1 = $zbir_nacin[$i];
				}
			}

			$isplate = [0];
			$svi_dobavljaci = dobavljaci::all();

			foreach($svi_dobavljaci as $k1 => $dobavljac){	

				//$pom = DB::table('dobavljaci_isplata')->where('dobavljaci_id', $dobavljac->id)->get();
				foreach ($vrsta_prodaje as $k2 => $nacin) {
					//$k2 == 2 ? $priv = 0 : $priv = $k2;
					$isplate_dobavljacima[$k1][$k2] = dobavljaci_isplata::where('nacin', $nacin->id)
													    ->where('dobavljaci_id', $dobavljac->id)
													    ->sum('iznos');
				}
			}

			foreach ($vrsta_prodaje as $k2 => $nacin) {
				$isplate1 = 0;
				foreach ($svi_dobavljaci as $k1 => $dobavljac) {
					$isplate[$k2] = $isplate1 + $isplate_dobavljacima[$k1][$k2];
					$isplate1 = $isplate[$k2];
				}
				
			}

			$dobavljac = [0];

			foreach (dobavljaci::where('aktivan', 1)->get() as $key => $dobavljaci) {
				 $dobavljac[$key] = kolicinedobavljaca::uplate_dobavljaca($dobavljaci->id);

			} 
			
			$brojac = [0];
			for ($i=0; $i < count($vrsta_prodaje); $i++) { 
				$pom = 0;
				foreach ($svi_dobavljaci as $key => $value) {
					
	                $brojac[$i] = $pom + $isplate_dobavljacima[$key][$i] - $dobavljac[$key];
	                $pom = $brojac[$i];	
				}
			}

			foreach ($svi_dobavljaci as $k1 => $dobavljac1) {
				
				foreach ($vrsta_prodaje as $k2 => $nacin) {
					
					$uplata_dobavljaca_nacin[$k1][$k2] = dobavljaci_isplata::where('dobavljaci_id', $dobavljac1->id)
														  ->where('nacin', $nacin->id)
														  ->sum('iznos');
				}
			}

			$ziralna_uplata = kupci_ziralna_uplata::sum('iznos');
			$otpis_zbir = 0;
			foreach(otpis::all() as $otpis){
				$otpis_zbir = $otpis_zbir + cene_datumi::cena_proizvoda($otpis->proizvod, $otpis->created_at) * $otpis->kolicina;
			}

			$magacini1 = veza::all();
			$suma_magacini = 0;
			foreach ($magacini1 as $magacin) {
				$suma_magacini = $suma_magacini + cene_datumi::cena_proizvoda($magacin->proizvod, $magacin->created_at) * proizvodi::odluka_brojcano($magacin->kolicina, $magacin->pakovanje);
			}


			$lager_magacin = proizvodi::where('aktivan', 1)->get();
			$suma_proizvoda = 0;

			foreach ($lager_magacin as $stavka) {
				$suma_proizvoda = $suma_proizvoda + cene_datumi::cena_proizvoda($stavka->id, $danas) * proizvodi::proizvod_kolicina($stavka->id);			
			}
			$suma_proizvoda = $suma_proizvoda + $suma_magacini;
			   //var_dump($isplate_dobavljacima); die();

			$veze = veza::all();
			$zbir_veza = 0;
			foreach ($veze as $veza) {

				$zbir_veza = proizvodi::kolicina_pakovanje($veza->kolicina, $veza->pakovanje, $veza->proizvod, $zbir_veza, $veza->created_at);
			}

			if (empty($kupac_uplata)) {
				Session::flash('err', AdminOptions::lang(251, Session::get('jezik.AdminOptions::server()')) );
				return Redirect::back();
			}

			$zaduzenje_svih_radnika = upisaniproizvod::where('created_at', $danas)->where('proizvod', '!=', 0)->get();
			$suma_zaduzenja = 0;
			foreach ($zaduzenje_svih_radnika as $value) {				
				$suma_zaduzenja = proizvodi::kolicina_pakovanje($value->kolicina2, $value->pakovanje2, $value->proizvod, $suma_zaduzenja, $value->created_at);
			}

			$razduzenje_radnika = razduzenjeradnika::where('created_at', $danas)->get();
			//var_dump($razduzenje_radnika);die();
			$suma_razduzenja = 0;
			foreach ($razduzenje_radnika as $value) {				
				$suma_razduzenja = proizvodi::kolicina_pakovanje($value->kolicina, $value->pakovanje, $value->proizvod, $suma_razduzenja, $value->created_at);
			}
			/*echo $suma_zaduzenja."<br>";
			echo $suma_razduzenja;die();*/






			return View::make('welcome', array(
				'uplata_nacin' => $kupac_uplata,
				'uplata_dobavljaca_nacin' => $uplata_dobavljaca_nacin,
				'zbir_nacin' => $zbir_nacin,
				'razduzenja' => $kupac1,
				'uplate' => $uplate,
				'otpis_zbir' => $otpis_zbir,
				'isplate_dobavljacima' => $isplate_dobavljacima,
				'isplate' => $isplate,
				'ziralna_uplata' => $ziralna_uplata,
				'suma_proizvoda' => $suma_proizvoda,
				'suma_magacini' => $suma_magacini,
				'suma_zaduzenja' => $suma_zaduzenja,
				'suma_razduzenja' => $suma_razduzenja,
				'brojac' => $brojac,
				'dugovanje' => $dugovanje,
				'unos_dobavljaca' => $dobavljac,
				'vrsta_prodaje' => $vrsta_prodaje,
				'zbir_veza' => $zbir_veza,
				'ispaceni_dobavljaci' => $ispaceni_dobavljaci,
				'suma' => $suma
			));			   
		}
		else{
			return View::make('welcome');
		}
	}

	public function home(){
		if ($_GET['id']=0) {		
			Privremena_tabela::truncate();
			$data = new Privremena_tabela();
			$data->radnik = 1;
			$data->kupac = 1;
			$data->save();
			return View::make('pages.home');
		}

		if ($_GET['id']=1) {
			
			$data = proizvodi::where('aktivan', 1)->orderBy('grupa_proizvoda', 'ASC')->get();
			return View::make('pages.home', array('data1' => $data, 'pom' => 2));
		}

	}

}
