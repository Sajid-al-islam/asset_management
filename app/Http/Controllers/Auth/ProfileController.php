<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

use function PHPUnit\Framework\fileExists;

class ProfileController extends Controller
{
    // User apis
    public function index()
    {
        $user_role = UserRole::where('role_serial', 3)->first();
        $users = $user_role->users()->get();
        
        return response()->json([
            "users" => $users
        ]);
    }
    public function get_users(Request $request)
    {
        if($request->has('all')) {
            $users = User::where('status', 1)->with('roles')->get();
        }
        else {
            $users = User::where('status', 1)->with('roles')->paginate(8);
        }

        return response()->json(['users' => $users]);
    }

    public function get_admins()
    {
        $user_role = UserRole::where('role_serial', 2)->first();
        $admins = $user_role->users()->get()->toArray();
        return response()->json([
            "admins" => $admins
        ]);
    }

    public function user_roles()
    {
        $user_roles = UserRole::get();
        return response()->json([
            "user_roles" => $user_roles
        ]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'mobile_number' => ['required', 'unique:users'],
            'password' => ['required', 'min:8'],
            'designation' => ['required'],
        ]); 

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->designation = $request->designation;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->attach([$request->role_id]);
        $user->permissions()->attach([3]);


        return response()->json([
            "message" => "User Created successfully"
        ]);
    }
    
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $asset = User::find($request->id);
        $asset->status = 0;
        $asset->update();

        return response()->json([
            "message" => "User deleted successfully"
        ], 200); 
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'first_name' => ['required'],
            // 'last_name' => ['required'],
            // 'user_name' => ['required'],
            // 'mobile_number' => ['required'],
            'old_password' => ['required'],
            'newpassword' => ['required', 'min:8', 'confirmed'],
            'newpassword_confirmation' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $old_password = $request->old_password;
        $newpassword = $request->newpassword;
        $newpassword_confirmation = $request->newpassword_confirmation;
        // $user = User::find(json_decode($request->user)->id);
        $user = User::find(auth()->user()->id);

        // $user->first_name = $request->first_name;
        // $user->last_name = $request->last_name;
        // $user->mobile_number = $request->mobile_number;

        if (strlen($old_password)) {
            if (Hash::check($old_password, $user->password)) {
                if (strlen($newpassword) && strlen($newpassword_confirmation)) {
                    // $validator = Validator::make($request->all(), [
                    //     'old_password' => ['required'],
                    //     'newpassword' => ['required', 'min:8', 'confirmed'],
                    //     'newpassword_confirmation' => ['required']
                    // ]);

                    // if ($validator->fails()) {
                    //     return response()->json([
                    //         'err_message' => 'validation error',
                    //         'data' => $validator->errors(),
                    //     ], 422);
                    // }

                    $user->password = Hash::make($request->newpassword);
                }
            } else {
                return response()->json([
                    'err_message' => 'validation error',
                    'data' => [
                        'old_password' => ['your given old password not matching'],
                    ],
                    // return response()->json([
                    //     'err_message' => 'validation error',
                    //     'data' => $validator->errors(),
                    // ], 422);
                ], 422);
            }
        }

        // $user_name = $request->user_name;
        // if($user_name != $user->user_name){
        //     $validator = Validator::make($request->all(), [
        //         'user_name' => ['required','unique:users'],
        //     ],[
        //         'user_name' => ['your given user name already been taken'],
        //     ]);

        //     if ($validator->fails()) {
        //         return response()->json([
        //             'err_message' => 'validation error',
        //             'data' => $validator->errors(),
        //         ], 422);
        //     }else{
        //         $user->user_name = $request->user_name;
        //     }
        // }

        // if ($request->hasFile('photo')) {
        //     if(explode('/',$user->photo)[0]=='uploads' && fileExists(public_path($user->photo))){
        //         unlink(public_path($user->photo));
        //     }
        //     $file = $request->file('photo');
        //     $path = 'uploads/users/pp-' . $user->user_name . '-' . $user->id . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
        //     Image::make($file)->fit(400, 400)->save(public_path($path));
        //     $user->photo = $path;
        // }

        $user->save();
        return response()->json('success');
    }
}
