<?php

namespace App\Http\Services\Menu;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class MenuService
{
    public function getParent(){
        return Menu::where('parent_id',0)->get();//lấy ra những cột có parent_id =0
    }
    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);//sắp xếp lớn nhất phân trang
    }
    public function create($request){
        try{
            Menu::create([//thêm dữ liệu vào row
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'slug' => Str::slug($request->input('name'),'-')
            ]);
            Session::flash('success','Tạo Danh Mục Thành Công');
        }
        catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
}
