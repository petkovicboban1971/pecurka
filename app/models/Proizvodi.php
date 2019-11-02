<?php	
	class proizvodi extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'proizvodi';

    protected $primaryKey = 'id';


    /*public function cene_datumi(){

        return $this->hasMany('cene_datumi');
    }*/

   /* public static function proizvod($id){

        return DB::table('proizvodi')->where('proizvod_id', $id)->pluck('naziv_proizvoda');
        
    }*/

    public static function proizvodTemp($proizvod_id){

        return DB::table('proizvodi')->where('proizvod_id', $proizvod_id)->pluck('id');
        
    }

    public function veza()
    {
        return $this->hasMany('veza', 'proizvod');
    } 

    public static function idProizvoda($id){

        return DB::table('proizvodi')->where('naziv_proizvoda', $id)->id;
    }

    public static function procenat($id, $kolicina){

        $procenat1 = proizvodi::find($id);
        $procenat = number_format(($kolicina/$procenat1->kolicina_pocetak)*100,2,',','.');
        return $procenat;
    }


    public static function kolicina_pakovanje($id1, $id2, $id3, $zbir, $datum='1970-01-01'){

        if($id2 == 0){
            $univerzal = $id1;
        }
        else{
            $univerzal = $id2;
        }
        $zbir = $zbir + $univerzal * cene_datumi::cena_proizvoda($id3, $datum);
        return $zbir;        
    }

    public static function odluka($id1, $id2){

        if($id2 == 0){
            $univerzal = $id1." kg";
        }
        else{
            $univerzal = $id2." ".AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()'));
        }
        return $univerzal;
    }

    public static function odluka_brojcano($id1, $id2){

        if($id2 == 0){
            $univerzal = $id1;
        }
        else{
            $univerzal = $id2;
        }
        return $univerzal;
    }

    public static function proizvod_kolicina($id){

        $data = proizvodi::find($id)->tezina_pakovanja;
        if ($data == 0) {
            $data = proizvodi::find($id)->kolicina_proizvoda;
        }
        else{
            $data = proizvodi::find($id)->pakovanje;
        }
        return $data;
    }

    public static function proizvod_kolicina_otpis($id, $id2){

        $data = proizvodi::find($id);
        if ($data->tezina_pakovanja == 0) {
            $data->kolicina_proizvoda = $data->kolicina_proizvoda - $id2; 
        }
        else{
            $data->pakovanje = $data->pakovanje - $id2;
        }

        $data->update();
        return $data;
    }

    public static function odluka_otpis($id){

        $data = proizvodi::find($id);

        if ($data->tezina_pakovanja == 0) {
            $data = "kg";
        }
        else{
            $data = AdminOptions::lang(211, Session::get('jezik.AdminOptions::server()'));
        }
        return $data;
    }
}