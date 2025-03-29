<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Services\UserService;
use App\Http\Controllers\UserController;
use App\Services\ProductService;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome', ['name' => 'denmark-app']);
});

Route::get('/users', [UserController::class, 'index']);

Route::resource('/products', ProductController::class);

Route::get('/post/{post}/comment/{comment}', function ( String $postId,  String $comment) {
    return 'Post ID: ' . $postId . ' - Comment: ' . $comment;
});

Route::get('/post/{id}', function (String $id) {
    return $id;
})->where('id', '[0-9]+');

Route::get('/search/{search}', function (String $search) {
    return $search;
})->where('search', '.*');

Route::middleware(['user-middleware'])->group(function () {
    Route::get('route-middleware-group/first', function (Request $request) {
        echo 'first';
    });

    Route::get('route-middleware-group/second', function (Request $request) {
        echo 'second';
    });
});

Route::get('/test/route/sample', function () {
    return route('test-route');
})->name('test-route');

Route::get('/test-container', function (Request $request){
    $input = $request->input('key');
    return $input;
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/first', 'first');
    Route::get('/users/{id}', 'show');
});

Route::get('/token', function(Request $request){
    return view('token');
});

Route::post('/token', function(Request $request){
    return $request->all();
});
/*  
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
    return view('token', ['token' => $token]);
});
*/

/*Route::get('/users', [UserController::class, 'index'])-> middleware('user-middleware');

Route::resource('/products', ProductController::class); */

Route::get('/product-list', function (ProductService $productService) {
    $data['products'] = $productService->listProducts();
    return view('products.list', $data);
});

Route::get('/test-provider', function (UserService $userService){
    return $userService->listUsers();
});

Route::get('/test-users', [UserController::class, 'index']);

Route::get('/test-facade', function (UserService $userService){
    return Response::json($userService->listUsers());
});

?>
