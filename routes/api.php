<?php

use App\Http\Controllers\BlogAddressController;
use App\Http\Controllers\CommentBlogAddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentBlogController;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\BlogReactionController;

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

//login && register
Route::post('/login',[LoginControler::class,'PostLogin']);
Route::post('/register',[RegisterController::class,'PostRegister']);
Route::get('/users',[RegisterController::class,'getUsers']);


//Users
Route::get('/profile/{id}',[UserController::class,'getProfile']);
Route::get('/numberofusers',[UserController::class,'getNumberofUsers']);
Route::get('/numberofhosts',[UserController::class,'getNumberofHosts']);
Route::get('/infoofusers',[UserController::class,'getInfomationOfUsers']);
Route::get('/infoofhosts',[UserController::class,'getInfomationOfHosts']);
Route::delete('/delete/{id}',[UserController::class,'deleteUser']);
Route::get('/usersbydate',[UserController::class,'getUsersByDate']);
Route::get('/hostsbydate',[UserController::class,'getHostsByDate']);

Route::get('/getUser/{phone}',[GetUserController::class,'GetUser']);

//Addresses
Route::get('/addresses',[AddressController::class,'getAddress']);
Route::get('/numberofaddresses',[AddressController::class,'getNumberofAddress']);
Route::get('/addressesbydate',[AddressController::class,'AddressesByDate']);
Route::post('/address',[AddressController::class,'postAddress']);
Route::get('/address/{id}',[AddressController::class,'getEachAddress']);
Route::post('/address/{id}',[AddressController::class,'editAddress']);
Route::delete('/address/{id}',[AddressController::class,'deleteAddress']);
Route::get('/address_by_host/{id}',[AddressController::class,'getAddressByHost']);

// Blog Address
Route::get('/blogAddress/{address_id}',[BlogAddressController::class,'getBlog']);
Route::post('/blogAddress',[BlogAddressController::class,'postBlog']);
Route::get('/blogaddresses',[BlogAddressController::class,'getAllBlogAddress']);
Route::delete('/blogaddress/{id}',[BlogAddressController::class,'deleteBlog']);

//Blog
Route::get('/blogs',[BlogController::class,'getBlog']);
Route::post('/blog',[BlogController::class,'postBlog']);
Route::patch('/blog/{id}',[BlogController::class,'editBlog']);
Route::delete('/blog/{id}',[BlogController::class,'deleteBlog']);
Route::get('/allblogs',[BlogController::class,'getAllBlogs']);
Route::get('/getinfoallblogs',[BlogController::class,'getInfoAllBlogs']);
Route::get('/blogsbydate',[BlogController::class,'BlogsByDate']);

//Bookmark
Route::get('/bookmark',[BookmarkController::class,'getBookmark']);
Route::post('/bookmark',[BookmarkController::class,'postBookmark']);
Route::delete('/bookmark/{id}',[BookmarkController::class,'deleteBookmark']);

//Groups
   //Create group
Route::post('/CreateGroupForm',[CreateGroupFormController::class,'CreateGroup']);

Route::get('/groups',[GroupController::class,'getGroup']);
Route::get('/numberofgroups',[GroupController::class,'NumberofGroups']);
Route::get('/groupsbydate',[GroupController::class,'GroupsByDate']);
Route::get('/group/{id}',[GroupController::class,'showGroup']) ; // show detail 1 group
Route::post('/group',[GroupController::class,'postGroup']);
Route::patch('/group/{id}',[GroupController::class,'editGroup']);
Route::delete('/group/{id}',[GroupController::class,'deleteGroup']);

//Follow
Route::get('/follow',[FollowController::class,'getFollow']);
Route::post('/follow',[FollowController::class,'postFollow']);
Route::delete('/follow/{id}',[FollowController::class,'deleteFollow']);

//Discount
Route::get('/discount',[DiscountController::class,'getDiscount']);
Route::post('/discount',[DiscountController::class,'postDiscount']);
Route::patch('/discount/{id}',[DiscountController::class,'editDiscount']);
Route::delete('/discount/{id}',[DiscountController::class,'deleteDiscount']);

//Commment
Route::post('/createCommentBlog',[CommentBlogAddressController::class, 'createCommentBlog']);
Route::get('/commentsBlog/{blog_id}',[CommentBlogAddressController::class, 'getAllCommentBlog']);
Route::patch('/editCommentBlog',[CommentBlogAddressController::class, 'editCommentBlog']);
Route::delete('/deleteCommentBlog/{comment_blog_id}',[CommentBlogAddressController::class, 'deleteCommentBlog']);

//Reactionn
Route::post('/reactBlog',[BlogReactionController::class, 'reactionUpdate']);










