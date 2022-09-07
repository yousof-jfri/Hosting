<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\EditProfileRequest;
use App\Http\Requests\V1\EditVIPProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Video;

class ProfileController extends Controller
{
    // edit normal users profile
    public function editProfile(EditProfileRequest $request, User $user)
    {
        // check if the image is changed
        $image = $user->image;
        if($request->image)
        {
            if($user->image != 'assets/images/users/default.png')
            {
                if(File::exists(public_path($user->image)))
                {
                    File::delete(File::delete(public_path($user->image)));
                }
            }
            $relativePath = $this->saveImage($request->image);
            $image = $relativePath;
        }

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'image' => $image,
        ]);

        $videos = Video::limit(4)->inRandomOrder()->get();

        return ['user' => $user, 'userVideos' => $user->videos, 'randomVideos' => $videos];
    }

    // edit vip users profile
    public function editVIPProfile(EditVIPProfileRequest $request, User $user)
    {
        // check if the image is changed
        $image = $user->image;
        if($request->image)
        {
            if($user->image != 'assets/images/users/default.png')
            {
                if(File::exists(public_path($user->image)))
                {
                    File::delete(File::delete(public_path($user->image)));
                }
            }
            $relativePath = $this->saveImage($request->image);
            $image = $relativePath;
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'national_code' => $request->national_code,
            'email' => $request->email,
            'company' => $request->company,
            'image' => $image,
            'company_registration_number' => $request->company_registration_number,
            'company_type' => $request->company_type,
            'state' => $request->state,
            'city' => $request->city,
            'company_exact_address' => $request->company_exact_address,
            'postal_code' => $request->postal_code,
            'card_number' => $request->card_number,
        ]);

        $videos = Video::limit(4)->inRandomOrder()->get();

        return ['user' => $user, 'userVideos' => $user->videos, 'randomVideos' => $videos];
    }

    public function editPhone(Request $request, User $user)
    {
        $request->validate([
            'newPhone' => 'required',
        ]);

        $user->phone = $request->newPhone;
        $user->update();

        $videos = Video::limit(4)->inRandomOrder()->get();

        return ['user' => $user, 'userVideos' => $user->videos, 'randomVideos' => $videos];
    }

    public function editPassword(Request $request, User $user)
    {
        $data = $request->validate([
            'newPassword' => 'required',
            'currentPassword' => 'required',
        ]);

        if(Hash::check($data['currentPassword'], $user->password))
        {
            $user->password = Hash::make($data['newPassword']);
            $user->update();
            $videos = Video::limit(4)->inRandomOrder()->get();

            return ['user' => $user, 'userVideos' => $user->videos, 'randomVideos' => $videos];
        }

        return response([
            'errors' => [
                'currentPassword' => [
                    'این رمز ورود اشتباه میباشد'
                ]
            ],
        ], 422);
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
