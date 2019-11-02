<?php	
	class radnici extends Eloquent {

    protected $guarded = [];
	
	protected $table = 'radnici';

    protected $primaryKey = 'id';

    public function radnici(){

        return $this->belongsTo('Ovlascenja');
    }

    public static function zaduzeniRadnik($radnik_id){

    	$data = DB::table('radnici')->where('id', $radnik_id)->first();
    	return $data;
    }

    public static function radnik(){

        $data = DB::table('radnici')->get();
        return $data;
    }

    public static function zaduzeniRadnici(){

        $data = DB::table('upisaniproizvod')->get();
        return $data;
    }

    public function veza()
    {
        return $this->hasMany('veza', 'radnik');
    } 

}