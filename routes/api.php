<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/user', 'UserController@index');

// Route::post('register', 'API\RegisterController@register');

// Route::middleware('auth:api')->group( function () {
//     Route::resource('company_csr', 'API\CompanyCsrController');
//     Route::get('companycsrs', 'API\CompanyCsrController@index');
// });


Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
    });
    Route::get('companycsrs', 'API\CompanyCsrController@index');
});
Route::post('nfra_xbrl/list', 'API\NfraXbrlController@index');
Route::post('auditor_detail_xbrl/list', 'API\AuditorDetailXbrlController@index');
Route::post('auditor_detail_indas/list', 'API\AuditorDetailIndasController@index');
Route::post('auditor_non_xbrl_aoc4/list', 'API\AuditorNonXbrlAoc4Controller@index');

Route::post('nafra_xbrl_final/list', 'API\NafraXbrlFinalController@index');
Route::post('nafra_indas_final/list', 'API\NafraIndasFinalController@index');
Route::post('nfra_cs_details/list', 'API\NfraCSDetailsController@index');
