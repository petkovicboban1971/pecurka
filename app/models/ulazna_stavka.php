<?php
	class ulazna_stavka extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'ulazna_stavka';

    protected $primaryKey = 'ulazna_stavka_id';

    public static function Stavke(){

    	return Ulazna_stavka::all();
    }

}