<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $appends = [
        'audit_complete',
    ];

    public function getAuditCompleteAttribute() {
        $asset = Assets::where('status', 1)->count();
        $audit_asset_count = AuditAssets::where('audit_id', $this->id)->count();
        $response = [
            "status"=> 'incomplete',
            "total_asset" => $asset,
            "audited_asset" => $audit_asset_count
        ];
        if($asset == $audit_asset_count) {
            $response['status'] = 'complete';
            return $response;
        }else {
            return $response;
        }
    }

    public function audit_assets() {
        return $this->hasMany(AuditAssets::class, 'audit_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'assign_to');
    }
}
