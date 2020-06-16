<?php
use App\Model\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function() {
    if(Auth::check()){
        switch(Auth::user()->roles_id)
        {
            case User::ADMIN :
                return redirect('/admin/dashboard');
            break;
            case User::STUDENT :
                return redirect('/student/dashboard');
            break;
            default :
                return redirect('/login');
            break;
        }
    }else{
        return redirect('/login');
    }

});

Route::name('student.')->prefix('student')->namespace('Student')->middleware(['auth','role:'. USER::STUDENT])->group(function() {
    Route::get('dashboard',                     'DashboardController@index')->name('dashboard');
});

Route::name('admin.')->prefix('admin')->namespace('Admin')->middleware(['auth','role:'. USER::ADMIN])->group(function() {
    Route::get('dashboard',             'DashboardController@index')->name('dashboard');
    Route::name('class.')->prefix('class')->group(function() {
        Route::get('/',                 'ClassController@index')->name('index');
        Route::post('/upload',          'ClassController@store')->name('store');
    });

    Route::name('student.')->prefix('student')->group(function() {
        Route::get('/',                 'StudentController@index')->name('index');
        Route::post('/upload',          'StudentController@store')->name('store');
    });


});

Route::middleware('auth')->get('logout', function() {
    Auth::logout();
    return redirect(route('login'))->withInfo('You have successfully logged out!');
})->name('logout');

Auth::routes(['verify' => true]);

Route::name('js.')->group(function() {
    Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');
});

// Get authenticated user
Route::get('users/auth', function() {
    return response()->json(['user' => Auth::check() ? Auth::user() : false]);
});
