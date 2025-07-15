<?php

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\User\userController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::redirect('/', 'loginPage')->middleware('authenticate');
Route::get('loginPage', [AuthController::class, 'login'])->name('auth#login')->middleware('authenticate');
Route::get('registerPage', [AuthController::class, 'register'])->name('auth#register')->middleware('authenticate');
Route::get('dashboard', [AuthController::class, 'authenticate'])->name('dashboard');

// admin
// Admin-specific category routes
Route::middleware('admin')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('list', [CategoryController::class, 'list'])->name('category#list');
        Route::get('view/{id}', [CategoryController::class, 'view'])->name('category#view');
        Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
        Route::post('create', [CategoryController::class, 'create'])->name('category#create');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
        Route::get('viewUpdate/{id}', [CategoryController::class, 'viewUpdate'])->name('category#viewUpdate');
        Route::post('edit', [CategoryController::class, 'edit'])->name('category#edit');
    });

    // Category routes with 'category' prefix

    // Admin-specific routes with 'admin' prefix
    Route::prefix('admin')->group(function () {
        Route::get('changePassword', [AuthController::class, 'viewChangePassword'])->name('admin.viewChangePassword');
        Route::post('changePassword', [AuthController::class, 'changePassword'])->name('admin.changePassword');

        // Ensure 'account' and 'editProfile' don't use the same URL
        Route::get('account', [AuthController::class, 'account_view'])->name('admin.account_view');
        Route::get('editProfile', [AuthController::class, 'editProfile'])->name('admin.editProfile');
        Route::post('editProfileData', [AuthController::class, 'editProfileData'])->name('admin.editProfileData');

        //product
        Route::prefix('product')->group(function () {
            Route::get('list', [ProductController::class, 'list'])->name('admin.product.list');
            Route::get('createPizza', [ProductController::class, 'createPizza'])->name('admin.product.createPizza');
            Route::post('pizzaData', [ProductController::class, 'pizzaData'])->name('admin.product.pizzaData');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
            Route::get('view/{id}', [ProductController::class, 'view'])->name('admin.product.view');
            Route::get('editPizza/{id}', [ProductController::class, 'editPizza'])->name('admin.product.editPizza');
            Route::post('editPizzaData', [ProductController::class, 'editPizzaData'])->name('admin.product.editPizzaData');

        });
        //orderList
        Route::prefix('orderList')->group(function () {
            Route::get('orderList', [OrderListController::class, 'orderList'])->name('admin.orderList');
            // Route::patch('{id}/status', [OrderListController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
            Route::patch('update-status', [OrderListController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');


        });
        //adminList
        Route::prefix('adminList')->group(function () {
            Route::get('list', [AuthController::class, 'viewAdminList'])->name('admin.adminList.view');
            Route::get('delete/{id}', [AuthController::class, 'deleteAdmin'])->name('admin.adminList.delete');
            Route::get('roleChange/{id}', [AuthController::class, 'roleChange'])->name('admin.adminList.roleChange');
        });
        Route::prefix('blogs')->group(function () {
            Route::get('blogs', [BlogController::class, 'blogs'])->name('admin.blogs.viewBlogs');
            Route::get('create', [BlogController::class, 'create'])->name('admin.blogs.create');
            Route::get('view/{id}', [BlogController::class, 'view'])->name('admin.blog.view');
            Route::post('createBlogData', [BlogController::class, 'createBlogData'])->name('admin.blogs.createBlogData');
            Route::get('edit/{id}', [BlogController::class, 'viewUpdate'])->name('admin.blogs.edit');
            Route::put('update/{id}', [BlogController::class, 'edit'])->name('admin.blogs.update');
            Route::delete('delete/{id}', [BlogController::class, 'delete'])->name('admin.blogs.destroy');

        });
    });

});



