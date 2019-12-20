<?php

class ZaduzenjeController extends \BaseController{

	public function zaduzenje_radnika(){
		
		$radnici = DB::table('radnici')->where('aktivan', 1)
									   ->orderBy('prezime', 'ASC')
									   ->orderBy('ime', 'ASC')
									   ->get();
		$prethodnoZaduzeni = veza::all();
		return View::make('pages.zaduzeniRadnik', array(
			'opcija' => 1, 
			'text' => AdminOptions::lang(115, Session::get('jezik.AdminOptions::server()')), 
			'izbor' => 2, 
			'prethodnoZaduzeni' => $prethodnoZaduzeni, 
			'radnici' => $radnici
		));
	}

	public function zaduzenjeRadnika2(){

		$radnici = DB::table('radnici')->where('aktivan', 1)
									   ->orderBy('prezime', 'ASC')
									   ->orderBy('ime', 'ASC')
									   ->get();
		$prethodnoZaduzeni = veza::all();
		return View::make('pages.zaduzeniRadnik2', array(
			'opcija' => 1, 
			'text' => AdminOptions::lang(115, Session::get('jezik.AdminOptions::server()')), 
			'izbor' => 2, 
			'prethodnoZaduzeni' => $prethodnoZaduzeni, 
			'radnici' => $radnici
		));
	}

	public function zaduzenjeRadnika3($id){

		$provera1 = !empty(upisaniproizvod::max('id')) ? upisaniproizvod::max('id') : '1';

		if(!empty(veza::where('radnik', $id)->first())){
				
			$pom = veza::where('radnik', $id)->first()->id;
			$pomm = veza::where('radnik', $id)->get();
			foreach ($pomm as $value1) {
				
				$kolicinaIzMagacina = veza::find($value1->id);
				$kolicinaProizvoda = proizvodi::find($kolicinaIzMagacina->proizvod);
				if ($value1->pakovanje == 0){

					$kolicinaProizvoda->kolicina_proizvoda = $kolicinaProizvoda->kolicina_proizvoda - $kolicinaIzMagacina->kolicina;
				}	
				else{
					$kolicinaProizvoda->kolicina_proizvoda = $kolicinaProizvoda->kolicina_proizvoda - $kolicinaIzMagacina->pakovanje * proizvodi::find($kolicinaIzMagacina->proizvod)->tezina_pakovanja;
				}

				if (($kolicinaProizvoda->kolicina_proizvoda < 0) && ($kolicinaProizvoda->pakovanje < 0)) {
					Session::flash('Message', AdminOptions::lang(170, Session::get('jezik.AdminOptions::server()')));

					return Redirect::back();
				}

				$kolicinaProizvoda->update();
			}
			
			$pom2 = !empty(upisaniproizvod::where('radnik', $id)->first()->id) ? upisaniproizvod::where('radnik', $id)->first()->id : $id;

			$upisRadnika = new upisaniproizvod;
			$upisRadnika->radnik = $id;
			$upisRadnika->save();
			$provera1 = upisaniproizvod::max('id');

			foreach (veza::where('radnik', $id)->get() as $value) {
				$upisRadnika = new upisaniproizvod;
				$upisRadnika->proizvod = $value->proizvod;
				if ($value->pakovanje == 0){
					$upisRadnika->kolicina = $value->kolicina;
					$upisRadnika->kolicina2 = $value->kolicina;
				}
				else{
					$upisRadnika->kolicina = proizvodi::find($value->proizvod)->tezina_pakovanja * $value->pakovanje;
					$upisRadnika->kolicina2 = $upisRadnika->kolicina;
					$upisRadnika->pakovanje = $value->pakovanje;
					$upisRadnika->pakovanje2 = $value->pakovanje;
				}
				$upisRadnika->radnik_id = $id;
				$upisRadnika->parent_id = $pom2;
				$upisRadnika->save();				
			}

			$pom3 = DB::table('upisaniproizvod')->where('radnik', $id)
												->where('id', '!=', $pom2)
												->get();

			foreach ($pom3 as $value){
				upisaniproizvod::find($value->id)->delete();
			}

			foreach(veza::where('radnik', $id)->get() as $veza){
				veza::find($veza->id)->delete();
			}

			Session::flash('Success', AdminOptions::lang(172, Session::get('jezik.AdminOptions::server()')));

			return Redirect::to('/zaduzeniRadnik31/'.$id);
			
		}

		$upisRadnika = new upisaniproizvod;
		$upisRadnika->radnik = $id;
		$upisRadnika->save();

		$proizvodi = DB::table('proizvodi')->orderBy('grupa_proizvoda', 'DESC')->get();
		$grupe_proizvoda = DB::table('grupa_proizvoda')->orderBy('id', 'DESC')->get();

		return View::make('pages.zaduzeniRadnik3', array(
			'opcija' => 1, 
			'radnik' => $id, 
			'proizvodi' => $proizvodi, 
			'grupe_proizvoda' => $grupe_proizvoda, 
			'izbor' => 1, 
			'text' => AdminOptions::lang(119, Session::get('jezik.AdminOptions::server()'))
		));

	}

