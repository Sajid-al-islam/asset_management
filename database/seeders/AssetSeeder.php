<?php

namespace Database\Seeders;

use App\Models\AssetPriceHistory;
use App\Models\Assets;
use App\Models\AssetSpecification;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assets::truncate();

        $asset = Assets::create([
            'name'=>'Computer',
            'category_id'=>'7',
            'sub_category_id'=>'14',
            'is_lost'=>0,
            'description'=>'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Proin eget tortor risus.',
            'price'=> 25000,
            'v_no'=>'Vn13123',
            'sv_no'=>'SEV1234',
            'code'=>'ASSET-0001',
            'location'=>'3rd floor',
            'buy_location_id'=>'1',
            'depreciation_amount'=>'5',
            'image'=>'uploads/images/Asset_1671534030.png',
            'asset_voucher_img'=>NULL,
            'designation_id'=>'4',
            'designation_mobile_number'=>'01223454585',
            'is_warrenty'=>'warrenty',
            'warrenty_date'=>'2022-12-31 18:00:00',
            'hand_over_date'=>'2022-12-08 18:00:00',
            'buying_date'=>'2022-12-08 18:00:00',
            'comments'=>NULL,
            'slug'=>NULL,
            'status'=>1,
            'creator'=>'1',
            'created_at'=>'2022-12-20 05:00:30',
            'updated_at'=>'2022-12-20 05:00:30'
        ]);

        $asset_spec = AssetSpecification::create(
            [
                'asset_id'=> $asset->id,
                'title'=>'Processor',
                'value'=>'Core I3',
                'creator'=>'1',
                'created_at'=> $asset->created_at,
                'updated_at'=> $asset->updated_at
            ],
            [
                'asset_id'=> $asset->id,
                'title'=>'Ram',
                'value'=>'8 GB',
                'creator'=>'1',
                'created_at'=> $asset->created_at,
                'updated_at'=> $asset->updated_at
            ],
            [
                'asset_id'=> $asset->id,
                'title'=>'Motherboard',
                'value'=>'B450M',
                'creator'=>'1',
                'created_at'=> $asset->created_at,
                'updated_at'=> $asset->updated_at
            ]
        );

        $asset_price = AssetPriceHistory::create([
            "asset_id" => $asset->id,
            "price" => $asset->price,
            "creator" => 1,
            "created_at"=> $asset->created_at,
            "updated_at"=> $asset->updated_at
        ]);

        $asset2 = Assets::create(
            [
                'name'=>'Gaming Chair',
                'category_id'=>'7',
                'sub_category_id'=>'14',
                'is_lost'=> 0,
                'description'=>'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Proin eget tortor risus.',
                'price'=> 12000,
                'v_no'=>'Vn13123',
                'sv_no'=>'SEV1234',
                'code'=>'ASSET-0001',
                'location'=>'3rd floor',
                'buy_location_id'=>'1',
                'depreciation_amount'=>'5',
                'image'=>'uploads/images/Asset_1671459405.png',
                'asset_voucher_img'=>NULL,
                'designation_id'=>'4',
                'designation_mobile_number'=>'01223454585',
                'is_warrenty'=>'warrenty',
                'warrenty_date'=>'2022-12-31 18:00:00',
                'hand_over_date'=>'2022-12-08 18:00:00',
                'buying_date'=>'2020-12-20 05:00:30',
                'comments'=>NULL,
                'slug'=>NULL,
                'status'=>1,
                'creator'=>'1',
                'created_at'=>'2022-12-08 18:00:00',
                'updated_at'=>'2022-12-08 18:00:00'
            ],
        );

        $asset_spec2 = AssetSpecification::create(
            [
                'asset_id'=> $asset2->id,
                'title'=>'Brand',
                'value'=>'DX Racer',
                'creator'=>'1',
                'created_at'=> $asset2->created_at,
                'updated_at'=> $asset2->updated_at
            ],
            [
                'asset_id'=> $asset2->id,
                'title'=>'Model',
                'value'=>'D6000',
                'creator'=>'1',
                'created_at'=> $asset2->created_at,
                'updated_at'=> $asset2->updated_at
            ],
            [
                'asset_id'=> $asset2->id,
                'title'=>'Color',
                'value'=>'Black and white',
                'creator'=>'1',
                'created_at'=> $asset2->created_at,
                'updated_at'=> $asset2->updated_at
            ]
        );

        $asset_price2 = AssetPriceHistory::create([
            "asset_id" => $asset2->id,
            "price" => $asset2->price,
            "creator" => 1,
            "created_at"=> $asset2->created_at,
            "updated_at"=> $asset2->updated_at
        ]);

        $asset3 = Assets::create(
            [
                'name'=>'Table',
                'category_id'=>'8',
                'sub_category_id'=>'10',
                'is_lost'=> 0,
                'description'=>'Vivamus suscipit tortor eget felis porttitor volutpat. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus suscipit tortor eget felis porttitor volutpat. Donec sollicitudin molestie malesuada. Proin eget tortor risus.',
                'price'=> 12000,
                'v_no'=>'Vn13123',
                'sv_no'=>'SEV1234',
                'code'=>'ASSET-0001',
                'location'=>'3rd floor',
                'buy_location_id'=>'1',
                'depreciation_amount'=>'5',
                'image'=>'uploads/images/Table.png',
                'asset_voucher_img'=>NULL,
                'designation_id'=>'4',
                'designation_mobile_number'=>'01223454585',
                'is_warrenty'=>'warrenty',
                'warrenty_date'=>'2022-12-31 18:00:00',
                'hand_over_date'=>'2022-12-08 18:00:00',
                'buying_date'=>'2021-12-20 05:00:30',
                'comments'=>NULL,
                'slug'=>NULL,
                'status'=>1,
                'creator'=>'1',
                'created_at'=>'2022-12-08 18:00:00',
                'updated_at'=>'2022-12-08 18:00:00'
            ]
        );

        $asset_spec2 = AssetSpecification::create(
            [
                'asset_id'=> $asset3->id,
                'title'=>'Brand',
                'value'=>'Hatil',
                'creator'=>'1',
                'created_at'=> $asset3->created_at,
                'updated_at'=> $asset3->updated_at
            ],
            [
                'asset_id'=> $asset3->id,
                'title'=>'Color',
                'value'=>'Grey',
                'creator'=>'1',
                'created_at'=> $asset3->created_at,
                'updated_at'=> $asset3->updated_at
            ],
            [
                'asset_id'=> $asset3->id,
                'title'=>'Model',
                'value'=>'Fleming-307-Leg',
                'creator'=>'1',
                'created_at'=> $asset3->created_at,
                'updated_at'=> $asset3->updated_at
            ]
        );

        $asset_price3 = AssetPriceHistory::create([
            "asset_id" => $asset3->id,
            "price" => $asset3->price,
            "creator" => 1,
            'created_at'=> $asset3->created_at,
            'updated_at'=> $asset3->updated_at

        ]);
    }
}
