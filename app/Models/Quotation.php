<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $appends = [
        'date'
    ];
    
    public function quotation_items() {
        return $this->hasMany(QuotationAssets::class, 'quotation_id', 'id');
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
