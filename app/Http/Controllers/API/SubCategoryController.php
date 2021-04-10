<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use App\Models\Category;
use App\Models\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{

    public function index()
    {
        $total = SubCategory::all()->count();
        $subCat = SubCategory::latest()->with('get_category')->get();
        return response()->json([
            'subCat'=>$subCat,
            'total'=>$total,
            'message'=>'success'
        ],200);
    }


    public function store(Request $request)
     {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $roleId = Role::where(['role'=>'admin'])->get();
        foreach ($roleId as $key => $value) {
            $id = $value->id;

        }

        if($request->get('image')){

            $image = $request->get('image');
            $name = Str::random(5).'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $img = Image::make($request->image);
            $upload_path = public_path()."/images/";
        }
        $post = SubCategory::create([
            'category_id'    => $request->category_id,
            'role_id'        => $id,
            'name'           => $request->name,
            'status'         => $request->status,
            'description'    => $request->description,
            'image'          => $name
        ]);
        $img->save($upload_path.$name);

        return response()->json([
            'post'=>$post,
            'message'=>"success"
        ],200);

    }

    public function update_sub_category(Request $request, $id)
    {
        $data = SubCategory::find($id);

       if($request->get('image') != $data->image ){

            $image = $request->get('image');
            $name = Str::random(5).'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $img = Image::make($request->image);
            $upload_path = public_path()."/images/";

       };


        $data->category_id = $request->category_id;
        $data->role_id     = $request->role_id;
        $data->name        = $request->name;
        $data->status      = $request->status;
        $data->description = $request->description;
        if ($request->get('image') != $data->image) {
            $data->image = $name;
        }else{
            $data->image = $request->image;
        }
        if ($data->save()) {
            $img->save($upload_path.$name);

            return response()->json([
                'data'=>$data,
                'message'=>"success"
            ],200);
        };

    }

    public function publish(Request $request, $id)
    {
        SubCategory::find($id)->update(['status'=>1]);
        return response()->json([
            'data'=>$data,
            'status'=> 200
        ]);
    }
    public function hide_sub_category(Request $request, $id)
    {
        SubCategory::find($id)->update(['status'=>0]);
        return response()->json([
            'message'=>'success',
            'status'=> 200
        ]);
    }
    public function destroy_sub_category($id)
    {
        SubCategory::find($id)->update(['hide'=>0]);
        return response()->json([
            'message'=>'success',
            'status'=> 200
        ]);
    }
}
