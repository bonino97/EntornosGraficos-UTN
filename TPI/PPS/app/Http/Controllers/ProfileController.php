<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfile;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Add profile.
     *
     * @param CreateProfile
     * @return Profile
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

    /**
     * Return profile by id
     *
     * @param id
     * @return Profile
     */
    public static function get($id)
    {
        if (Auth::check()) {
            return Profile::where('id',$id)->first();    
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Return profile by name
     *
     * @param name
     * @return Profile
     */
    public static function getByName($name)
    {
        return Profile::where('name', 'like', '%' . $name .'%')->first();
    }
}
