<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostAsset extends Model
{
    use HasFactory;

    protected $appends = [
        'lost_date_fromated'
    ];

    public function getLostDateFromatedAttribute() {
        return [
            Carbon::parse($this->lost_date)->format('Y-m-d'),
        ];
    }
}
