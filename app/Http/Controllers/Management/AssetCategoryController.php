<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\AssetCategory;
use App\Models\Assets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetCategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('all')) {
            $asset_categories = AssetCategory::where('status', 1)->get();
        }
        else {
            $asset_categories = AssetCategory::where('status', 1)->paginate(8);
        }

        return response()->json(['categories' => $asset_categories]);
    }

    public function get_single_category(Request $request)
    {
        if($request->has('is_product')) {
            $category = AssetCategory::where('id', $request->id)->with(['sub_category', 'assets' => function($q) {
                return $q->where('status', 1);
            }])->first();

            // $category = Assets::where('category_id', $request->id)->with(['category', 'sub_category'])->first();
        }else {
            $category = AssetCategory::where('id', $request->id)->with('sub_category')->first();
        }
        return response()->json(['category' => $category]);
    }

    public function filter(Request $request) {
        
        $assets = Assets::where('sub_category_id', $request->sub_category_id)
        ->where('category_id', $request->category_id)->where('status', 1)->get();

        return response()->json([
            'assets' => $assets
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:asset_categories'],
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $asset_category = new AssetCategory;
        $asset_category->name = $request->name;
        $asset_category->status = 1;
        $asset_category->save();

        return response()->json([
            "message" => "asset category created successfully",
            "asset_category" => $asset_category
        ], 200);
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

        $asset_category = AssetCategory::find($request->id);
        $asset_category->name = $request->name;
        $asset_category->status = 1;
        $asset_category->update();

        return response()->json([
            "message" => "asset category updated successfully"
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
        $asset_category = AssetCategory::find($request->id);
        $asset_category->status = 0;
        $asset_category->update();

        return response()->json([
            "message" => "asset category deleted successfully"
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
        $asset_category = AssetCategory::where('id', $request->id)->delete();

        return response()->json([
            "message" => "asset category deleted successfully"
        ], 200); 

    }

}
