<?php	
	class Privremena_tabela extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'privremena_tabela';

    protected $primaryKey = 'id';

    public static function radnik(){

    	return DB::table('privremena_tabela')->where('radnik', '!=', 0)->first()->radnik;
    	
    }    

    public static function kupac(){

        return DB::table('privremena_tabela')->where('kupac', '!=', 0)->first()->kupac;
        
    }

    public static function kolicina($id){

        return DB::table('privremena_tabela')->where('kolicina', $id);
        
    }

    public static function cena($id){

        return DB::table('privremena_tabela')->where('cena', $id);
        
    }


    public static function procenat($id){

        return DB::table('privremena_tabela')->where('zarRad', $id);
        
    } 

    public static function proizvod_id(){

        return DB::table('privremena_tabela')->orderBy('id', 'DESC')->first()->proizvod_id;
        
    }    

    public static function celaTabela(){

       return DB::table('privremena_tabela')->get();
        
    } 

}