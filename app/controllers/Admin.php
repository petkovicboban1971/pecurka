<?php 
class Admin extends Controller{

    function admin_login_store() {

        $username=Input::get('username');
        $password=Input::get('password');
        $username=addslashes($username);
        $password=addslashes($password);
    //    $password=md5($password);
            
            $validator = Validator::make(array('username'=>$username,'password'=>$password),
            array(
                'username' => 'required|between:3,20',
                'password' => 'required|between:3,20|alpha_num|exists:radnici,lozinka,ime,'.$username
            ),
            array(
                'required' => 'Niste popunili polje!',
                'between' => 'Broj karaktera mora biti između 3 i 20!',
                'alpha_num' => 'Polje sme sadržati samo slova i cifre!',
                'exists' => 'Uneli ste pogrešno korisničko ime ili lozinku!'
            ));

            if($validator->fails()){
                return Redirect::to(AdminOptions::base_url().'admin-login')->withInput()->withErrors($validator->messages());
            }
            
            $rola = DB::table('radnici')->where(array('ime'=>addslashes($username),'lozinka'=>addslashes($password)))->pluck('rola');

                Session::put('log_sesija'.AdminOptions::server(),intval(DB::table('radnici')->where(array('ime'=>addslashes($username),'lozinka'=>addslashes($password)))->pluck('id')));
                $llog = new Logovi();
                $llog->timestamps = false;
                $llog->llog = Session::get('log_sesija'.AdminOptions::server());
                $llog->save();
            if ($rola == 1){
                return Redirect::to('/home');
            }

            if ($rola == 10){
                return Redirect::to(AdminOptions::base_url().'admin-welcome');
            }
            
            else {   
                
                echo AdminOptions::lang(117, Session::get('jezik.AdminOptions::server()'));
            }         

    }

   

    function logout(){
        Session::forget('log_sesija.AdminOptions::server()');
        return Redirect::to('/admin');
    }
}