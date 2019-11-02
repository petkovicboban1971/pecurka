<?php

class GroupController extends \BaseController {

	public function index()
	{
		//
	}

	public function create()
	{
		//
	}

	public function saveGroup(){
		
		$data = new grupa_proizvoda;
		$data->naziv_grupe = $_POST['NovaGrupa'];
		$data->save();
		$data->grupa_id = $data->id;
		$data->update();

		Session::flash('success', AdminOptions::lang(100, Session::get("jezik.AdminOptions::server()")));
	    return View::make('workers', array('pom' => 7));
	}

	public function findGroup($id){

		$data = grupa_proizvoda::find($id);		
		return View::make("workers", array('data'=> $data, 'pom' => 7));
	}

	public function showGroup(){
		$data = DB::table('grupa_proizvoda')->get();
		return View::make("workers", array('pom' => 7));
	}

	public function updateGroup($id){

		$data = grupa_proizvoda::find($id);
		if ($_POST['naziv_grupe']) {
			$data->naziv_grupe = $_POST['naziv_grupe'];
			$data->update();

			Session::flash('success', AdminOptions::lang(102, Session::get("jezik.AdminOptions::server()")));
			return View::make("workers", array('pom' => 7));
		}
		else {
			return Redirect::back();
		}
	}

	public function deleteGroup($id){
		
		$data = grupa_proizvoda::find($id);
		$data->aktivan = 0;
		$data->update();
		Session::flash('success', AdminOptions::lang(101, Session::get("jezik.AdminOptions::server()")));
		return View::make('workers', array('pom' => 7));
	}

}
