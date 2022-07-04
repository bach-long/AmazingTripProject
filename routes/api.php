<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogAddressController;
use App\Http\Controllers\BookmarkController;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
@@ -26,46 +20,34 @@
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::post('/login',[LoginControler::class,'PostLogin']);
//Route::post('/register',[RegisterController::class,'PostRegister']);

Route::get('/profile/{id}',[UserController::class,'getProfile']);

Route::post('/login',[AuthController::class,'Login']);         
Route::post('/register',[AuthController::class,'signUp']);       

Route::get('/address',[AddressController::class,'getAddress']);
Route::post('/address',[AddressController::class,'postAddress']);
Route::patch('/address/{id}',[AddressController::class,'editAddress']);
Route::delete('/address/{id}',[AddressController::class,'deleteAddress']);
Route::get('/listAddress',[AddressController::class,'getListAddress']);
Route::get('/address/{id}',[AddressController::class,'getAddressbyId']);

Route::get('/address_by_host/{id}',[AddressController::class,'getAddressByHost']);

Route::get('/blog',[BlogController::class,'getBlog']);
Route::post('/blog',[BlogController::class,'postBlog']);
Route::patch('/blog/{id}',[BlogController::class,'editBlog']);
Route::delete('/blog/{id}',[BlogController::class,'deleteBlog']);

Route::get('/blogaddress',[BlogAddressController::class,'getBlog']);
Route::post('/blogaddress',[BlogAddressController::class,'postBlog']);
Route::get('/blogaddress/{id}',[BlogAddressController::class,'showBlogAddress']); // show detail 1 blog.
Route::patch('/blogaddress/{id}',[BlogAddressController::class,'editBlog']);
Route::delete('/blogaddress/{id}',[BlogAddressController::class,'deleteBlog']);

Route::get('/bookmark',[BookmarkController::class,'getBookmark']);
Route::post('/bookmark',[BookmarkController::class,'postBookmark']);
Route::delete('/bookmark/{id}',[BookmarkController::class,'deleteBookmark']);

Route::get('/group',[GroupController::class,'getGroup']);
Route::get('/group/{id}',[GroupController::class,'showGroup']) ; // show detail 1 group 
Route::post('/group',[GroupController::class,'postGroup']);
Route::patch('/group/{id}',[GroupController::class,'editGroup']);
Route::delete('/group/{id}',[GroupController::class,'deleteGroup']);

Route::get('/follow',[FollowController::class,'getFollow']);
Route::post('/follow',[FollowController::class,'postFollow']);
Route::delete('/follow/{id}',[FollowController::class,'deleteFollow']);

Route::get('/discount',[DiscountController::class,'getDiscount']);
Route::post('/discount',[DiscountController::class,'postDiscount']);
Route::patch('/discount/{id}',[DiscountController::class,'editDiscount']);
Route::delete('/discount/{id}',[DiscountController::class,'deleteDiscount']);

Route::post('/CreateGroupForm',[CreateGroupFormController::class,'CreateGroup']);

Route::get('/getUser/{phone}',[GetUserController::class,'GetUser']);
