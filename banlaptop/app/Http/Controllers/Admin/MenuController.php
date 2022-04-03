<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function create(){
        echo view('admin.menu.add',[
            'title'=>'Thêm Danh Mục',
            'menus' => $this->menuService->getParent()
        ]);
    }
    public function store(CreateFormRequest $request){
        $result = $this->menuService->create($request);
        return redirect()->back();
    }
    public function index(){
        echo view('admin.menu.list',[
            'title'=>'Danh sách danh mục',
            'menus' => $this->menuService->getAll()
        ]);
    }
}
