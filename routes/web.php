<?php

use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\ChatRoomController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('pay-invoice/{invid}',[\App\Http\Controllers\PayController::class,'payment']);

//You need declear your success & fail route in "app\Middleware\VerifyCsrfToken.php"
Route::post('pay/success',[\App\Http\Controllers\PayController::class,'success'])->name('pay.success');
Route::post('pay/fail',[\App\Http\Controllers\PayController::class,'fail'])->name('pay.fail');
Route::get('pay/cancel',[\App\Http\Controllers\PayController::class,'cancel'])->name('pay.cancel');

Route::get('migrate', function (){
    Artisan::call('migrate');
    return Artisan::output();
});
//Route::get('migrate-fresh', function (){
//    Artisan::call('migrate:fresh --seed');
//    return Artisan::output();
//});
Route::get('optimize', function (){
    Artisan::call('cache:clear');
    print_r(Artisan::output());
    Artisan::call('config:cache');
    print_r(Artisan::output());
    Artisan::call('route:cache');
    print_r(Artisan::output());

});


// Route for displaying the list of chat rooms
Route::get('/chat', [ChatRoomController::class, 'index'])->name('chat.index');
// Route for creating a new chat room
Route::post('/chat/rooms', [ChatRoomController::class, 'store'])->name('chat.create');
// Route for displaying a specific chat room and its messages
Route::get('/chat/{chatRoom}', [ChatRoomController::class, 'show'])->name('chat.show');
// Route for storing a new chat message
Route::post('/chat/messages/send', [ChatMessageController::class, 'store'])->name('chat.message.send');
// Route for showing  chat message
Route::get('/chat/{chatRoomId}/messages', [ChatMessageController::class, 'getMessagesForChatRoom'])->name('chat.messages');


