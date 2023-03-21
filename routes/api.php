<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    ['prefix' => 'v1', 'namespace' => 'Controllers'],
    function () {
        Route::group(['prefix' => '/user', 'middleware' => ['guest:api']], function () {
            Route::post('/get-token', 'Auth\ApiLoginController@get_token');
            Route::post('/api-login', 'Auth\ApiLoginController@login');
            Route::post('/api-register', 'Auth\ApiLoginController@register');
            Route::get('/auth-check', 'Auth\ApiLoginController@auth_check');
            Route::post('/forget-mail', 'Auth\ApiLoginController@forget_mail');
            Route::post('/check-code', 'Auth\ApiLoginController@check_code');
            Route::post('/logout-from-all-devices', 'Auth\ApiLoginController@logout_from_all_devices');
        });

        Route::group(['middleware' => ['auth:api']], function () {
            Route::group(['prefix' => 'user'], function () {
                Route::post('/api-logout', 'Auth\ApiLoginController@logout');
                Route::post('/user_info', 'Auth\ApiLoginController@user_info');
                Route::post('/check-auth', 'Auth\ApiLoginController@check_auth');
                Route::post('/find-user-info', 'Auth\ApiLoginController@find_user_info');
            });

            // Category routes
            Route::group(['prefix' => 'category'], function () {
                Route::get('/index', 'Management\AssetCategoryController@index');
                Route::get('/single', 'Management\AssetCategoryController@get_single_category');
                Route::post('/filter', 'Management\AssetCategoryController@filter');
                Route::post('/create', 'Management\AssetCategoryController@create');
                Route::post('/update', 'Management\AssetCategoryController@update');
                Route::post('/delete', 'Management\AssetCategoryController@delete');
                Route::post('/destroy', 'Management\AssetCategoryController@destroy');
            });

            // Sub category routes
            Route::group(['prefix' => 'sub_category'], function () {
                Route::get('/index', 'Management\AssetSubCategoryController@index');
                Route::get('/single', 'Management\AssetSubCategoryController@get_single_category');
                Route::post('/create', 'Management\AssetSubCategoryController@create');
                Route::post('/update', 'Management\AssetSubCategoryController@update');
                Route::post('/delete', 'Management\AssetSubCategoryController@delete');
                Route::post('/destroy', 'Management\AssetSubCategoryController@destroy');
            });

            // recycle routes
            Route::group(['prefix' => 'recycle'], function () {
                Route::get('/assets', 'Management\AssetsController@recycle_assets');
                Route::post('/restore', 'Management\AssetsController@restore');
                Route::post('/delete', 'Management\AssetsController@destroy');
            });

            // location routes
            Route::group(['prefix' => 'location'], function () {
                Route::get('/index', 'Management\AssetBuyLocationController@index');
                Route::get('/single', 'Management\AssetBuyLocationController@get_single_category');
                Route::post('/create', 'Management\AssetBuyLocationController@create');
                Route::post('/update', 'Management\AssetBuyLocationController@update');
                Route::post('/delete', 'Management\AssetBuyLocationController@delete');
                Route::post('/destroy', 'Management\AssetBuyLocationController@destroy');
            });

            // Quotation Routes
            Route::group(['prefix' => 'quotation'], function () {
                Route::get('/index', 'Management\QuotationController@index');
                Route::get('/single', 'Management\QuotationController@quotation_details');
                Route::post('/create', 'Management\QuotationController@create');
                Route::post('/update', 'Management\QuotationController@update');
                Route::post('/destroy', 'Management\QuotationController@destroy');
            });

            // Audit routes
            Route::group(['prefix' => 'audit'], function () {
                Route::get('/index', 'AuditController@index');
                Route::post('/create', 'AuditController@create');
                Route::get('/single', 'AuditController@audit_details');
                Route::get('/audited', 'AuditController@audited');
                Route::get('/not_audited', 'AuditController@not_audited');
                Route::post('/audit_details', 'AuditController@audit_details');
                Route::post('/audit_submit', 'AuditController@audit_submit');
                Route::post('/update', 'AuditController@update');
                Route::post('/destroy', 'AuditController@destroy');
            });

            Route::group(['prefix' => 'website'], function () {
                Route::post('/backup', 'WebsiteController@backup');                
            });

            // Asset Routes
            Route::group(['prefix' => 'asset'], function () {
                Route::get('/index', 'Management\AssetsController@index');
                Route::get('/dashboard_stats', 'Management\AssetsController@dashboard_stats');
                Route::get('/category_wise_stats', 'Management\AssetsController@category_wise_stats');
                Route::get('/getSubCategory', 'Management\AssetsController@getSubCategory');
                Route::get('/single', 'Management\AssetsController@get_single_asset');
                Route::post('/create', 'Management\AssetsController@create');
                Route::post('/update', 'Management\AssetsController@update');
                Route::post('/delete', 'Management\AssetsController@delete');
                Route::post('/destroy', 'Management\AssetsController@destroy');
                Route::get('/report', 'Management\AssetsController@report');
                Route::post('/report_filter', 'Management\AssetsController@report_filter');
            });

            // User routes
            Route::group(['prefix' => 'user'], function () {
                Route::post('/update-profile', 'Auth\ProfileController@update_profile');
                Route::get('/index', 'Auth\ProfileController@index');
                Route::get('/user_roles', 'Auth\ProfileController@user_roles');
                Route::get('/get_users', 'Auth\ProfileController@get_users');
                Route::get('/admins', 'Auth\ProfileController@get_admins');
                Route::post('/create', 'Auth\ProfileController@create');
                Route::post('/delete', 'Auth\ProfileController@delete');
            });

            Route::group(['prefix' => 'question-bank'], function () {

                Route::get('/at-a-glance', 'QuestionBank\QuestionBankController@at_a_glance');

                Route::group(['prefix' => 'module'], function () {
                    Route::get('/', 'QuestionBank\ModuleController@all');
                    Route::get('/get-all', 'QuestionBank\ModuleController@get_all');
                });
            });
        });
    }
);
