<?php


//////////////////////////////   L  I  V  E   //////////////////////////////
 

Route::get('/', 'HomeController@showWelcome');
Route::get('/home', 'HomeController@home');

// zaduzenje radnika
Route::get('/zaduzenje-radnika', 'ZaduzenjeController@zaduzenje_radnika');
Route::get('/zaduzenje-radnika1', 'ZaduzenjeController@zaduzenje_radnika1');
Route::get('/zaduzenje-radnika2', 'ZaduzenjeController@zaduzenjeRadnika2');
Route::get('/zaduzeniRadnik3/{id}', 'ZaduzenjeController@zaduzenjeRadnika3');
Route::get('/zaduzeniRadnik31/{id}', 'ZaduzenjeController@zaduzenjeRadnika31');
Route::post('/zaduzeniRadnik4', 'ZaduzenjeController@zaduzenjeRadnika4');
Route::get('/zaduzeniRadnik5', 'ZaduzenjeController@zaduzenjeRadnika5');
Route::get('/otkazUpisa', 'ZaduzenjeController@otkazUpisa');
Route::post('/privremena-tabela', 'ZaduzenjeController@privremena_tabela');
Route::post('/privremena-tabela1', 'ZaduzenjeController@privremena_tabela1');
Route::post('/privremena-tabela2', 'ZaduzenjeController@privremena_tabela2');
Route::post('/proba1', 'ZaduzenjeController@privremena_tabela');
Route::get('/zaduzenje-kupac', 'ZaduzenjeController@zaduzenje_kupac');
Route::get('/ponisti-privremenu', 'ZaduzenjeController@ponisti_privremenu');
Route::get('/konacno-zaduzenje/{id?}', 'ZaduzenjeController@konacno_zaduzenje');
Route::get('/krajZaduzenja', 'ZaduzenjeController@krajZaduzenja');

// pregled zaduzenja radnika
Route::get('/pregled-zaduzenja-radnika', 'PregledRadnikaController@pregled_radnika');
Route::get('/zaduzeni-radnik', 'PregledRadnikaController@zaduzeni_radnik');
Route::get('/ocitavanje-kupca', 'PregledRadnikaController@ocitavanje_kupca');
Route::get('/faktura-posebno/{id}/{id1}', 'PregledRadnikaController@faktura_posebno');

// razduzenje radnika
Route::get('/razduzenje-radnika', 'RazduzenjeRadnikaController@razduzenje_radnika');
Route::get('/razduzeni-radnik/{id}', 'RazduzenjeRadnikaController@razduzeni_radnik');
Route::get('/razduzeniRadnik/{id}', 'RazduzenjeRadnikaController@razduzeniRadnik');
Route::get('/razduzenje_pom/{id}', 'RazduzenjeRadnikaController@razduzenje_pom');
Route::post('/razduzenjeRadnika2', 'RazduzenjeRadnikaController@razduzenjeRadnika2');

// istorija radnika
Route::get('/istorija_radnika', 'RazduzenjeRadnikaController@istorija_radnika');
Route::get('/istorija_radnik1/{id}', 'RazduzenjeRadnikaController@istorija_radnika1');
Route::post('/istorija_datum', 'RazduzenjeRadnikaController@istorija_datum');




//////////////////////////////   A D M I N   //////////////////////////////

Route::get('/admin/{id?}', 'HomeController@showWelcome');
Route::post('/pre-Welcome', 'HomeController@preWelcome');
Route::post('/admin-login-store', 'Admin@admin_login_store');
Route::get('/admin-login', 'HomeController@showWelcome');
Route::get('/admin-welcome', 'HomeController@welcome'); 
Route::get('/admin-logout', 'Admin@logout'); 

// ulazne stavke
Route::post('/admin-save-item', 'CrudController@store');
Route::get('/admin-delete-item/{id?}', 'CrudController@destroy');
Route::post('/admin-edit-item/{id?}', 'CrudController@edit');
Route::get('/admin-find-item/{id}', 'CrudController@finding');
Route::post('/admin-update-item/{id?}', 'CrudController@update');

