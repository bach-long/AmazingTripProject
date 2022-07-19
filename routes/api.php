<?php

use App\Http\Controllers\BlogAddressController;
use App\Http\Controllers\BlogAddressReactionController;
use App\Http\Controllers\CommentBlogAddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentBlogController;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\BlogReactionController;
use App\Http\Controllers\FormRegisterController;
use App\Http\Controllers\LoginControler;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;


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
Route::post('/login',[LoginControler::class,'PostLogin']);
Route::post('/register',[RegisterController::class,'PostRegister']);

Route::get('/profile/{user_id}/{current_user_id}',[UserController::class,'getProfile']);
Route::get('/user/{user_id}',[UserController::class,'getUserData']);


Route::get('/address',[AddressController::class,'getAddress']);
Route::post('/address',[AddressController::class,'postAddress']);
Route::get('/address/{address_id}/{id_user}',[AddressController::class,'getEachAddress']);
Route::post('/address/{id}',[AddressController::class,'editAddress']);
Route::delete('/address/{id}',[AddressController::class,'deleteAddress']);

Route::get('/address_by_host/{id}/{user_id}',[AddressController::class,'getAddressByHost']);
Route::get('/addressHost/{user_id}',[AddressController::class,'getAddressHost']);
Route::get('/listaddressbybookmark',[AddressController::class,'ListAddressByBookmark']);   // lấy 3 địa điểm có lượt theo dõi cao nhất
Route::get('/listaddressbydiscount',[AddressController::class,'ListAddressByDiscount']);   // lấy 3 địa điểm có khuyến mãi cao nhất

// blog Address
Route::get('/blogAddress/{address_id}',[BlogAddressController::class,'getBlog']);
Route::post('/blogAddress',[BlogAddressController::class,'postBlog']);
Route::delete('/blogAddress/{id}',[BlogAddressController::class,'deleteBlog']);

Route::get('/blog/{id}',[BlogController::class,'getBlog']);
Route::post('/blog',[BlogController::class,'postBlog']);
Route::patch('/blog/{id}',[BlogController::class,'editBlog']);
Route::delete('/blog/{id}',[BlogController::class,'deleteBlog']);

Route::post('/createComment',[CommentBlogController::class, 'createCommentBlog']);
Route::get('/comments/{blog_id}',[CommentBlogController::class, 'getAllCommentBlog']);
Route::patch('/editComment',[CommentBlogController::class, 'editCommentBlog']);
Route::delete('/deleteComment/{comment_blog_id}',[CommentBlogController::class, 'deleteCommentBlog']);
Route::post('/reactBlog',[BlogReactionController::class, 'reactionUpdate']);
Route::get('/reactCheck/{blog_id}/{id_user}',[BlogReactionController::class, 'reactionCheck']);
Route::delete('/unReaction/{blog_id}/{id_user}',[BlogReactionController::class, 'unReaction']);

Route::get('/bookmark/{id_user}',[BookmarkController::class,'getBookmark']);
Route::get('/bookmark/{address_id}/{id_user}',[BookmarkController::class,'checkBookmark']);
Route::post('/bookmark',[BookmarkController::class,'postBookmark']);
Route::delete('/bookmark/{id}',[BookmarkController::class,'deleteBookmark']);

Route::get('/groupAddress/{address_id}',[GroupController::class,'getGroup']);
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
Route::get('/discount/address={address_id}',[DiscountController::class,'getFormDiscount']);

Route::post('/createCommentBlog/{blog_id}',[CommentBlogAddressController::class, 'createCommentBlog']);
Route::get('/commentsBlog/{blog_id}',[CommentBlogAddressController::class, 'getAllCommentBlog']);
Route::patch('/editCommentBlog',[CommentBlogAddressController::class, 'editCommentBlog']);
Route::delete('/deleteCommentBlog/{comment_blog_id}',[CommentBlogAddressController::class, 'deleteCommentBlog']);
Route::post('/reactAddressBlog',[BlogAddressReactionController::class, 'reactionUpdate']);
Route::get('/reactAddressCheck/{blog_address_id}/{id_user}',[BlogAddressReactionController::class, 'reactionCheck']);
Route::delete('/unReactionAddress/{blog_address_id}/{id_user}',[BlogAddressReactionController::class, 'unReaction']);

Route::get('/getRegisters/{address_id}',[FormRegisterController::class, 'getRegisterListForAddress']);
Route::post('/createForm',[FormRegisterController::class, 'postFormRegister']);
Route::patch('/editForm/{id}',[FormRegisterController::class, 'editFormRegister']);
Route::delete('/deleteForm',[FormRegisterController::class, 'deleteFormRegister']);
//Route::get('/getUser/{phone}',[GetUserController::class,'GetUser']);

