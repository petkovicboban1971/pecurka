<?php
  	class RazduzenjeRadnika extends Eloquent {

        protected $guarded = [];
    	
    	protected $table = 'razduzenjeRadnika';

        protected $primaryKey = 'id';

        public static function pakovanjeKolicina($id1){

    		$datas = DB::table('proizvodi')->where('id', $id1)->pluck('tezina_pakovanja');
    		if ($datas == 0) {
    			    $data = DB::table('razduzenjeRadnika')->where('proizvod', $id1)->pluck('kolicina');
    		}
    		else{
    			$data = DB::table('razduzenjeRadnika')->where('proizvod', $id1)->pluck('pakovanje');
    		}
    		return $data;
      	}        


        public static function pakovanjeKolicinaSvi($id1, $id2, $id3){

            $datas = proizvodi::where('id', $id1)->pluck('tezina_pakovanja');

            if ($datas == 0) {
                    $data = DB::table($id3)->where('id', $id2)->pluck('kolicina');
            }
            else{
                $data = DB::table($id3)->where('id', $id2)->pluck('pakovanje');
            }
            return $data;
        }

        public static function razduzenja($id1, $id2){

            if($id1 > 0){ 
                $data0 = DB::table('razduzenjeRadnika')->where('kupac', $id1)
                                                       ->where('nacin', $id2)
                                                       ->get();
                $suma = 0;
                foreach($data0 as $data1){
                    $suma = $suma + cene_datumi::cena_proizvoda($data1->proizvod, $data1->created_at) * RazduzenjeRadnika::pakovanjeKolicinaSvi($data1->proizvod, $data1->id, 'razduzenjeRadnika');
                }
                if (null == $suma) {
                    $suma = 0;
                }
                return $suma;
            }
        }
    }
?>