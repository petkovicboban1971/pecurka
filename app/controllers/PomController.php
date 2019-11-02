public function otkazUpisa($id){

		/*$proveraRadnika = DB::table('upisaniproizvod')->where('radnik', '<>', 0)->orderBy('id', 'DESC')->first();
		$proveraKolicine = DB::table('upisaniproizvod')->where('radnik_id', $proveraRadnika->id)->orderBy('id', 'DESC')->first();
		if ($proveraKolicine->kolicina == 0) {
			$pom = upisaniproizvod::find($proveraKolicine->id);
			$pom->delete();
			
		}*/

		$proveraUpisa = DB::table('upisaniproizvod')->where('radnik', '!=', 0)
													->orderBy('id', 'DESC')
													->first()
													->id;
		if (!empty($proveraUpisa)) {
			$proveraProizvoda = DB::table('upisaniproizvod')->where('id', '>', $proveraUpisa)->get();
			if (!empty($proveraProizvoda)) {
				foreach ($proveraProizvoda as $value) {
					upisaniproizvod::find($value->id)->delete();
				}
			}
			upisaniproizvod::find($proveraUpisa)->delete();
		}

		$proizvodi = DB::table('proizvodi')->orderBy('grupa_proizvoda', 'DESC')->get();
		$grupe_proizvoda = DB::table('Grupa_proizvoda')->orderBy('id', 'DESC')->get();

		return View::make('pages.zaduzeniRadnik3', array('opcija' => 1, 'izbor' => 1, 'radnik' => $id, 'proizvodi' => $proizvodi, 'grupe_proizvoda' => $grupe_proizvoda, 'text' => AdminOptions::lang(119, Session::get('jezik.AdminOptions::server()'))));
	}