<?php

namespace App\Http\Controllers;
use App\Http\Requests\{AddUserRequest,EditUserRequest};
use Illuminate\Http\Request;
use App\Models\Users;
class UserController extends Controller
{
    function getUser(request $r) {
        // truyền biên sang view
        //paginate(số bản ghi trong 1 trang)
        if($r->has('search'))
        {
            $keyWord=$r->search;
            $data['users']=Users::where('full','like',"%$keyWord%")->paginate(10);
        }
        else {
            $data['users']=Users::paginate(10);
        }
       
        // render view
        return view('user',$data);
    }

    function getAddUser() {
        return view('add_user');
    }
    function postAddUser(AddUserRequest $r)
    {
        //$r : chứa dữ liệu của ô input
        //phương thức $r->all() : lấy toàn bộ dữ liệu ô input để hiển thị
        //dd() : dùng rất nhiều trong laravel để bug lỗi
        //dd() : hiển thị tất cả dữ liệu , dừng toàn bộ chương trình
        // $r->validate([mảng các quy tắc],[mảng các thông báo])
        

        //key: tên của ô input
        //value : danh sách các quy tắc mà ô input đó phải tuân thủ 
        //(ngăn cách nhau bởi "|")
        // $rules=[
        //     'full'=>'required|min:3',
        //     'phone'=>'required',
        //     'address'=>'required',
        //     'id_number'=>'required'
        // ];

        //key: [tên ô input].[lỗi tương ứng];
        //value: Lời thông báo tương ứng
        // $messages=[
        //     'full.required'=>'Không được để trống họ và tên',
        //     'full.min'=>'Họ và tên không được nhỏ hơn 3 ký tự',
        //     'phone.required'=>'Không được để trống số điện thoại',
        //     'address.required'=>'Không được để trống địa chỉ',
        //     'id_number.required'=>'Không được để trống số CMT'

        // ];

        // $r->validate($rules,$messages);
        $user=new Users;
        $user->full=$r->full;
        $user->phone=$r->phone;
        $user->address=$r->address;
        $user->id_number=$r->id_number;
        $user->save();
        return redirect('')->with('thongBao','Đã thêm thành công');

    }

    function getEditUser($idUser) {
        //tìm ra bản ghi cần sửa
        $data['user']=Users::find($idUser);
        return view('edit_user',$data);
    }

    function postEditUser($idUser,EditUserRequest $r)
    {
        $user=Users::find($idUser);
        $user->full=$r->full;
        $user->phone=$r->phone;
        $user->address=$r->address;
        $user->id_number=$r->id_number;
        $user->save();
        //back lại trang submit
        //->with(key,value) : tạo 1 session flash
        return redirect()->back()->with('thongBao','Đã sửa thành công');
    }
    function delUser($idUser)
    {
        Users::destroy($idUser);
        return redirect()->back();
    }
}
