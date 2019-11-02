<?php
	class upisaniproizvod extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'upisaniproizvod';

    protected $primaryKey = 'id';

  	public static function pakovanjeKolicina($id1){

  		$data = DB::table('proizvodi')->where('id', $id1)->pluck('pakovanje');
  		if ($data == 0) {
  			$data = DB::table('upisaniproizvod')->where('proizvod', $id1)->pluck('kolicina');
  			$data = $data." kg";
  		}
  		else{
  			$data = DB::table('upisaniproizvod')->where('proizvod', $id1)->pluck('pakovanje');
  			$data = $data." ".AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()'));
  		}
  		return $data;
  	}
}