// radnici
Route::post('/admin-update-worker/{id?}', 'WorkersController@update');
Route::post('/admin-save-worker', 'WorkersController@storeWorker');
Route::post('/admin-zarada', 'WorkersController@zarada');
Route::get('/admin-delete-worker/{id?}', 'WorkersController@destroy');
Route::get('/admin-find-worker/{id}', 'WorkersController@finding');
Route::get('/workers', 'WorkersController@workers');
Route::get('/workers1', 'WorkersController@workers1');
Route::get('/workers2', 'WorkersController@workers2');
Route::get('/workers3', 'WorkersController@workers3');
Route::get('/obracun_plata', 'WorkersController@obracun_plata');
Route::post('/izbor_radnika/{id?}', 'WorkersController@izbor_radnika');
Route::get('/istorija_obracuna', 'WorkersController@istorija_obracuna');

//kupci
Route::post('/admin-new-buyer', 'BuyersController@newBuyer');
Route::get('/admin-find-buyer/{id}', 'BuyersController@findBuyer');
Route::get('/admin-delete-buyer/{id}', 'BuyersController@deleteBuyer');
Route::get('/uplate_kupaca', 'BuyersController@uplate_kupaca');
Route::get('/pregled_uplata/{id?}', 'BuyersController@pregled_uplata');
Route::get('/pregled_uplata_kupca', 'BuyersController@pregled_uplata_kupca');
Route::get('/pregled_ziralnih_uplata', 'BuyersController@pregled_ziralnih_uplata');
Route::get('/izbor_nacina_prodaje', 'BuyersController@izbor_nacina_prodaje');
Route::get('/istorija_transakcija', 'BuyersController@istorija_transakcija');
Route::post('/istorija_transakcija2', 'BuyersController@istorija_transakcija2');
Route::post('/admin-update-buyer/{id}', 'BuyersController@updateBuyer');
Route::post('/snimi_uplatu', 'BuyersController@snimi_uplatu');

//grupe proizvod
Route::post('/admin-save-group', 'GroupController@saveGroup');
Route::get('/admin-delete-group/{id}', 'GroupController@deleteGroup');
Route::post('/admin-update-group/{id}', 'GroupController@updateGroup');
Route::get('/admin-find-group/{id}', 'GroupController@findGroup');
Route::get('/admin-list-group', 'GroupController@showGroup');

//proizvodi
Route::post('/admin-new-product', 'ProductController@newProduct');
Route::post('/admin-update-product/{id}', 'ProductController@updateProduct');
Route::get('/admin-find-product/{id}', 'ProductController@findProduct');
Route::get('/admin-delete-product/{id}', 'ProductController@deleteProduct');
Route::get('/admin-list-product', 'ProductController@listProduct');
Route::get('/admin-new-warehouse', 'ProductController@new_warehouse');
Route::get('/stanjeMagacina', 'ProductController@stanjeMagacina');
Route::get('/glavniMagacin', 'ProductController@glavniMagacin');
Route::get('/tabela', 'ProductController@tabela');

// valute
Route::get('/admin-valute', 'ProductController@valute');

// dobavljaci
Route::post('/noviDobavljac', 'CrudController@noviDobavljac');
Route::get('/unosKolicineDobavljac', 'CrudController@unosKolicineDobavljac');
Route::get('/grafik_dobavljaci', 'CrudController@grafik_dobavljaci');
Route::get('/upisProizvoda/{id}', 'CrudController@upisProizvoda');
Route::get('/isplate_dobavljacima/{id?}', 'CrudController@isplate_dobavljacima');
Route::get('/pregled_ispl_dobavljaca', 'CrudController@pregled_ispl_dobavljaca');
Route::post('/unos_isplate_dobavljaca', 'CrudController@unos_isplate_dobavljaca');
Route::post('/kolicinedobavljaca', 'CrudController@kolicinedobavljaca');

// prodaja
Route::get('/ziralno', 'ProdajaController@ziralno');
Route::get('/fakture', 'ProdajaController@fakture');
Route::get('/izbor_kupca_faktura', 'ProdajaController@izbor_kupca_faktura');
Route::get('/realiz_uplate_faktura', 'ProdajaController@realiz_uplate_faktura');
Route::get('/otpis', 'ProdajaController@otpis');
Route::post('/otpis1', 'ProdajaController@otpis1');
Route::post('/dnevna_cena_proizvoda', 'ProdajaController@dnevna_cena_proizvoda');


//bilans
Route::get('/bilansStanja', 'BilansController@bilansStanja');


//////////////////////////////   T  E  S  T   //////////////////////////////


Route::get('/proba', function(){
	return View::make('pages.home');
	});

Route::get('/test1', function(){
	return View::make('test11');
	});

Route::get('/nazad', function(){
	return Redirect::back();
	});
Route::get('/sel', function(){
	return View::make('modals/confirm');
	}
);