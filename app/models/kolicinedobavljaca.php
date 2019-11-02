<?php
	class kolicinedobavljaca extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'kolicinedobavljaca';

    protected $primaryKey = 'id';

    public static function dobavljac($id1, $id2){

    	$data = DB::table('kolicinedobavljaca')->orderBy('dobavljac', 'ASC')
                                               ->where('dobavljac', $id1)
                                               ->where('proizvod', $id2)
                                               ->get();
    	return $data;
    }

    public static function dobavljacSuma($id1){

        $total = DB::table('kolicinedobavljaca')->where('dobavljac', $id1)
        										->sum('kolicina');
    	return $total;
    }

    public static function ukupnaSuma(){

    $pom = dobavljaci::all();
    $suma = 0;

	    foreach ($pom as $value) {

	    	$data = kolicinedobavljaca::dobavljacSuma($value->id);
	    	$suma = $suma + $data;
	    }
    	
    	return $suma;
    }

    public static function razmera($id){

        $pom = 0;
        $dobavljaci = DB::table('dobavljaci')->get();
        $dobavljac = count($dobavljaci);
        foreach ($dobavljaci as $value) {
            
          $pom1 = DB::table('kolicinedobavljaca')->where('proizvod', $id)
                                                 ->where('dobavljac', $value->id)
                                                 ->sum('kolicina');
          $pom = $pom + $pom1; 
        }

        return $pom;
    }

    public static function uplate_dobavljaca($id1){

        $uneta_kolicina = 0;
        $datas = DB::table('kolicinedobavljaca')->where('dobavljac', $id1)->get();
        foreach ($datas as $key => $data) {
            $uneta_kolicina = $uneta_kolicina + razduzenjeRadnika::pakovanjeKolicinaSvi($data->proizvod, $data->id, 'kolicinedobavljaca')  * cene_datumi::cena_proizvoda($data->proizvod, $data->created_at);
        }
        return $uneta_kolicina;
    }

    public static function procenat_iznos($id=0){
        $zbir1 = 0;
        $suma1 = kolicinedobavljaca::all();

        foreach ($suma1 as $suma) {

            if($suma->tezina_pakovanja == 0){
                $univerzal = $suma->kolicina;
            }
            else{
                $univerzal = $suma->pakovanje;
            }
            $zbir1 = $zbir1 + $univerzal * cene_datumi::cena_proizvoda($suma->proizvod, $suma->created_at);
        }

        return $zbir1;
    }    

    public static function procenat_iznos1($id){
        $zbir2 = 0;
        $total = DB::table('kolicinedobavljaca')->where('dobavljac', $id)->get();
        foreach ($total as $value) {
           
            if($value->tezina_pakovanja == 0){
                $univerzal = $value->kolicina;
            }
            else{
                $univerzal = $value->pakovanje;
            }
            $zbir2 = $zbir2 + $univerzal * cene_datumi::cena_proizvoda($value->proizvod, $value->created_at);
        }

        //echo $zbir2; die();
        return $zbir2; 
    }

}