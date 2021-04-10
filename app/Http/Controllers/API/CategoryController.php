<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        $cat = Category::all()->count();
        $categories = Category::latest()->where('hide',1)->with('get_user:id,name','get_sub_category:id,category_id,name')->get();
        return response()->json([
            'categories'=>$categories,
            'cat'=>$cat,
            'message'=>'success'
        ],200);
    }

    public function countSubCategory($id)
    {
        $data = SubCategory::where('category_id',$id)->count();
        return response()->json([
            'data'=>$data
        ],200);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $roleId = Role::where(['role'=>'Admin'])->get();
        foreach ($roleId as $key => $value) {
            $id = $value->id;

        }
        if ($request->get('image')) {
            $image = $request->get('image');
            $name = Str::random(5).'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $img = Image::make($request->image);
            $upload_path = public_path()."/images/";
            $img->save($upload_path.$name);
        }


        $data = Category::create([
            'role_id'=> $id,
            'name' => $request['name'],
            'description' => $request['description'],
            'status' => $request['status']
        ]);
        if ($request->get('image')) {
            $data->image = $name;
        };
        $data->save();
        return response()->json([
            'data'=>$data,
            'status'=> 200
        ]);


    }

    public function update(Request $request, $id)
    {
        $data = Category::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);


        if ($data->image != $request->image) {
            $image = $request->get('image');
            $name = Str::random(5).'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $img = Image::make($request->image);
            $upload_path = public_path()."/images/";
            $img->save($upload_path.$name);
        };

        $data->role_id = $request->role_id;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->status = $request->status;
        if ($data->image != $request->image) {
            $data->image = $name;
        }else{
            $data->image = $request->image;
        };

        $data->save();
        return response()->json([
            'message'=>'success',
            'status'=> 200
        ]);
    }

    public function publish(Request $request, $id)
    {
        Category::find($id)->update(['status'=>1]);
        return response()->json([
            'message'=>'success',
            'status'=> 200
        ]);
    }
    public function hideCat(Request $request, $id)
    {
        Category::find($id)->update(['status'=>0]);
        return response()->json([
            'message'=>'success',
            'status'=> 200
        ]);
    }

    public function destroy($id)
    {
        Category::find($id)->update(['hide'=> 0]);
        return response()->json([
            'message'=>'success',
            'status'=> 200
        ]);
    }
}
