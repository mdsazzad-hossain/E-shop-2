<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Test;
use App\SubTest;
use Exception;
use Illuminate\Support\Facades\DB;
class TestController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            'user'=>$user
        ],200);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $test = Test::create($request->only(['name', 'msg']));
            foreach($request->details as $key => $item){
                SubTest::create(array_merge($item, ['test_id' => $test->id]));
            }
            DB::commit();
            return response()->json([
                'user'=>$user
            ],200);
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try{
    //         $consignment = Consignment::create($request->only(['consign_ref', 'supplier_id', 'total_price']));
    //         foreach($request->details as $key => $item){
    //             ConsignmentDetails::create(array_merge($item, ['qty' => $item['copies'], 'consignment_id' => $consignment->id]));
    //         }
    //         DB::commit();
    //         return response(['message' => 'Consignment Created!']);
    //     }catch(Exception $e){
    //         DB::rollBack();
    //         return response(['message' => 'Opps! some Error!'], 500);
    //     }
    // }
}

