<?php
	class proizvod_magacin extends Eloquent {

	    protected $guarded = [];
		
		protected $table = 'proizvod_magacin';

	    protected $primaryKey = 'id';

	    public function deo_lagera($magacin, $proizvod, $kolicina){
	    	
	    }

	}

?>