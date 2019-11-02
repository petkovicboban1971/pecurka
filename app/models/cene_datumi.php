<?php
	class cene_datumi extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'cene_datumi';

    protected $primaryKey = 'id';

/*    public function proizvodi(){
    	return $this->belongsTo('proizvodi');
    }*/

    public static function cena_proizvoda($ida, $idb){

    	$data12 = cene_datumi::where('proizvod_id', $ida)
                                ->where('created_at', $idb)
                                ->pluck('cene');
        if($data12 == null){

            $data12 = cene_datumi::where('proizvod_id', $ida)
                                ->orderBy('created_at', 'DESC')
                                ->where('created_at', '<', $idb)
                                ->pluck('cene');
        }
    	return $data12;
    }

}