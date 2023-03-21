<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// $creator = Auth::user()->id;
class Assets extends Model
{
    use HasFactory;

    protected $appends = [
        'date',
        'hand_over',
        'warrenty_date_fromated',
        'buying_date_fromated',
        'updated_current_value',
        'depreciated_price',
    ];

    // adding creator dynamically
    // protected $attributes = [
    //     'creator' => 5,
    // ];

    public function category()
    {
        return $this->hasOne(AssetCategory::class, 'id' ,'category_id');
    }

    public function price_history()
    {
        return $this->hasMany(AssetPriceHistory::class, 'asset_id', 'id');
    }

    public function asset_specification()
    {
        return $this->hasMany(AssetSpecification::class, 'asset_id' ,'id');
    }

    public function asset_lost()
    {
        return $this->hasOne(LostAsset::class, 'asset_id' ,'id');
    }

    public function sub_category()
    {
        return $this->hasOne(AssetSubCategory::class, 'id','sub_category_id');
    }

    public function buy_location()
    {
        return $this->hasOne(AssetBuyLocation::class, 'id','buy_location_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','designation_id');
    }

    public function getUpdatedCurrentValueAttribute() {
        $asset_price = AssetPriceHistory::where('asset_id', $this->id)
        ->orderBy('id', 'DESC')->first();
        return $asset_price->price;
    }

    public function getDepreciatedPriceAttribute() {
        $year = Carbon::now()->diffInYears($this->buying_date);

        $percantage_price = (intval($this->depreciation_amount) / 100) * $this->price;
        $depreciated_price = $this->price - $percantage_price;
        // dd($percantage_price, $depreciated_price);
        if($year<1) {
            return $depreciated_price;
        }else {
            $depreciation_price = $year*$percantage_price;
            if($depreciation_price > $this->price) {
                return 0;
            }else {
                $depreciation_price = $this->price - $depreciation_price;
                return $depreciation_price;
            }
        }
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

    public function getHandOverAttribute() {
        return [
            Carbon::parse($this->hand_over_date)->format('d-m-Y'),
            Carbon::parse($this->hand_over_date)->format('Y-m-d'),
            Carbon::parse($this->hand_over_date)->format('d,M Y'),
            Carbon::parse($this->hand_over_date)->format('d-m-Y h:i:s'),
            Carbon::parse($this->hand_over_date)->format('d-M-Y h:i:s'),
            Carbon::parse($this->hand_over_date)->format('d-F-Y h:i:s'),
            Carbon::parse($this->hand_over_date)->format('d-F-Y h:i:s a'),
            Carbon::parse($this->hand_over_date)->format('h:i:s a'),
            Carbon::parse($this->hand_over_date)->format('h:i:s'),
            Carbon::parse($this->hand_over_date)->diffForHumans(),
        ];
    }

    public function getWarrentyDateFromatedAttribute() {
        return [
            Carbon::parse($this->warrenty_date)->format('Y-m-d'),
        ];
    }
    public function getBuyingDateFromatedAttribute() {
        return [
            Carbon::parse($this->buying_date)->format('Y-m-d'),
        ];
    }
}
