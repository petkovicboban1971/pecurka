<?php

class LiveController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function zaduzenje_radnika2()
	{
		$radnici = radnici::where('aktivan', 1)->get();
		$magacini = magacini::where('aktivan', 1)->get();
		$proizvodi = proizvodi::where('aktivan', 1)->get();

		return View::make('pages.zaduzeni_radnik3', array(
			'radnici' 	=> 	$radnici,
			'magacini'	=> 	$magacini,
			'proizvodi' => 	$proizvodi, 
			'izbor' 	=> 	0, 
			'opcija' 	=> 	1, 
			'text' 		=> 	AdminOptions::lang(119, Session::get('jezik.AdminOptions::server()'))
		));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function zaduzenje_radnika3()
	{
		$data = array(
			'magacin'	=>	$_POST['magacin'],
			'proizvod'	=>	$_POST['proizvod'],
			'kolicina'	=>	$_POST['kolicina'],
		);
		 return json_encode($data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function zaduzenje_radnika23()
	{
		
		$data = $_GET['radnik'];
		return Redirect::back();
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