// User-specific routes
Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    Route::get('orderMenu', [userController::class, 'orderMenu'])->name('user.orderMenu');
    Route::get('menu', [userController::class, 'menu'])->name('user.menu');
    Route::get('search', [userController::class, 'search'])->name('user.search');
    Route::get('lookMore/{id}', [BlogController::class, 'lookMore'])->name('user.menu.lookMore');
    Route::get('home1', [userController::class, 'home1'])->name('user.home1');
    Route::get('anotherPage', [userController::class, 'anotherPage'])->name('user.anotherPage');
    Route::get('blogs', [userController::class, 'blogs'])->name('user.blogs');
    Route::get('viewThroughCategory/{id}', [userController::class, 'viewThroughCategory'])->name('user.viewThroughCategory');
    Route::get('aboutUs', [userController::class, 'aboutUs'])->name('user.aboutUs');
    Route::get('changePassword', [userController::class, 'changePassword'])->name('user.changePassword');
    Route::post('changePasswordData', [userController::class, 'changePasswordData'])->name('user.changePasswordData');
    Route::get('account', [userController::class, 'account'])->name('user.account');
    Route::Post('accountUpdate', [userController::class, 'accountUpdate'])->name('user.accountUpdate');
    Route::get('viewViaCategory/{id}', [userController::class, 'viewViaCategory'])->name('user.viewViaCategory');
    Route::get('detail/{id}', [userController::class, 'detail'])->name('user.detail');
    Route::get('viewCart', [userController::class, 'viewCart'])->name('user.viewCart');
    Route::get('history', [userController::class, 'history'])->name('user.history');
    Route::get('qrcode', [userController::class, 'generateQRCode'])->name('user.qrcode');
    Route::post('createReview', [userController::class, 'createReview'])->name('user.review');
    Route::post('deleteReceipt', [userController::class, 'deleteReceipt'])->name('user.deleteReceipt');
    Route::get('home2', [userController::class, 'home2'])->name('user.home2');
    //blogs
    Route::group(['prefix' => 'blogs'], function () {
        Route::get('more/{id}', [userController::class, 'more'])->name('user.blogs.seeMore');
        // Route::delete('remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    });

    //cart

    Route::group(['prefix' => 'cart'], function () {
        Route::get('list', [userController::class, 'viewCart'])->name('user.cartList');
        // Route::delete('remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    });

    // pizza
    Route::group(['prefix' => 'pizza'], function () {
        Route::get('detail/{id}', [userController::class, 'detail'])->name('user.pizza.detail');

    });

});
Route::group(['prefix' => 'ajax'], function () {
    Route::get('productList', [AjaxController::class, 'menuSort'])->name('ajax.productList');
    Route::patch('update', [AjaxController::class, 'update'])->name('ajax.update');
    Route::get('pizzaList', [AjaxController::class, 'pizzaList'])->name('ajax.pizzaList');
    Route::get('cart', [AjaxController::class, 'cart'])->name('ajax.cart');
    Route::post('order', [AjaxController::class, 'order'])->name('ajax.order');
    // Route::post('updateCart', [CartController::class, 'updateCart'])->name('ajax.updateCart');
    Route::post('updateForButtons', [AjaxController::class, 'update'])->name('ajax.updateForButtons');
    Route::post('remove', [AjaxController::class, 'remove'])->name('ajax.remove');
    Route::post('qrHasBeenScanned', [AjaxController::class, 'qrHasBeenScanned'])->name('ajax.qrHasBeenScanned');
    Route::post('proceedToCheckout', [AjaxController::class, 'proceedToCheckout'])->name('ajax.proceedToCheckout');
    Route::post('/generate-qr', function (Illuminate\Http\Request $request) {
        // dd($request->order_data);
        Log::info('QR Code Data:', ['order_data' => $request->order_data]);
        if (!$request->order_data) {
            return response()->json(['error' => 'No order data provided'], 400);
        }
        $qrCode = DNS2D::getBarcodeHTML($request->order_data, 'QRCODE');
        return response()->json(['qr_code' => $qrCode]);
    });
    Route::post('/generate-qr', [AjaxController::class, 'generateQR'])->name('ajax.generateQR');
});
Route::get('/phpCode', function () {
    return view('phpCode'); });
//I have made changes
Route::get('/testT', function () {
    return view('testingTailWind'); });