	public function zaduzenjeRadnika4(){

		Session::put('idProizvoda', $_POST['Product']);
		$pomRadnik = upisaniproizvod::where('radnik', $_POST['Id'])->first();

		$upisProizvoda = new upisaniproizvod;
		$upisProizvoda->proizvod = Session::get('idProizvoda');
		$upisProizvoda->radnik_id = $pomRadnik->radnik;
		$upisProizvoda->parent_id = $pomRadnik->id;
		$upisProizvoda->save();

		$pom1 = upisaniproizvod::all();

		foreach ($pom1 as $key => $value1) {
			for ($i=0; $i<count($value1)-1; $i++) {
				if ($value1[$i]->id > $value1[$key]->id) {
					if(($value1[$i]->radnik != 0) && ($value1[$i]->radnik == $value1[$key]->radnik)){
						upisaniproizvod::find($value1[$i]->id)->delete();
					}
				}
			}
		}


	}

	public function zaduzenjeRadnika5(){
		
		$proveraRadnika = DB::table('upisaniproizvod')->where('radnik', '<>', 0)->orderBy('id', 'DESC')->first();

		if ($_GET['kolicina'] <= 0) {

			$proveraKolicine = DB::table('upisaniproizvod')->where('radnik', 0)
														   ->where('kolicina2', 0)
														   ->get();
			foreach ($proveraKolicine as $value) {
				upisaniproizvod::find($value->id)->delete();
			}

			Session::flash('Message', AdminOptions::lang(169, Session::get('jezik.AdminOptions::server()')));
			return Redirect::to('/zaduzeniRadnik31/'.$proveraRadnika->radnik);
		}

		if ((proizvodi::find(Session::get('idProizvoda'))->pakovanje < $_GET['kolicina']) && (proizvodi::find(Session::get('idProizvoda'))->kolicina_proizvoda  < $_GET['kolicina'])) {

				$brisanje = DB::table('upisaniproizvod')->where('kolicina', 0)
														->where('radnik', 0)
														->first()->id;
				upisaniproizvod::find($brisanje)->delete();

				Session::flash('Message', AdminOptions::lang(170, Session::get('jezik.AdminOptions::server()')));	
				return Redirect::to('/zaduzeniRadnik31/'.$proveraRadnika->radnik);
			}
		else
			{	
				$provera = DB::table('upisaniproizvod')->max('id');	
				$upisKolicine = upisaniproizvod::find($provera);
				if (proizvodi::find(Session::get('idProizvoda'))->tezina_pakovanja == 0) {

					$upisKolicine->kolicina = $_GET['kolicina'];
					$upisKolicine->kolicina2 = $_GET['kolicina'];
				}
				else{
					$upisKolicine->pakovanje = $_GET['kolicina'];
					$upisKolicine->pakovanje2 = $_GET['kolicina'];
					$upisKolicine->kolicina = proizvodi::find(Session::get('idProizvoda'))->tezina_pakovanja * $_GET['kolicina'];
					$upisKolicine->kolicina2 = $upisKolicine->kolicina;
				}
				$upisKolicine->update();

				$proveraRadnika1 = DB::table('upisaniproizvod')->where('radnik', '<>', 0)
																->where('radnik', $proveraRadnika->radnik)
																->orderBy('id', 'DESC')
																->get();
				
				$pomm = $proveraRadnika1[0]->id;

				if(!empty($proveraRadnika1) AND count($proveraRadnika1) > 1){

					$pom = upisaniproizvod::find($pomm);
					$pom->delete();
				}

				$novaKolicina = DB::table('proizvodi')->where('id', Session::get('idProizvoda'))->first();
				$novaKolicina1 = proizvodi::find($novaKolicina->id);
				if($novaKolicina1->pakovanje != 0){
					$novaKolicina1->kolicina_proizvoda = $novaKolicina->kolicina_proizvoda - $_GET['kolicina'] * $novaKolicina1->tezina_pakovanja;
					$novaKolicina1->pakovanje = $novaKolicina1->pakovanje - $_GET['kolicina'];
				}
				else{
					$novaKolicina1->kolicina_proizvoda = $novaKolicina->kolicina_proizvoda - $_GET['kolicina'];
				}
				$novaKolicina1->update();


				$pom1 = DB::table('upisaniproizvod')->get();

				foreach ($pom1 as $key => $value1) {
					for ($i=0; $i < count($value1)-1; $i++) {
						if ($value1[$i]->id > $value1[$key]->id) {
							if(($value1[$i]->radnik != 0) && ($value1[$i]->radnik == $value1[$key]->radnik)){
								upisaniproizvod::find($value1[$key]->id)->delete();;
							}
						}
					}
				}

				$proizvodi = DB::table('proizvodi')->orderBy('grupa_proizvoda', 'DESC')->get();
				$grupe_proizvoda = DB::table('grupa_proizvoda')->orderBy('id', 'DESC')->get();

				return View::make('pages.zaduzeniRadnik3', array(
					'opcija' => 1, 
					'radnik' => $proveraRadnika->radnik, 
					'proizvodi' => $proizvodi, 
					'izbor' => 1, 
					'grupe_proizvoda' => $grupe_proizvoda, 
					'text' => AdminOptions::lang(119, Session::get('jezik.AdminOptions::server()'))
				));
			}
	}

