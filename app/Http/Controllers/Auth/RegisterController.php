<?php

namespace App\Http\Controllers\Auth;

use App\Pengguna;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
    protected $redirectTo = '/dasbor';

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if(!sistem('pendaftaran_pengajar') && !sistem('pendaftaran_santri'))
          return redirect('/')->with('error', 'Mohon maaf, pendaftaran belum dibuka atau sudah ditutup.');
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
      if(!sistem('pendaftaran_pengajar') && !sistem('pendaftaran_santri'))
        return redirect('/')->with('error', 'Mohon maaf, pendaftaran belum dibuka atau sudah ditutup.');

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|max:255|unique:pengguna',
            'username' => 'required|min:4|max:16|regex:/[a-z_0-9]{4,16}/|unique:pengguna',
            'password' => 'required|min:6|confirmed',
            'jenis_kelamin' => 'required|boolean',
            'mahasiswa_ipb' => 'required|integer|between:0,2',
            'nomor_identitas' => 'required|min:7|max:255|unique:pengguna',
            'nomor_hp' => 'required|min:8|max:13|regex:/08[0-9]{6,11}/|unique:pengguna',
            'nomor_wa' => 'nullable|min:8|max:13|regex:/08[0-9]{6,11}/',
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
        $pengguna = Pengguna::create([
            'nama_lengkap' => ucwords(strtolower($data['nama_lengkap'])),
            'email' => strtolower($data['email']),
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'jenis_kelamin' => $data['jenis_kelamin'],
            'mahasiswa_ipb' => $data['mahasiswa_ipb'],
            'nomor_identitas' => $data['nomor_identitas'],
            'nomor_hp' => $data['nomor_hp'],
            'nomor_wa' => $data['nomor_wa']
        ]);
        $memberRole = Role::where('name', 'member')->first();
        $pengguna->attachRole($memberRole);
        return $pengguna;
    }
}
