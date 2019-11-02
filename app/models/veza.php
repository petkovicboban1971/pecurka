<?php

class veza extends Eloquent {

	protected $guarded = [];

	protected $table = 'veza';

	protected $primaryKey = 'id';

    public function radnici()
    {
        return $this->belongsTo('Radnici');
    }



    public function proizvodi(){        
        return $this->belongsTo('proizvodi');
    }
   
    public static function zbirKolicina($proizvod, $magacin){

        $niz = DB::table('veza')->where('proizvod', $proizvod)->where('magacin', $magacin)->get();
/*
        var_dump($niz);die();*/
    }
}
