<?php

class WorkersController extends \BaseController {


	public function obracun_plata(){
		
		$data = DB::table('radnici')->where('aktivan', 1)
									->orderBy('rola', 'ASC')
									->get();
		return View::make('welcome', array(
			'radnici' => $data, 
			'pom' => 10
		));
	}


	public function izbor_radnika($id=0){
		
		$poslednja_isplata = DB::table('plate_radnika')->where('radnik', $_POST['izabrani_radnik'])->orderBy('created_at', 'DESC')->first();


		$pom1 = $_POST['pocetni'];
		$niz1 = (str_split($pom1));
		$niz2 = $niz1;
		$niz2[0] = $niz1[3];
		$niz2[1] = $niz1[4];
		$niz2[3] = $niz1[0];
		$niz2[4] = $niz1[1];
		$_POST['pocetni'] = join($niz2);

		$pocetni1 = date_format(date_create($_POST['pocetni']), "Y-m-d");
		if($id == 0){
			if (!null == $poslednja_isplata) {
				
				if ($poslednja_isplata->period_do >= $pocetni1) {
					Session::flash('err', AdminOptions::lang(232, Session::get('jezik.AdminOptions::server()'))." ".AdminOptions::lang(233, Session::get('jezik.AdminOptions::server()'))." ".date_format(date_create($poslednja_isplata->period_do), "d.m.Y."));
					return Redirect::back();
				}
			}
		}
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
			$krajnji = date("Y-m-d");
		}

		if ($krajnji < $pocetni) {
			
			Session::flash('err', AdminOptions::lang(230, Session::get('jezik.AdminOptions::server()')));
			return Redirect::back();
		}

		$procenat = 0;
		$datum = [];

		$period_razduzenje = DB::table('razduzenjeRadnika')->where('radnik', $_POST['izabrani_radnik'])
													  ->where('created_at', '>=', $pocetni)
													  ->where('created_at', '<=', $krajnji)
													  ->orderBy('created_at', 'ASC')
													  ->where('kupac', '>', 0)
													  ->get();

		foreach ($period_razduzenje as $key => $period) {
			if (Radnici::find($_POST['izabrani_radnik'])->nacin_zarade1 > 0) {

				$procenat = $procenat + cene_datumi::cena_proizvoda($period->proizvod, $period->created_at) * razduzenjeRadnika::pakovanjeKolicinaSvi($period->proizvod, $period->id,'razduzenjeRadnika') ;
				
			}	
			$datum[$key] = $period->created_at;
		}
		$procenat = $procenat * Radnici::find($_POST['izabrani_radnik'])->nacin_zarade1;
		if (empty($period_razduzenje)) {
			$period_razduzenje = null;
		}

		$datumi = array_values(array_filter(array_unique($datum)));

		$plata = Radnici::find($_POST['izabrani_radnik'])->nacin_zarade + $procenat;

		if ($id == 0) {
			$stranica = 11;
		}
		elseif ($id == 1) {
			$stranica = 13;
		}

		return View::make('welcome', array (
			'pom' => $stranica,
			'radnik' => $_POST['izabrani_radnik'],
			'specifikacije' => $period_razduzenje,
			'poslednja_isplata' => $poslednja_isplata,
			'datumi' => $datumi,
			'pocetni' => $pocetni,
			'krajnji' => $krajnji,
			'plata' => $plata
		));
	}


	public function storeWorker()
	{
		$data = new Worker;
		$data->ime = Input::get('ime');
		$data->prezime = Input::get('prezime');
		$data->grad = Input::get('grad');
		$data->ulica = Input::get('ulica');
		$data->broj = Input::get('broj');
		$data->jmbg = Input::get('jmbg');
		$data->brlk = Input::get('brlk');
		$data->pu = Input::get('pu');
		$data->nacin_zarade = Input::get('plata');
		$data->nacin_zarade1 = Input::get('procenat');
		$data->status = Input::get('status');
		$data->rola = Input::get('rola');
		$data->save();


		Session::flash('success', AdminOptions::lang(88, Session::get("jezik.AdminOptions::server()"))); 
		return View::make("workers", array('pom'=>4));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){

		$data = Worker::find($id);
		if ($_POST['ime']) {
			$data->ime = $_POST['ime'];
		}
		if ($_POST['prezime']) {
			$data->prezime = $_POST['prezime'];
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
		if ($_POST['jmbg']) {
			$data->jmbg = $_POST['jmbg'];
		}		
		if ($_POST['brlk']) {
			$data->brlk = $_POST['brlk'];
		}		
		if ($_POST['pu']) {
			$data->pu = $_POST['pu'];
		}		
		if ($_POST['plata']) {
			$data->nacin_zarade = $_POST['plata'];
		}	
		if ($_POST['procenat']) {
			$data->nacin_zarade1= $_POST['procenat'];
		}		
		if ($_POST['status']) {
			$data->status = $_POST['status'];
		}
		$data->update();
		Session::flash('success', AdminOptions::lang(89, Session::get("jezik.AdminOptions::server()")));
		return View::make('workers', array('pom' => 4));
	}

	public function finding($id){

		$data = Worker::find($id);		
		return View::make("workers", array(
			'data'=> $data, 
			'pom' => 4
		));
	}


	public function destroy($id)
	{
		$worker = Worker::find($id);
		$worker->aktivan = 0;
		$worker->update();
		
		Session::flash('success', AdminOptions::lang(90, Session::get("jezik.AdminOptions::server()")));	
		return View::make('workers', array('pom' => 4));
	}

	public function workers()
	{
		return View::make('workers');
	}

	public function workers1()
	{
		return View::make('workers', array('pom' => 4));
	}

	public function workers2()
	{
		return View::make('workers', array('pom' => 3));
	}

	public function workers3(){

		return View::make('workers', array('pom' => 6));
	}



	public function istorija_obracuna(){
		$data = DB::table('radnici')->orderBy('rola', 'ASC')
									->get();
		return View::make('welcome', array(
			'radnici' => $data, 
			'pom' => 12
		));
	}

	public function istorija_platnih_listi(){


	}
}