	public function otkazUpisa(){

		$proveraRadnika = DB::table('upisaniproizvod')->where('radnik', '<>', 0)->orderBy('id', 'DESC')->first();
		$proveraKolicine = DB::table('upisaniproizvod')->where('parent_id', $proveraRadnika->id)->orderBy('id', 'DESC')->first();
		if ($proveraKolicine->kolicina == 0) {
			$pom = upisaniproizvod::find($proveraKolicine->id);
			$pom->delete();
			
		}

		$proizvodi = DB::table('proizvodi')->orderBy('grupa_proizvoda', 'DESC')->get();
		$grupe_proizvoda = DB::table('grupa_proizvoda')->orderBy('id', 'DESC')->get();
		return View::make('pages.zaduzeniRadnik3', array(
			'opcija' => 1, 
			'izbor' => 1, 
			'radnik' => $proveraRadnika->radnik, 
			'proizvodi' => $proizvodi, 
			'grupe_proizvoda' => $grupe_proizvoda, 
			'text' => AdminOptions::lang(119, Session::get('jezik.AdminOptions::server()'))
		));
	}

	public function zaduzenjeRadnika31($id){

		$proizvodi = DB::table('proizvodi')->orderBy('grupa_proizvoda', 'DESC')->get();
		$grupe_proizvoda = DB::table('grupa_proizvoda')->orderBy('id', 'DESC')->get();

		return View::make('pages.zaduzeniRadnik3', array(
			'opcija' => 1, 
			'radnik' => $id, 
			'proizvodi' => $proizvodi, 
			'grupe_proizvoda' => $grupe_proizvoda, 
			'izbor' => 1, 
			'text' => AdminOptions::lang(119, Session::get('jezik.AdminOptions::server()'))
		));
	}

	public function krajZaduzenja(){

		$pom1 = DB::table('upisaniproizvod')->get();

		foreach ($pom1 as $key => $value1) {
			for ($i=0; $i<count($value1)-1; $i++) {
				if ($value1[$i]->id > $value1[$key]->id) {
					if(($value1[$i]->radnik != 0) && ($value1[$i]->radnik == $value1[$key]->radnik)){
						$pom = upisaniproizvod::find($value1[$key]->id);
						$pom->delete();
					}
				}
			}
		}

		$listeZaduzenja = DB::table('upisaniproizvod')->orderBy('radnik', 'ASC')->get();
		return View::make('pages.zaduzeniRadnik4', array(
			'opcija' => 1, 
			'pom' => 1, 
			'listeZaduzenja' => $listeZaduzenja, 
			'izbor' => 2, 
			'text' => AdminOptions::lang(174, Session::get('jezik.AdminOptions::server()')) 
		));
	}

}
