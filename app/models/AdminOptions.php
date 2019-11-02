<?php 
	class AdminOptions {
	
		public static function base_url(){
			
			return DB::table('routes')->where('routes_id',1)->pluck('route');
		}
	
		public static function company_name(){
			$firma=DB::table('firma')->get();
			foreach($firma as $row){
				return $row->naziv;
			}
			
		}
		public static function server(){
        	return DB::table('routes')->where('routes_id',1)->pluck('route');
    	}
	
		public static function findSession($param1,$param2){
        	return DB::table($param1)->where($param1.'_id', Session::get('log_sesija'.AdminOptions::server()))->pluck($param2);
    	}


		public static function izborJezika($jezik){
			Session::forget('jezik.AdminOptions::server()');
			return Session::put('jezik.AdminOptions::server()', $jezik);
			
		}

    	public static function lang($id, $lang){
    			return DB::table('jezici')->where('jezici_id', $id)->pluck($lang);
    	
    	}
	}	
 ?>