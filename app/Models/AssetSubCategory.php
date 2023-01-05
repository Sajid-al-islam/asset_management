<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetSubCategory extends Model
{
    use HasFactory;

    protected $appends = [
        'date'
    ];

    public function assets() {
        return $this->hasMany(Assets::class, 'sub_category_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(AssetCategory::class, 'id', 'category_id');
    }

    public function getDateAttribute() {
        return [
            $this->created_at->format('d-m-Y'),
            $this->created_at->format('d,M Y'),
            $this->created_at->format('d-m-Y h:i:s'),
            $this->created_at->format('d-M-Y h:i:s'),
            $this->created_at->format('d-F-Y h:i:s'),
            $this->created_at->format('d-F-Y h:i:s a'),
            $this->created_at->format('h:i:s a'),
            $this->created_at->format('h:i:s'),
            $this->created_at->diffForHumans(),
        ];
    }
}
