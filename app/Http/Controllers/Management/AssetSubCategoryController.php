<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\AssetSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetSubCategoryController extends Controller
{
    public function index(Request $request)
    {   
        if($request->has('all')) {
            $asset_categories = AssetSubCategory::where('status', 1)->get();
        }else {
            $asset_categories = AssetSubCategory::where('status', 1)->with('category')->paginate(8);
        }

        return response()->json(['sub_categories' => $asset_categories]);
    }

    public function get_single_category(Request $request)
    {
        $category = AssetSubCategory::where('id', $request->id)
        ->with(['assets' => function($q) {
            return $q->where('status', 1);
        }, 'category' => function($q) {
            return $q->where('status', 1);
        }])->first();
        
        return response()->json(['category' => $category]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => ['required'],
            'name' => ['required', 'string', 'unique:asset_sub_categories,name'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $asset_category = new AssetSubCategory;
        $asset_category->category_id = $request->category_id;
        $asset_category->name = $request->name;
        $asset_category->status = 1;
        $asset_category->save();

        return response()->json([
            "message" => "asset category created successfully",
            "asset_category" => $asset_category
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'category_id' => ['required'],
            'name' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $asset_category = AssetSubCategory::find($request->id);
        $asset_category->category_id = $request->category_id;
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
        $asset_category = AssetSubCategory::find($request->id);
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
        $asset_category = AssetSubCategory::where('id', $request->id)->delete();

        return response()->json([
            "message" => "asset category deleted successfully"
        ], 200); 

    }
}
