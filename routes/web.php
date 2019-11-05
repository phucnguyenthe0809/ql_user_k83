<?php

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
//cấu trúc route:   Route::Phương_thức('đường dẫn','1 function thực thi')
//phương thức
// get (truyền dữ liệu trên đường dẫn)
// post (gửi ngầm dữ liệu)

// tên miền : http://localhost:8000/xin-chao/vietpro

Route::get('xin-chao/vietpro.html', function () {
   echo 'xin chào';
   return 'vietpro';
});

//truyền tham số trên route
Route::get('xin-chao/{name?}/zzz/{job?}', function ($name='phúc',$job='vietpro') {
    echo "xin chào $name làm lại $job";
});
Route::get('test-connect', function () {
    $user=DB::table('users')->get();
    dd($user);
});
Route::get('get-all-data', function () {
    //lấy toàn bộ dữ liệu trong bảng users
    $users=App\Models\Users::all()->toArray();

});
// Thêm
Route::get('insert', function () {
    $user=new App\Models\Users;
    $user->full="NGuyễn A";
    $user->phone="1111111";
    $user->address="Địa chỉ A";
    $user->id_number="11111111";
    $user->save();

    echo $user->id;

});

// Sửa 
Route::get('update', function () {
    //tìm bản ghi theo khoá chính;
    $user=App\Models\Users::find(51);
    $user->full="NGuyễn B";
    $user->phone="2222222";
    $user->address="Địa chỉ B";
    $user->id_number="2222222";
    $user->save();

});

// Xoá
Route::get('delete', function () {
    //có thể là 1 mảng các id cần xoá
    // $id_array=[50,49,48];
    $id_xoa=51;
    //xoá theo khoá chính
    App\Models\Users::destroy($id_xoa);
});


// http://localhost:8000/    đây là trang user
// http://localhost:8000/add    đây là trang add_user
// http://localhost:8000/edit    đây là trang edit_user
Route::get('','UserController@getUser' );

Route::get('add','UserController@getAddUser' );
Route::post('add','UserController@postAddUser' );

Route::get('edit/{idUser}','UserController@getEditUser' );
Route::post('edit/{idUser}','UserController@postEditUser' );
Route::get('xinchao', function () {
    echo '<h1>VIETPRO</h1>';
});