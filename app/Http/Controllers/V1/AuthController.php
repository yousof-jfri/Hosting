<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'min:8'
            ],
        ]);

        // save user into the data base
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        // create token
        $token = $user->createToken('main')->plainTextToken;

        $user = User::find($user->id);

        // return response
        return response([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'last_name' => $user->last_name,
                'image' => $user->image,
                'email' => $user->email,
            ],
            'token' => $token
        ]);
    }

    public function registerVIP(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'birthday' => 'required',
            'national_code' => 'required',
            'company' => 'required',
            'image' => 'nullable',
            'company_registration_number' => 'required',
            'company_type' =>  'required',
            'state' => 'required',
            'city' => 'required',
            'company_exact_address' => 'required',
            'postal_code' => 'required',
            'card_number' => 'required',
            'username' => 'required',
            'password' => [
                'required',
                'min:8'
            ],
        ]);

        if($data['image'])
        {
            $relativePath = $this->saveImage($request->image);
            $data['image'] = $relativePath;
        }else {
            $data['image'] = 'assets/images/users/default.png';
        }
        
        
        // save user into the data base
        // dd([
        //     'name' => $data['name'],
        //     'last_name' => $data['last_name'],
        //     'birthday' => $data['national_code'],
        //     'national_code' => $data['national_code'],
        //     'email' => $data['email'],
        //     'company' => $data['company'],
        //     'image' => $data['image'],
        //     'company_registration_number' => $data['company_registration_number'],
        //     'company_type' =>  $data['company_type'],
        //     'state' => $data['state'],
        //     'city' => $data['city'],
        //     'company_exact_address' => $data['company_exact_address'],
        //     'postal_code' => $data['postal_code'],
        //     'card_number' => $data['card_number'],
        //     'username' => $data['username'],
        //     'password' => Hash::make($data['password']),
        // ]);
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'birthday' => $data['national_code'],
            'national_code' => $data['national_code'],
            'email' => $data['email'],
            'company' => $data['company'],
            'image' => $data['image'],
            'company_registration_number' => $data['company_registration_number'],
            'company_type' =>  json_encode($data['company_type']),
            'state' => $data['state'],
            'city' => $data['city'],
            'company_exact_address' => $data['company_exact_address'],
            'postal_code' => $data['postal_code'],
            'card_number' => $data['card_number'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'is_vip' => true,
        ]);

        // create token
        $token = $user->createToken('main')->plainTextToken;

        $user = User::find($user->id);

        // return response
        return response([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'last_name' => $user->last_name,
                'image' => $user->image,
                'email' => $user->email,
            ],
            'token' => $token
        ]);
    }



    // login user
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:8'],
            'remember' => 'boolean',
        ]);

        $remember = $request->remember;

        unset($credentials['remember']);

        if(Auth::attempt($credentials, $remember))
        {
            $user = Auth::user();
            Auth::loginUsingId($user->id);
            $token = $user->createToken('main')->plainTextToken;

            return response([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'image' => $user->image,
                    'email' => $user->email,
                ],
                'token' => $token
            ]);
        }

        return response([
            'message' => 'اطلاعات وارده اشتباه میباشد',
        ], 423);
    }

    // save image
    private function saveImage($image)
    {
        if(preg_match('/^data:image\/(\w+);base64,/', $image, $type)){
            $image = substr($image, strpos($image, ',') + 1);

            $type = strtolower($type[1]);

            if(!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])){
                throw new \Exception('invalid image type');
            }

            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if($image == false){
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception("didn' match data URL with image data");
        }

        $dir = 'assets/images/users/profile/';
        $file = Str::random() . '.' .$type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if(!File::exists($absolutePath)){
            File::makeDirectory($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}
