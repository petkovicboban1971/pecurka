<?php
	class kupci_uplata extends Eloquent {

	    protected $guarded = [];
		
		protected $table = 'kupci_uplata';

	    protected $primaryKey = 'id';

	    public static function uplate_kupca($id1, $id2){
	    	$data = DB::table('kupci_uplata')->where('kupac_id', $id1)
	    									 ->where('nacin', $id2)
	    									 ->sum('iznos');

	    	if (null == $data) {
	    		$data = 0;
	    	}
	    	return $data;
	    }
  	}
?>