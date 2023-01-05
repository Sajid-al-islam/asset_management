<?php

namespace Database\Seeders;

use App\Models\AssetCategory;
use App\Models\AssetSubCategory;
use Illuminate\Database\Seeder;

class AssetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_name = [
            'Entertainment' => [
                'Film'
            ],
            'Stationery' => [
                'Stepler',
                'Punch Machine'
            ],
            'Furniture' => [
                'Chair',
                'Table'
            ],
            'Studio' => [
                'Camera',
                'Mouthpest',
                'Hanger',
                'Camera Stand',
                'Light'
            ],
            'Internet & Web' => [
                'Router',
                'Modem'
            ],
            'Kitchen' => [
                'blender'
            ],
            'Computer & Accessories' => [
                'Computer',
                'Mouse',
                'Keyboard',
                'Printer',
            ],
            'Electrical & Electronics' => [
                'Fan' ,
                'Light',
                'Multiplug'
            ],
            'Transport' => [
                'Motor Cycle'
            ],
        ];
        
        AssetCategory::truncate();
        foreach ($category_name as $category_name => $sub_categories) {
            $asset_category = new AssetCategory;
            $asset_category->name = $category_name;
            $asset_category->save();
            foreach ($sub_categories as $sub_category_name) {
                $asset_sub_category = new AssetSubCategory;
                $asset_sub_category->category_id = $asset_category->id;
                $asset_sub_category->name = $sub_category_name;
                $asset_sub_category->save();
            }
        }

    }
}
