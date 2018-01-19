<?php

Route::get('/login', function () {
    return redirect()->route('login');
});
// Authentication Routes...
Route::get('/', 'Auth\LoginController@showLoginForm')->middleware('guest')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

//general pages
Route::get('accomodation', 'PagesController@accomodation')->name('accomodation');
Route::get('configuration', 'PagesController@configuration')->name('configuration');
Route::get('parking', 'PagesController@parking')->name('parking');

//items
Route::get('items/summary', function () {
    return response()->json(app(\App\Summaries\Items::class));
});

//items
Route::get('items/search', 'ItemsController@search');
Route::resource('items', 'ItemsController');
Route::get('test', function () {
    return response()->json(\App\Item::findOrFail(10100101));
});
Route::resource('transactions', 'TransactionsController');

//Route::resource("parkingfees","ParkingFeesController");

//parking
Route::get('vehicle/{vehicle}/payments/verify', 'VehiclePaymentsController@verify');
Route::resource('vehicle.payments', 'VehiclePaymentsController');
Route::resource('/vehicles', 'VehiclesController');

//categories
Route::post('/categories/{type}', 'CategoriesController@store');
Route::delete('/categories/{category}', 'CategoriesController@destroy');

//rooms
Route::resource('rooms', 'RoomsController');

Route::resource('rooms.rates', 'RoomRatesController');

Route::resource('rooms.payments', 'RoomPaymentsController');

//employess
Route::resource('employees', 'EmployeesController');

Route::resource('employee.payments', 'EmployeePaymentsController');

//expenditures
Route::resource('expenditures', 'ExpendituresController');

//other Incomes
Route::resource('otherIncomes', 'OtherIncomesController');

//avatars

Route::post('avatar', 'AvatarsController@store');

//hopefully the final but most important  route ! ******************THE  REPORTS*********************

Route::get('reports', 'ReportsController@index')->name('reports');
Route::post('reports', 'ReportsController@generate');
