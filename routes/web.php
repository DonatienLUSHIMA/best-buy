<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\LocalisationLanguagecontroller;
use App\Http\Controllers\SearchController;
use App\Models\Commande;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/users/homeadmin', [ChartController::class, 'index']);
Route::get('/change-language/{locale}', [LocalisationLanguagecontroller::class, 'changeLanguage'])->name('change.language');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/marchandises/index', [AchatController::class,'index'])->name('marchandises.index');
Route::get('/marchandises/create', [AchatController::class, 'create'])->name('marchandises.create');
Route::post('/marchandises', [AchatController::class, 'store'])->name('marchandises.store');
Route::get('/marchandises/{marchandise}/edit', [AchatController::class, 'edit'])->name('marchandises.edit');
Route::put('/marchandises/{marchandise}', [AchatController::class, 'update'])->name('marchandises.update');
Route::get('/marchandises/destroy/{id}', [AchatController::class, 'destroy'])->name('marchandises.ditory');
Route::get('/marchandises/displayM', [AchatController::class, 'goodsavailable'])->name('marchandises.displayM');
Route::get('/marchandises/{marchandise}/detail', [AchatController::class, 'detail'])->name('marchandises.detail');
Route::get('/marchandises/printlist', [AchatController::class, 'displayprint'])->name('marchandises.printlist');
Route::get('/generatePDF', [PdfController::class, 'generatePDF'])->name('generatePDF');
Route::get('/marchandises/{id}', [AchatController::class, 'show']);

Auth::routes();
//routes numbreproduct
Route::get('/home', [App\Http\Controllers\Admin\UsersController::class, 'goodsavailable'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'goodsavailable'])->name('home');
Route::get('/layouts/app', [App\Http\Controllers\HomeController::class, 'app'])->name('layous.app');
//Routes panier
Route::get('/paniers/panier', [PanierController::class,'panier'])->name('Paniers.panier');
Route::get('/paniers/destroy/{id}', [PanierController::class, 'destroy'])->name('paniers.destroy');
Route::get('/ajouterPanier/{produit}', [PanierController::class, 'ajouterPanier'])->name('ajouterPanier');
Route::post('/savePanier/{produit}', [PanierController::class, 'savePanier'])->name('savePanier');
Route::post('/finaliser-commande', [PanierController::class, 'finaliserCommande'])->name('finaliser.commande');
Route::get('/update-total-general', [PanierController::class,'updateTotalGeneral'])->name('updateTotalGeneral');

//Route email

Route::get('/forms',[MessageController::class,'formMessageGoogle']);
Route::get('/forms/show-message',[MessageController::class,'index'])->name('show-message');
Route::post('/message',[MessageController::class,'sendMessageGoogle'])->name('send.message.google');
Route::get('/forms/destroy/{id}', [MessageController::class, 'destroy'])->name('message.destroy');

//Roues details
Route::get('/commandes/list-commande', [CommandeController::class,'index'])->name('listcommande');
Route::get('/commandes/{details-commande}/details-commande', [CommandeController::class, 'detail'])->name('details-commandes');

//Routes searchs

Route::get('/search-users', [SearchController::class, 'search_users'])->name('searchs-users');
Route::get('/search-messages', [SearchController::class, 'searchs_messages'])->name('searchs-messages');
Route::get('/searchMs', [SearchController::class, 'search'])->name('searchs');

//Routes Admin
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
Route::resource('users', 'UsersController');

//Route Chart



});
