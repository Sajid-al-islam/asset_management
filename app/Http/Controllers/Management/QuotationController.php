<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\QuotationAssets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('all')) {
            $quotations = Quotation::get();
        }
        else {
            $quotations = Quotation::paginate(8);
        }

        return response()->json(['quotations' => $quotations]);
    }

    public function quotation_details(Request $request)
    {
        $quotation = Quotation::where('id', $request->id)->with(['quotation_items'])->first();
        
        return response()->json(['quotation' => $quotation]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:quotations'],
            'description' => ['required', 'string'],
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $quotation = new Quotation;
        $quotation->name = $request->name;
        $quotation->description = $request->description;
        $quotation->location = $request->location;

        if($request->has('image')) {
            $imageName = 'Quoate_' . time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads\images'), $imageName);
            $quotation->image = $imageName;
        }

        $quotation->mobile_number = $request->mobile_number;
        $quotation->address = $request->address;
        $quotation->save();

        if(strlen($quotation->id) == 1){
            $quotation->code = "QUOATE-000" . $quotation->id;
        }elseif(strlen($quotation->id) == 2){
            $quotation->code = "QUOATE-00" . $quotation->id;
        }elseif(strlen($quotation->id) == 3){
            $quotation->code = "QUOATE-0" . $quotation->id;
        }else{
            $quotation->code = "QUOATE-" . $quotation->id;
        }

        $quotation->save();

        if($request->has('quote_items')) {
            $quotes = json_decode($request->quote_items);
            foreach ($quotes as $key => $value) {
                $quote_item = new QuotationAssets;
                $quote_item->quotation_id = $quotation->id;
                $quote_item->shop_name = $value->shop_name;
                $quote_item->title = $value->title;
                $quote_item->description = $value->description;
                $quote_item->price = $value->price;
                $quote_item->save();
            }
        }
        
        return response()->json([
            "message" => "Quotation created successfully",
            "quotation" => $quotation
        ], 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $quotation = Quotation::find($request->id);
        $quotation->name = $request->name;
        $quotation->description = $request->description;
        if($request->has('image')) {
            if(file_exists(public_path('uploads/images') . $quotation->image)) {
                unlink(public_path('uploads/images') . $quotation->image);
            }
            $imageName = 'Quoate_' . time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads\images'), $imageName);
            $quotation->image = $imageName;
        }
        $quotation->location = $request->location;
        $quotation->mobile_number = $request->mobile_number;
        $quotation->address = $request->address;
        $quotation->update();

        $quote_items_delete = QuotationAssets::where('quotation_id', $request->id)->delete(); 
        if($request->has('quote_items')) {
            $quotes = json_decode($request->quote_items);
            foreach ($quotes as $key => $value) {
                $quote_item = new QuotationAssets;
                $quote_item->quotation_id = $quotation->id;
                $quote_item->title = $value->title;
                $quote_item->description = $value->description;
                $quote_item->price = $value->price;
                $quote_item->save();
            }
        }

        return response()->json([
            "message" => "Quotation updated successfully"
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

        $quotation_assets = QuotationAssets::where('quotation_id', $request->id)->get();
        if($quotation_assets != null) {
            $quotation_delete = QuotationAssets::where('quotation_id', $request->id)->delete();
        }
        $Quotation = Quotation::where('id', $request->id)->delete();
        
        return response()->json([
            "message" => "Quotation deleted successfully"
        ], 200); 

    }
}
