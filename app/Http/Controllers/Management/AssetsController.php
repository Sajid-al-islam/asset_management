<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\AssetCategory;
use App\Models\AssetPriceHistory;
use App\Models\Assets;
use App\Models\AssetSpecification;
use App\Models\AssetSubCategory;
use App\Models\LostAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class AssetsController extends Controller
{
    public function index(Request $request)
    {
        $query = Assets::where('status', 1);
        if ($request->has('key') && strlen($request->key) > 0) {
            $key = $request->key;
            $query->where(function ($q) use ($key) {
                $q->where('name', $key)
                    ->orWhere('name', 'LIKE', '%' . $key . '%')
                    ->orWhere('v_no', 'LIKE', '%' . $key . '%')
                    ->orWhere('sv_no', 'LIKE', '%' . $key . '%')
                    ->orWhere('code', 'LIKE', '%' . $key . '%');
            });
        }
        $assets = $query->paginate(8);
        return response()->json([
            'assets' => $assets
        ]);
    }

    public function dashboard_stats() {
        $stats = [];
        $asset_count = Assets::count();
        $category_count = AssetCategory::count();
        $sub_category_count = AssetSubCategory::count();
        $lost_asset_count = Assets::where('is_lost', 1)->count();
        $available_asset_count = Assets::where('is_lost', 0)->count();

        $stats = [
            "asset_count" => $asset_count,
            "category_count" => $category_count,
            "sub_category_count" => $sub_category_count,
            "lost_asset_count" => $lost_asset_count,
            "available_asset_count" => $available_asset_count
        ];

        return response()->json([
            "stats" => $stats
        ]);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'category_id' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'v_no' => ['required'],
            'sv_no' => ['required'],
            'location' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $user_id = auth()->user()->id;
        
        $asset = new Assets;
        $asset->name = $request->name;
        $asset->category_id = $request->category_id;
        $asset->sub_category_id = $request->sub_category_id;
        $asset->description = $request->description;
        $asset->price = $request->price;


        $asset->v_no = $request->v_no;
        $asset->sv_no = $request->sv_no;
        $asset->location = $request->location;
        $asset->buying_date = $request->buying_date;
        // $asset->hand_over_date = $request->hand_over_date;
        // $asset->designation_id = $request->designation_id;
        // $asset->designation_mobile_number = $request->designation_mobile_number;
        $asset->buy_location_id = $request->buy_location_id;
        $asset->cs_quotation_id = $request->cs_quotation_id;
        $asset->depreciation_amount = $request->depreciation_amount;

        if($request->is_lost == 'lost') 
            $asset->is_lost = 1;
        else 
            $asset->is_lost = 0;
        
        $asset->is_warrenty = $request->is_warrenty;
        $asset->warrenty_date = $request->warrenty_date;
        $asset->creator = $user_id;
        $asset->status = 1;

        if($request->hasFile('asset_image')) {
            $imageName = Storage::put('uploads/images',$request->file('asset_image'));
            $asset->image = $imageName;
        }

        if($request->hasFile('asset_voucher_img')) {

            $imageName = Storage::put('uploads/images',$request->file('asset_voucher_img'));
            $asset->asset_voucher_img = $imageName; 
        }
        
        $asset->save();

        $asset_price = new AssetPriceHistory;
        $asset_price->asset_id = $asset->id;
        $asset_price->price = $asset->price;
        $asset_price->creator = $user_id;
        $asset_price->save();

        if($request->has('asset_specification')) {
            $asset_spec = json_decode($request->asset_specification);
            foreach ($asset_spec as $key => $value) {
                $asset_specification = new AssetSpecification;
                $asset_specification->asset_id = $asset->id;
                $asset_specification->title = $value->title;
                $asset_specification->value = $value->description;
                $asset_specification->creator = $user_id;
                $asset_specification->save();
            }
        }

        if($request->is_lost == 'lost') {
            $asset_lost = new LostAsset;
            $asset_lost->asset_id = $asset->id;
            $asset_lost->lost_reason = $request->lost_reason;
            $asset_lost->lost_date = $request->lost_date;
            $asset_lost->creator = $user_id;
            $asset_lost->save();
        }

        if(strlen($asset->id) == 1){
            $asset->code = "ASSET-000" . $asset->id;
        }elseif(strlen($asset->id) == 2){
            $asset->code = "ASSET-00" . $asset->id;
        }elseif(strlen($asset->id) == 3){
            $asset->code = "ASSET-0" . $asset->id;
        }else{
            $asset->code = "ASSET-" . $asset->id;
        }

        $asset->save();
    
        return response()->json([
            'message' => "Asset created successfully",
            'asset' => $asset
        ]);
    }

    public function getSubCategory(Request $request)
    {
        $sub_categories = AssetSubCategory::where('category_id', $request->category_id)
        ->where('status', 1)->get();

        return response()->json($sub_categories);
    }

    public function recycle_assets()
    {
        $assets = Assets::where('status', 0)->paginate(8);
        return response()->json([
            'assets' => $assets
        ]);
    }

    public function restore(Request $request) {
        $asset = Assets::find($request->id);
        $asset->status = 1;
        $asset->update();

        return response()->json([
            'message' => 'Asset restored successfully'
        ]);
    }

    public function get_single_asset(Request $request)
    {
        $asset = Assets::where('id', $request->id)
        ->where('status', 1)->with([
            'category', 
            'sub_category', 
            'asset_specification', 
            'asset_lost',
            'price_history',
            'buy_location',
            'user'
        ])->first();

        return response()->json([
            'asset' => $asset
        ]);
    }

    public function update(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => ['required', 'string'],
            'category_id' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'v_no' => ['required'],
            'sv_no' => ['required'],
            'location' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $user_id = auth()->user()->id;

        $asset = Assets::find($request->id);
        $asset->name = $request->name;
        $asset->category_id = $request->category_id;
        $asset->sub_category_id = $request->sub_category_id;
        $asset->description = $request->description;
        $asset->price = $request->price;

        $asset_check = AssetPriceHistory::where('asset_id', $request->id)->first();
        // checking if price history exist
        if($asset_check !== null) {

            // if old price is not same create a new price history
            if($asset_check->price != $request->price) {
                $asset_price = new AssetPriceHistory;
                $asset_price->asset_id = $request->id;
                $asset_price->price = $request->price;
                $asset_price->creator = $user_id;
                $asset_price->save();
            }
        }

        // $asset->current_value = $request->current_value;
        $asset->v_no = $request->v_no;
        $asset->sv_no = $request->sv_no;
        $asset->location = $request->location;
        $asset->designation_id = $request->designation_id;
        $asset->buy_location_id = $request->buy_location_id;
        $asset->cs_quotation_id = $request->cs_quotation_id;
        $asset->designation_mobile_number = $request->designation_mobile_number;
        $asset->depreciation_amount = $request->depreciation_amount;
        $asset->buying_date = $request->buying_date;

        if($request->hasFile('asset_image')) {
            if(file_exists(public_path().'/'.$asset->image)){
                try {
                    unlink(public_path().'/'.$asset->image);
                } catch (\Exception $e) {
                    Log::debug($e->getMessage());
                }
            }
            // $imageName = 'Asset_' . time().'.'.$request->asset_image->getClientOriginalExtension();
            $imageName = Storage::put('uploads/images',$request->file('asset_image'));
            $asset->image = $imageName;
        }

        if($request->hasFile('asset_voucher_img')) {
            if(file_exists(public_path().'/'.$asset->asset_voucher_img)){
                try {
                    unlink(public_path().'/'.$asset->asset_voucher_img);
                } catch (\Exception $e) {
                    Log::debug($e->getMessage());
                }
            }
            $imageName = Storage::put('uploads/images',$request->file('asset_voucher_img'));
            $asset->asset_voucher_img = $imageName;
        }

        if($request->hasFile('acceptance_img')) {
            if(file_exists(public_path().'/'.$asset->acceptance_img)){
                try {
                    unlink(public_path().'/'.$asset->acceptance_img);
                } catch (\Exception $e) {
                    Log::debug($e->getMessage());
                }
            }
            $imageName = Storage::put('uploads/images',$request->file('acceptance_img'));
            $asset->acceptance_img = $imageName;
        }

        if($request->is_lost == 'lost') 
            $asset->is_lost = 1;
        else 
            $asset->is_lost = 0;
        
        $asset->is_warrenty = $request->is_warrenty;
        $asset->warrenty_date = $request->warrenty_date;
        $asset->creator = $user_id;

        $asset->status = 1;
        $asset->hand_over_date = $request->hand_over_date;
        $asset->update();

        $asset_delete = AssetSpecification::where('asset_id', $request->id)->delete(); 
        if($request->has('asset_specification')) {
            $asset_spec = json_decode($request->asset_specification);
            foreach ($asset_spec as $key => $value) {
                $asset_specification = new AssetSpecification;
                $asset_specification->asset_id = $asset->id;
                $asset_specification->title = $value->title;
                $asset_specification->value = $value->value;
                $asset_specification->creator = $user_id;
                $asset_specification->save();
            }
        }
        
        if($request->is_lost == 'lost') {
            $asset_lost = LostAsset::where('asset_id', $asset->id)->first();
            $asset_lost->asset_id = $asset->id;
            $asset_lost->lost_reason = $request->lost_reason;
            $asset_lost->lost_date = $request->lost_date;
            $asset_lost->creator = $user_id;
            $asset_lost->update();
        }

        return response()->json([
            'message' => "Asset Update successfully",
            'asset' => $asset
        ]);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $asset = Assets::find($request->id);
        $asset->status = 0;
        $asset->update();

        return response()->json([
            'message' => 'Asset deleted successfully'
        ]);
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $asset = Assets::where('id', $request->id)->delete();

        return response()->json([
            'message' => 'Asset deleted successfully'
        ]);
    }
}
