<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfile;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Add profile.
     *
     * @param CreateProfile
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProfile $request)
    {
        $profile = new Profile;

        $profile->fill([
            'name' => $request->input('name')
        ]);

        $profile->save();

        return $profile;
    }

    public static function get($id)
    {
        return Profile::where('id',$id)->first();
    }

    public static function getByName($name)
    {
        return Profile::where('name', 'like', '%' . $name .'%')->first();
    }
}
