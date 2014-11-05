<?php
//System Setup
Route::get('setup', 'SystemController@login');
Route::post('system/setup', 'SystemController@validate');
Route::get('system', 'SystemController@systemApp');
Route::get('system/config', 'SystemController@conf');



Route::get('password', function(){
  return View::make('pass.index');
});
Route::post('password/pax', 'PasswordController@pax');
Route::post('password/change', 'PasswordController@change');
Route::get('password/users', 'PasswordController@show');
Route::post('password/users', 'PasswordController@update');


Route::get('/', function()
{
  
	return View::make('login');
});

Route::get('home', array('before'=>'auth', function()
{
  return View::make('dashboard');
}));


//validating user during login
Route::post('login',array('as'=>'login', 'uses'=>'UsersController@validate'));

//check default pass
Route::get('passchange',array('as'=>'passchange', 'uses'=>'UsersController@passchange'));
Route::post('passchange',array('as'=>'passchange1', 'uses'=>'UsersController@paxchn'));

//loging a user out
Route::get('logout',array('as'=>'logout', 'uses'=>'UsersController@logout'));

//user codes
Route::get('users/add', array('as'=>'adduser', 'uses'=>'UsersController@create'));
Route::post('users/add', array('as'=>'adduser1', 'uses'=>'UsersController@store'));
Route::get('users', array('as'=>'listusers', 'uses'=>'UsersController@index'));
Route::post('users/delete/{id}', array('as'=>'listusers', 'uses'=>'UsersController@destroy'));
Route::get('user/edit/{id}', array('as'=>'edituser', 'uses'=>'UsersController@edit'));
Route::post('user/edit/{id}', array('as'=>'edituser1', 'uses'=>'UsersController@update'));
//room codes
Route::get('rooms/repair', array('as'=>'addroom', 'uses'=>'RoomsController@repair'));
Route::post('rooms/repair', array('as'=>'addroom', 'uses'=>'RoomsController@postrepair'));
Route::get('rooms/repairs', array('as'=>'addroom', 'uses'=>'RoomsController@repairs'));
Route::get('rooms/add', array('as'=>'addroom', 'uses'=>'RoomsController@create'));
Route::get('rooms/release', array('as'=>'showrelease', 'uses'=>'RoomsController@showrelease'));
Route::get('rooms/requests', array('as'=>'showrequests', 'uses'=>'RoomsController@showrequests'));
Route::post('rooms/requests/{id}', array('as'=>'postrequests', 'uses'=>'RoomsController@postrequests'));
Route::post('rooms/add', array('as'=>'addroom1', 'uses'=>'RoomsController@store'));
Route::post('rooms/addday', array('as'=>'addday', 'uses'=>'RoomsController@addday'));
Route::get('rooms', array('as'=>'listrooms', 'uses'=>'RoomsController@index'));
Route::post('rooms/delete/{id}', array('as'=>'listrooms', 'uses'=>'RoomsController@destroy'));
Route::get('rooms/edit/{id}', array('as'=>'editroom', 'uses'=>'RoomsController@edit'));
Route::post('rooms/edit/{id}', array('as'=>'editroom1', 'uses'=>'RoomsController@update'));
Route::post('guest/roomcheck', 'RoomsController@roomcheck');
Route::post('rooms/release/{id}', array('as'=>'release', 'uses'=>'RoomsController@release'));
//bar codes
Route::get('bar/add', array('as'=>'addroom', 'uses'=>'BarsController@create'));
Route::post('bar/add', array('as'=>'addroom1', 'uses'=>'BarsController@store'));
Route::get('bar', array('as'=>'listrooms', 'uses'=>'BarsController@index'));
Route::post('bar/delete/{id}', array('as'=>'listrooms', 'uses'=>'BarsController@destroy'));
Route::get('bar/edit/{id}', array('as'=>'editroom', 'uses'=>'BarsController@edit'));
Route::post('bar/edit/{id}', array('as'=>'editroom1', 'uses'=>'BarsController@update'));
//restaurant codes
Route::get('restaurant/add', array('as'=>'addrestaurant', 'uses'=>'RestaurantsController@create'));
Route::post('restaurant/add', array('as'=>'addrestaurant1', 'uses'=>'RestaurantsController@store'));
Route::get('restaurant', array('as'=>'listrestaurants', 'uses'=>'RestaurantsController@index'));
Route::post('restaurant/delete/{id}', array('as'=>'listrestaurants', 'uses'=>'RestaurantsController@destroy'));
Route::get('restaurant/edit/{id}', array('as'=>'editrestaurant', 'uses'=>'RestaurantsController@edit'));
Route::post('restaurant/edit/{id}', array('as'=>'editrestaurant1', 'uses'=>'RestaurantsController@update'));
Route::post('restaurant_update/{id}', 'RestaurantsController@update_resta');
Route::get('view_den/{id}', 'RestaurantsController@customer_list');
Route::get('viewLaundry/{id}', 'GuestsController@customerLaundry');
Route::post('laundryEditAction/{id}', 'GuestsController@customerEditLaundry');
Route::post('barbills_update/{id}', 'GuestsController@update_barbills');
Route::get('managerReservedGuestRooms', 'GuestsController@managerReservedGuestRoomsAction');
Route::get('viewGeneral/{id}/{start_date}/{end_date}', 'GuestsController@viewGeneralAction');
Route::get('viewGeneralPdf/{id}/{start_date}/{end_date}', 'GuestsController@viewGeneralPdfAction');
//laundry codes
Route::get('laundry/add', array('as'=>'addlaundry', 'uses'=>'LaundriesController@create'));
Route::post('laundry/add', array('as'=>'addlaundry1', 'uses'=>'LaundriesController@store'));
Route::get('laundry/list', array('as'=>'laundrylist', 'uses'=>'LaundriesController@listgl'));
Route::get('laundry/saleslist', 'LaundriesController@listSalesLaundry');
Route::get('laundry/salesEditAction', 'LaundriesController@getSalesLaundryAction');
Route::get('customerForm', 'LaundriesController@customerEditFormAction');
Route::post('customers','LaundriesController@customersAction');
Route::post('laundry/glist', array('as'=>'laundrylistg', 'uses'=>'LaundriesController@glist'));
Route::post('checkSum',  'LaundriesController@checkEditSum');
Route::post('confirmLaundry',  'LaundriesController@laundryConfirmation');
Route::post('confirmLaundrySales',  'LaundriesController@laundryConfirmationSales');
Route::post('checkSumSales',  'LaundriesController@checkEditSumSalesAction');
Route::post('laundry/llist', array('as'=>'laundrylist', 'uses'=>'LaundriesController@llist'));
Route::post('customerList','LaundriesController@customerListAction');
Route::post('laundry/viewlist', array('as'=>'viewlist', 'uses'=>'LaundriesController@viewlist'));
Route::post('laundry/viewlist1', array('as'=>'viewlist1', 'uses'=>'LaundriesController@viewlist1'));
Route::post('laundry/list', array('as'=>'plaundrylist', 'uses'=>'LaundriesController@plistgl'));
Route::get('laundry', array('as'=>'listlaundry', 'uses'=>'LaundriesController@index'));
Route::post('laundry/delete/{id}', array('as'=>'listlaundry', 'uses'=>'LaundriesController@destroy'));
Route::get('laundry/edit/{id}', array('as'=>'editlaundry', 'uses'=>'LaundriesController@edit'));
Route::post('laundry/edit/{id}', array('as'=>'editlaundry1', 'uses'=>'LaundriesController@update'));
Route::get('laundry/gllists', array('as'=>'gllists', 'uses'=>'LaundriesController@gllists'));
Route::get('viewListLaundry/{id}/{date}', 'LaundriesController@laundryListView');
Route::get('viewEditList/{id}/{date}', 'LaundriesController@laundryEditView');
Route::get('viewListLaundrySales/{id}/{date}/{name}', 'LaundriesController@laundryListViewSales');
Route::get('viewEditListSales/{id}/{date}/{name}', 'LaundriesController@laundryEditViewSales');
//guest codes
Route::get('guest/add', array('as'=>'addguest', 'uses'=>'GuestsController@create'));
Route::get('viewCustomerReservedOrder',  'GuestsController@viewCustomerReservedOrderAction');
Route::get('reservedContent/{id}',  'GuestsController@reservedContentAction');
Route::get('guest/list', array('as'=>'listguest', 'uses'=>'GuestsController@index'));
Route::post('guest/add', array('as'=>'addguest1', 'uses'=>'GuestsController@store'));
Route::post('guest/rno', array('as'=>'addguest1', 'uses'=>'GuestsController@rno'));
Route::get('guest', array('as'=>'listguest', 'uses'=>'GuestsController@index'));
Route::post('guest/delete/{id}', array('as'=>'listguest', 'uses'=>'GuestsController@destroy'));
Route::get('guest/edit/{id}', array('as'=>'editguest', 'uses'=>'GuestsController@edit'));
Route::post('guest/edit/{id}', array('as'=>'editguest1', 'uses'=>'GuestsController@update'));
Route::get('guest/edit/{id}', array('as'=>'editguest', 'uses'=>'GuestsController@edit'));
Route::post('guest/edit/{id}/moredays', array('as'=>'editguest1', 'uses'=>'GuestsController@moredays'));
Route::get('guest/messages', array('as'=>'messages', 'uses'=>'GuestsController@messages'));
Route::post('guest/messages/{id}', array('as'=>'messages1', 'uses'=>'GuestsController@confirm'));
Route::get('guest/checkouts', array('as'=>'checkouts', 'uses'=>'GuestsController@checkouts'));
Route::get('view_cancel/{id}', 'GuestsController@cancel_id');
Route::get('view_den/{id}', 'GuestsController@view_customer');
Route::post('cancel_edit/{id}', 'GuestsController@cancel_edit_id');
Route::get('view_danger/{id}', 'GuestsController@cancel_danger');
Route::get('canceled_rooms', 'GuestsController@report_canceled');
Route::get('notifications', array('as'=>'notifications', 'uses'=>'NotificationsController@index'));
Route::post('notifications/solved/{id}', array('as'=>'notificationssolved', 'uses'=>'NotificationsController@solving'));
Route::get('notify', array('as'=>'notify', 'uses'=>'NotificationsController@notify'));
//bill codes
Route::get('bill/add', array('as'=>'bill', 'uses'=>'BillsController@index'));
Route::get('bill/addBoth',  'BillsBothController@indexBoth');
Route::post('bill/submit', array('as'=>'billsubmit', 'uses'=>'BillsController@submit'));
Route::post('bill/submitBoth', array('as'=>'billsubmitBoth', 'uses'=>'BillsBothController@submitBoth'));
Route::post('bill/add', array('as'=>'billstore', 'uses'=>'BillsController@store'));
Route::post('bill/addBoth', array('as'=>'billstoreBoth', 'uses'=>'BillsBothController@storeBoth'));
Route::get('bill', array('as'=>'allbill', 'uses'=>'BillsController@all'));
Route::get('billBoth', array('as'=>'allbillBoth', 'uses'=>'BillsBothController@allBoth'));
Route::get('bill/all',  array('as'=>'allbill', 'uses'=>'BillsController@all'));
Route::get('bill/allBoth',  array('as'=>'allbillBoth', 'uses'=>'BillsBothController@allBoth'));
Route::post('loadbill', 'BillsController@loadbill');
Route::post('loadbillBoth', 'BillsBothController@loadbillBoth');
Route::post('bill/loadbill', 'BillsController@loadbill');
Route::post('bill/updatebill', 'BillsController@updatebill');
Route::post('bill/loadbillBoth', 'BillsBothController@loadbillBoth');
Route::post('bill/updatebillBoth', 'BillsBothController@updatebillBoth');
Route::post('bill/servicetime', 'BillsController@servicetime');
Route::post('bill/servicetimeBoth', 'BillsBothController@servicetimeBoth');
Route::get('bill/sales/add', 'BillsController@sales');
Route::get('bill/sales/addBoth', 'BillsBothController@salesBoth');
Route::post('bill/sales/submitsale', 'BillsController@submitsale');
Route::post('bill/sales/submitsaleBoth', 'BillsBothController@submitsaleBoth');
Route::get('bill/sales/all','BillsController@allsale');
Route::get('bill/sales/allBoth','BillsBothController@allsaleBoth');
Route::get('bills/print/{id}','BillsController@billsprint');
Route::get('sells/print/{id}','BillsController@sellsprint');
Route::get('bills/printbar/{id}','BillsController@billsprintbar');
Route::get('bills/printbarBoth/{id}','BillsBothController@billsprintbarBoth');
Route::get('sells/printbarz/{id}','BillsController@sellsprintbarz');
Route::get('sells/printbarzBoth/{id}','BillsBothController@sellsprintbarzBoth');
// Storekeeper codes
Route::get('good/set', 'StoresController@create');
Route::post('good/set', 'StoresController@store');
Route::get('goods/manage', 'StoresController@manage');
Route::get('goods/report', 'StoresController@report');
Route::post('goods/process_add', 'StoresController@process_add');
Route::post('goods/process_reduce', 'StoresController@process_reduce');
Route::get('storeReportSearch/{date}', 'StoresController@reportSearchAction');
//Reports
Route::get('reports/rooms', 'ReportsController@rooms');
Route::post('reports/laundry', 'ReportsController@postlaundry');
Route::post('reports/rooms', 'ReportsController@postrooms');
Route::get('reports/restaurant', 'ReportsController@restaurant');
Route::post('reports/restaurant', 'ReportsController@postrestaurant');
Route::get('reports/bar', 'ReportsController@bar');
Route::get('bardaily_display/{guest}/{rest}/{serv}/{date}','ReportsController@barreport_display');
Route::get('barweekly_display/{guest}/{rest}/{serv}/{start_date}/{end_date}','ReportsController@barreport_weekly_display');
Route::get('barmonthly_display/{guest}/{rest}/{serv}/{month}/{year}','ReportsController@barreport_monthly_display');
Route::get('baryearly_display/{guest}/{rest}/{serv}/{year}','ReportsController@barreport_year_display');
Route::get('reports/laundry', 'ReportsController@laundry');
Route::get('day_laundry/{guest}/{laud}/{date}','ReportsController@laundry_day');
Route::get('week_laundry/{guest}/{laud}/{start_date}/{end_date}','ReportsController@laundry_week');
Route::get('month_laundry/{guest}/{laud}/{month}/{year}','ReportsController@laundry_month');
Route::get('year_laundry/{guest}/{laud}/{year}','ReportsController@laundry_year');
Route::get('reports/notify', array('as'=>'notify', 'uses'=>'NotificationsController@notify'));
//Accountant
Route::get('accountant/income/{date}', 'AccountantController@income');
Route::get('printpdf/{id}', 'AccountantController@incomeDownload');
Route::get('conferences', 'GuestsController@conferencesHome');
Route::get('tableContents/{id}', 'GuestsController@getTableContents');
Route::post('payBillContents/{id}', 'GuestsController@payBillTableContents');
Route::post('submitConferences', 'GuestsController@conferencesSubmitAction');
Route::get('create', 'AccountantController@createBf');
Route::get('resourcesDetails/{id}', 'AccountantController@expensesDetailsAction');
Route::get('dailyPdfExport/{date}', 'AccountantController@dailyPdfExportAction');
Route::post('submitBf', 'AccountantController@submitBalanceAndRemain');
Route::get('accountant/expenditure', 'AccountantController@expenditure');
Route::get('accountant/report', 'AccountantController@report');
Route::get('accountant_report/{income}/{date}', 'AccountantController@report_display');
Route::get('accountant_weekly/{income}/{start}/{end}', 'AccountantController@report_weekly');
Route::get('accountant_monthly/{income}/{month}/{year}', 'AccountantController@report_monthly');
Route::get('accountant_yearly/{income}/{year}', 'AccountantController@report_yearly');
Route::post('expenditure', 'AccountantController@expenditure_insert');
Route::get('view/{id}',  'GuestsController@view_history');
Route::get('restaurants/{id}','GuestsController@view_restaurant');
Route::get('report_daily/{gust}/{type}/{date}','RoomsController@report_display');
Route::get('report_weekly/{gust}/{type}/{start_date}/{end_date}','RoomsController@report_weekly_display');
Route::get('monthly_report/{gust}/{type}/{month}/{year}','RoomsController@report_monthly_display');
Route::get('year_report/{gust}/{type}/{year}','RoomsController@report_year_display');
Route::get('daily_display/{guest}/{rest}/{serv}/{date}','ReportsController@report_display');
Route::get('weekly_display/{guest}/{rest}/{serv}/{start_date}/{end_date}','ReportsController@report_weekly_display');
Route::get('monthly_display/{guest}/{rest}/{serv}/{month}/{year}','ReportsController@report_monthly_display');
Route::get('yearly_display/{guest}/{rest}/{serv}/{year}','ReportsController@report_year_display');
Route::get('pdf', 'PrintController@index');
Route::get('pdfz', 'PrintController@pdfz');
Route::get('temedet', 'PrintController@temedet');
Route::get('chartGenerates', 'GuestsController@chartGeneratesAction');
