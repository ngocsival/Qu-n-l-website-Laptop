<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class LoginController extends Controller
{
    //
    public function index(){
        return view('admin.users.login',['title' => 'Đăng Nhập Hệ Thống']);
    }
    public function store(Request $request)//lấy request hiện tại
    {
        $this->validate($request,[
            'email'=> 'required|email:filter',
            'password'=> 'required'
        ]);
        if (Auth::attempt([// thuộc tính xác thực
            'email'=> $request->input('email'),
            'password'=> $request->input('password')
        ], $request->input('remember')))  {
            return redirect()->route('admin');
        }

        Session()->flash('error','Email hoặc mật khẩu không đúng');

        return redirect()->back();
    }
}
