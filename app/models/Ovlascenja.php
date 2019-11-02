<?php	
	class Ovlascenja extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'ovlascenja';

    protected $primaryKey = 'id';
/*
    public function proizvodi(){

        return $this->hasMany('grupa_proizvoda', 'grupa_proizvoda_id');
    }*/
}