<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Audit;
use App\Models\AuditAssets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('all')) {
            $audits = Audit::get();
        }
        else {
            $audits = Audit::with('user')->paginate(8);
        }

        return response()->json(['audits' => $audits]);
    }

    public function audit_details(Request $request)
    {
        $audit = Audit::where('id', $request->id)->select('id', 'title')
        ->with(['audit_assets'=>  function ($q)
        {
            return $q->with("assets");
        }])
        ->first();
        
        return response()->json(['audit' => $audit]);
    }

    public function audited(Request $request)
    {

        // $audit_id = Audit::where('id', $request->id)->select('id', 'title')->first();
        // $audited_assets = AuditAssets::where('audit_id', $audit_id->id)->with('assets')->get();
        // $audit_asset_ids = AuditAssets::where('audit_id', $audit_id->id)->with('assets')->pluck('asset_id');
        // $audit_assets = Assets::where('status', 1)->whereIn('id', $audit_asset_ids)->paginate(8);
        $audit = Audit::where('id', $request->id)->select('id', 'title')
        ->with(['audit_assets'=>  function ($q)
        {
            return $q->with("assets");
        }])
        ->first();
        
        return response()->json(['audit_assets' => $audit]);
    }

    public function not_audited(Request $request)
    {
        $audit_id = Audit::where('id', $request->id)->select('id', 'title')->first();
        
        $audit_asset_ids = AuditAssets::where('audit_id', $audit_id->id)->pluck('asset_id');
        $audit_assets = Assets::where('status', 1)->whereNotIn('id', $audit_asset_ids)->paginate(8);
        
        
        return response()->json(['audit_assets' => $audit_assets]);
    }

    public function audit_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => ['required'],
            'asset_id' => ['required'],
            'status' => ['required']
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $audit_asset = new AuditAssets;
        $audit_asset->audit_id = $request->audit_id;
        $audit_asset->asset_id = $request->asset_id;
        $audit_asset->is_ok = $request->status;
        $audit_asset->comment = $request->comment;
        $audit_asset->save();

        
        return response()->json([
            "audit_id" => $audit_asset->audit_id,
            "message" => "asset audited successfully"
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'unique:audits'],
            'description' => ['required', 'string'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $audit = new Audit;
        $audit->title = $request->title;
        $audit->description = $request->description;
        $audit->assign_to = $request->assign_to;
        $audit->start_date = $request->start_date;
        $audit->end_date = $request->end_date;
        $audit->save();

        return response()->json([
            "message" => "asset category created successfully",
            "audit" => $audit
        ], 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'title' => ['required', 'string', 'unique:audits'],
            'description' => ['required', 'string'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $audit = Audit::find($request->id);
        $audit->title = $request->title;
        $audit->description = $request->description;
        $audit->assign_to = $request->assign_to;
        $audit->start_date = $request->start_date;
        $audit->end_date = $request->end_date;
        $audit->update();

        return response()->json([
            "message" => "asset category updated successfully"
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
        $audit = Audit::where('id', $request->id)->delete();

        return response()->json([
            "message" => "asset category deleted successfully"
        ], 200); 

    }
}
