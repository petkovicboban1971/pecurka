<?php

class PregledRadnikaController extends \BaseController {

	public function pregled_radnika(){

		return View::make('pages.pregledRadnika');
	}

	public function zaduzeni_radnik(){

		$data2 = DB::table('zaduzenjeKupac')->where('created_at', date('Y-m-d'))
											->where('radnik_id', $_GET['radnik'])
											->get();
		if (!empty($data2)) {

			foreach ($data2 as $key => $data4) {
				
				$data3[$key] = DB::table('zaduzenjeKupac')->where('zaduzenjeKupac_id', $data4->id)->get();
			}
		
			return View::make('pages.zaduzeniRadnik', array('radnik' => $_GET['radnik'], 
															'data2' => $data2, 
															'data3' => $data3));
		}
		else{
			Session::flash('Message', AdminOptions::lang(144, Session::get('jezik.AdminOptions::server()')) );
			return Redirect::back();
		}
	}


	public function ocitavanje_kupca(){

		$data = DB::table('zaduzenjeKupac')->where('kupac_id', $_GET['kupac'])
											->where('radnik_id', $_GET['radnik'])
											->where('created_at', date("Y-m-d"))
											->orderBy('id', 'DESC')->first();
		
		
			$data1 = DB::table('zaduzenjeKupac')->where('zaduzenjeKupac_id', $data->id)->get();

		//var_dump($data1);die();
		$object = (object) $data1;
		//var_dump($object);die();
		return View::make('pages.konacnoZaduzenje', array('data0' => $object, 'radnik_id' => $_GET['radnik'], 'kupac_id' => $_GET['kupac']));
	}
	

	public function faktura_posebno($id, $id1){
		
		$data = DB::table('zaduzenjeKupac')->where('kupac_id', $id)
										   ->where('radnik_id', $id1)
										   ->where('created_at', date('Y-m-d'))
										   ->first();	

		$data1 = DB::table('zaduzenjeKupac')->where('zaduzenjeKupac_id', $data->id)->get();
		//var_dump($data1);die();

		$object = (object) $data1;
		//var_dump($object);die();
		return View::make('pages.konacnoZaduzenje', array('data0' => $object, 'radnik_id' => $data->radnik_id, 'kupac_id' => $data->kupac_id));
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
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
