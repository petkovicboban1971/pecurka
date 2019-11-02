<?php
	class Form {
		public static function view($id){
			$result=DB::table('ulazne_stavke')->where('ulazne_stavke_id', $id)->first();
			print_r($result);
			die();
			return $result;
		}

	public function pom($id)
		{
			$pom = Ulazna_stavka::find($id)->pluck('ulazna_stavka');
			return $pom;
		}							
	}