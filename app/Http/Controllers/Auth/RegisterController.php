<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'addr1' => 'required|max:255',
            'addr2' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'country' => 'required|max:255',
            'phone1' => 'required|numeric|digits_between:0,20',
            'email' => 'required|email|max:255',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // if (!is_null($data['photo'])) {
        //     $destinationPath = 'uploads';
        //     $extension = Input::file('photo')->getClientOriginalExtension(); 
        //     $fileName = time().'_photo.'.$extension; 
        //     Input::file('photo')->move($destinationPath, $fileName); 
        //     $data['photo'] = $destinationPath.'/'.$fileName;
        // } else {
        //     $data['photo'] = "";
        // }
        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'addr1' => $data['addr1'],
            'addr2' => $data['addr2'],
            'addr3' => $data['addr3'] or null,
            'addr4' => $data['addr4'] or null,
            'city' => $data['city'],
            'state' => $data['state'] or 'Maharashtra',
            'country' => $data['country'] or 'India',
            'phone1' => $data['phone1'],
            'phone2' => $data['phone2'] or null,
            'email' => $data['email'],
            'photo' => null,
            'notes' => $data['notes'] or null,
            ]);
    }
}
