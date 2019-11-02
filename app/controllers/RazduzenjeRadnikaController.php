<?php

class RazduzenjeRadnikaController extends \BaseController {

	public function razduzenje_radnika(){
		
		$data = DB::table('upisaniproizvod')->get();
		return View::make('pages.razduzenjeRadnika', array('data' => $data));
	}

	public function razduzeniRadnik($id){

		$radnik = DB::table('upisaniproizvod')->where('radnik', $id)->first();
		$proizvodi = DB::table('upisaniproizvod')->where('parent_id', $radnik->id)->get();
		return View::make('pages.razduzenjeRadnika2', array(
			'radnici' => $radnik, 
			'proizvodi' => $proizvodi
		));
	}

	public function razduzenje_pom($id){
				
		$novi = upisaniproizvod::find($id);
		return View::make('pages.kolicina_razduzenja', array('novi' => $novi));
	}

	public function razduzenjeRadnika2(){

		$novi1 = upisaniproizvod::find($_POST['izbor']);							

		if($novi1->pakovanje == 0){
			$novi1->kolicina = $novi1->kolicina - $_POST['novaKolicina'];
		}
		else{
			$novi1->pakovanje = $novi1->pakovanje - $_POST['novaKolicina'];
			$novi1->kolicina = $novi1->pakovanje * proizvodi::find($novi1->proizvod)->tezina_pakovanja;
		}

		if ($novi1->kolicina < 0 || $novi1->pakovanje < 0) {
			Session::flash('msg', AdminOptions::lang(186, Session::get('jezik.AdminOptions::server()')));
			return Redirect::back();
		}

		$brojac = 0;

		if ($_POST['kupac'] < 0) {

			$kolicinaMagacin = proizvodi::find($_POST['proizvod']);
			if (proizvodi::find($_POST['proizvod'])->tezina_pakovanja == 0) {
				$kolicinaMagacin->kolicina_proizvoda = proizvodi::find($_POST['proizvod'])->kolicina_proizvoda + $_POST['novaKolicina'];
			}
			else{
				$kolicinaMagacin->pakovanje = proizvodi::find($_POST['proizvod'])->pakovanje + $_POST['novaKolicina'];
			}
			$kolicinaMagacin->update();

			$veza = new veza();
			$veza->radnik = $_POST['radnik'];
			$veza->proizvod = $_POST['proizvod'];
			if (proizvodi::find($_POST['proizvod'])->tezina_pakovanja == 0) {
				$veza->kolicina = $_POST['novaKolicina'];
			}
			else{
				$veza->pakovanje = intval($_POST['novaKolicina']);
				$veza->kolicina = 0;
			}
			$veza->magacin = abs($_POST['kupac']);
			$veza->parent_id = $_POST['izbor'];
			$veza->save();
			$brojac = 1;
		}		

		$novi1->update();
		

		$razduzenje = new razduzenjeRadnika();
		$razduzenje->radnik = $_POST['radnik'];
		$razduzenje->proizvod = $_POST['proizvod'];
		if(proizvodi::find($_POST['proizvod'])->tezina_pakovanja == 0){
			$razduzenje->kolicina = $_POST['novaKolicina'];
		}
		else{
			$razduzenje->pakovanje = $_POST['novaKolicina'];
		}
		$razduzenje->kupac = $_POST['kupac'];
		if (isset($_POST['nacin'])) {
			$razduzenje->nacin = $_POST['nacin'];
			if ($_POST['nacin'] == -1) {
				$otpis = new otpis();
				$otpis->proizvod = $_POST['proizvod'];
				$otpis->kupac = $_POST['kupac'];
				$otpis->kolicina = $_POST['novaKolicina'];
				$otpis->opis = AdminOptions::lang(256, Session::get('jezik.AdminOptions::server()')). " ".radnici::find(Session::get('log_sesija'.AdminOptions::server()))->ime." ".radnici::find(Session::get('log_sesija'.AdminOptions::server()))->prezime;
				$otpis->created_at = date('Y-m-d');
				$otpis->save();
			}
		}
		$razduzenje->parent_id = $_POST['izbor'];
		$razduzenje->created_at = date('Y-m-d');
		$razduzenje->save();

		if ($novi1->kolicina == 0) {

			$provera = upisaniproizvod::where('parent_id', $_POST['izbor'])->get();
			if (count($provera) == 0) {				
				return Redirect::to('/razduzenje-radnika');
			}
		}

		if ($brojac == 0) {
			Session::flash('veza', AdminOptions::lang(189, Session::get('jezik.AdminOptions::server()')));
		}

		if ($brojac == 1) {
			Session::flash('veza', AdminOptions::lang(188, Session::get('jezik.AdminOptions::server()')).abs($_POST['kupac']));
		}

		if ($novi1->kolicina == 0) {
			return Redirect::to('/razduzenje-radnika');
		}

		return Redirect::to('/razduzeniRadnik/'.$_POST['radnik']);

	}

	public function istorija_radnika(){
		$data = Radnici::all();
		return View::make('pages.istorija_radnika', array('radnici' => $data));
	}


	public function istorija_radnika1($id){

		$data = Radnici::all();
		$radnik = Radnici::find($id);
		return View::make('pages.istorija_radnika', array(
			'radnik' => $radnik, 
			'radnici' => $data, 
			'istorija' => 1
		));
	}

	public function istorija_datum(){

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
			
		if ($krajnji < $pocetni) {
			
			Session::flash('err', AdminOptions::lang(230, Session::get('jezik.AdminOptions::server()')));
			return Redirect::back();
		}

		$period_radnik1 = DB::table('upisaniproizvod')->where('radnik_id', $_POST['radnik'])
													  ->where('created_at', '>=', $pocetni)
													  ->where('created_at', '<=', $krajnji)
													  ->orderBy('created_at', 'ASC')
													  ->get();

		$period_razduzenje = DB::table('razduzenjeRadnika')->where('radnik', $_POST['radnik'])
													  ->where('created_at', '>=', $pocetni)
													  ->where('created_at', '<=', $krajnji)
													  ->orderBy('created_at', 'ASC')
													  ->get();

		return View::make('pages.istorija_radnik', array(
			'id' => $_POST['radnik'], 
			'period' => $period_radnik1,
			'period_razduzenje' => $period_razduzenje, 
			'pocetni' => $pom1, 
			'krajnji' => $pom2
		));
	}


}
