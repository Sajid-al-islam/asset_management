<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WebsiteController extends Controller
{
    public function website()
    {

        echo "website";
    }
    public function backup()
    {
        \Artisan::call('database:backup');

        return response()->json([
            "message" => "database backed up successfully"
        ]);
    }
}
