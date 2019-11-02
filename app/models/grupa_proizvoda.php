<?php	
	class grupa_proizvoda extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'grupa_proizvoda';

    protected $primaryKey = 'id';

    /*public function grupa_proizvoda(){

        return $this->belongsTo('proizvodi', 'grupa_proizvoda');
    }*/

}