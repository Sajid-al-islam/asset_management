<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\AssetBuyLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetBuyLocationController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('all')) {
            $locations = AssetBuyLocation::where('status', 1)->get();
        }else {
            $locations = AssetBuyLocation::where('status', 1)->paginate(8);
        }

        return response()->json(['locations' => $locations]);
    }

    public function get_single_category(Request $request)
    {
        $location = AssetBuyLocation::where('id', $request->id)->first();
        
        return response()->json(['location' => $location]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:asset_buy_locations,name'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $location = new AssetBuyLocation;
        $location->name = $request->name;
        $location->address = $request->address;
        $location->mobile_number = $request->mobile_number;
        $location->status = 1;
        $location->save();

        return response()->json([
            "message" => "asset location created successfully",
            "asset_location" => $location
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $location = AssetBuyLocation::find($request->id);
        $location->name = $request->name;
        $location->address = $request->address;
        $location->mobile_number = $request->mobile_number;
        $location->status = 1;
        $location->update();

        return response()->json([
            "message" => "asset location updated successfully"
        ], 200); 
    }

    public function delete(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $location = AssetBuyLocation::find($request->id);
        $location->status = 0;
        $location->update();

        return response()->json([
            "message" => "asset location deleted successfully"
        ], 200); 

    }

    public function destroy(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $location = AssetBuyLocation::where('id', $request->id)->delete();

        return response()->json([
            "message" => "asset location deleted successfully"
        ], 200); 

    }
}
