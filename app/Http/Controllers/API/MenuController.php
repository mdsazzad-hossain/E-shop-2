<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\ChildMenu;
class MenuController extends Controller
{

    public function index()
    {
        $menu = Menu::latest()->with('get_child_menu')->get();
        $countMenu = $menu->count();
        $child_menu = ChildMenu::latest()->with('get_menu')->get();
        $countSubMenu = $child_menu->count();
        return response()->json([
            'menu'=>$menu,
            'child_menu'=>$child_menu,
            'countMenu'=>$countMenu,
            'countSubMenu'=>$countSubMenu,
            'message'=>200
        ],200);
    }

    public function child_index()
    {
        $menu = ChildMenu::latest()->with('get_menu:id,name')->get();
        return response()->json([
            'menu'=>$menu,
            'message'=>200
        ],200);
    }
    public function countSubMenu($id)
    {
        $data = ChildMenu::where('menu_id',$id)->count();
        return response()->json([
            'data'=>$data
        ],200);

    }

    public function store(Request $request)
    {
        $menu = Menu::create([
            'name' => $request['name'],
            'status' => $request['status']
        ]);

        $menu->save();
        return response()->json([
            'menu'=>$menu,
            'status'=> 200
        ]);
    }

    public function child_store(Request $request)
    {

        $child = ChildMenu::create([
            'menu_id' => $request['menu_id'],
            'name' => $request['name'],
            'status' => $request['status']
        ]);

        $child->save();
        return response()->json([
            'child'=>$child,
            'status'=> 200
        ]);
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::find($id);

        $menu->name = $request['name'];
        $menu->status = $request['status'];
        $menu->save();
        return response()->json([
            'menu'=>$menu,
            'status'=> 200
        ]);
    }

    public function publishMenu($id)
    {
        $menu = Menu::find($id);
        $menu->status = 1;
        $menu->save();
        return response()->json([
            'menu'=>$menu,
            'status'=> 200
        ]);
    }


    public function hideMenu($id)
    {
        $menu = Menu::find($id);
        $menu->status = 0;
        $menu->save();
        return response()->json([
            'menu'=>$menu,
            'status'=> 200
        ]);
    }


    public function removeMenu($id)
    {
        Menu::find($id)->update(['hide'=> 0]);
        return response()->json([
            'status'=> 200
        ]);
    }

    //submenu function start

    public function updateSubMenu(Request $request, $id)
    {
        $child_menu = ChildMenu::find($id);

        $child_menu->menu_id = $request['menu_id'];
        $child_menu->name = $request['name'];
        $child_menu->status = $request['status'];
        $child_menu->save();
        return response()->json([
            'child_menu'=>$child_menu,
            'status'=> 200
        ]);
    }

    public function publishSubMenu($id)
    {
        $child_menu = ChildMenu::find($id);
        $child_menu->status = 1;
        $child_menu->save();
        return response()->json([
            'child_menu'=>$child_menu,
            'status'=> 200
        ]);
    }


    public function hideSubMenu($id)
    {
        $child_menu = ChildMenu::find($id);
        $child_menu->status = 0;
        $child_menu->save();
        return response()->json([
            'child_menu'=>$child_menu,
            'status'=> 200
        ]);
    }


    public function removeSubMenu($id)
    {
        ChildMenu::find($id)->update(['hide'=> 0]);
        return response()->json([
            'status'=> 200
        ]);
    }

    //submenu function end
}
