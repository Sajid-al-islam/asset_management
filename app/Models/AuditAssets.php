<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditAssets extends Model
{
    use HasFactory;

    public function assets() {
        return $this->belongsTo(Assets::class, 'asset_id', 'id', Audit::class);
    }
}
