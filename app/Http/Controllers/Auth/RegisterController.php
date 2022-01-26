<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Rules\halfWidth;
use Exception;
use Weidner\Goutte\GoutteFacade as GoutteFacade;
use Log;
use PhpParser\Node\Stmt\TryCatch;

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
    protected $redirectTo = RouteServiceProvider::WORKSPACE;

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
        return Validator::make(
            $data['data'],
            [
                'nickname' => ['required', 'max:30', 'unique:users,nickname'],
                'password' => ['required', new halfWidth, 'between:8,30', 'regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!#$%])/']
            ],
            [
                'password.regex' => '下記の条件を全て満たしてください'
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $nickname = htmlspecialchars($data['data']['nickname']);
        $password = htmlspecialchars($data['data']['password']);
        return User::create([
            'nickname' => $nickname,
            'password' => Hash::make($password)
        ]);
    }

    public function registUser(Request $request)
    {
        $req = $request->all();
        $validated = $this->validator($req);

        if ($validated->fails()) {
            return new JsonResponse($validated->errors());
        }

        event(new Registered($user = $this->create($req)));

        return 1;
    }

    public function registURL(Request $request, Site $site)
    {
        $data = $request->all();
        $url = $data['data']['url'];
        $uid = $data['data']['uid'];

        try {
            $goutte = GoutteFacade::request('GET', $url);
        } catch (Exception $e) {
            $message = $e->getMessage();
            Log::info($message);
            throw new Exception();
        }

        $path = storage_path('app/source');
        $host = parse_url($url, PHP_URL_HOST);

        $bool = $site->where('user_id', $uid)->where('url', $url)->exists();
        if ($bool === true) {
            return 0;
        }

        $obj = $site->create(['user_id' => $uid, 'host' => $host, 'url' => $url]);

        $create = app()->make('App\Http\Controllers\CreateController');
        $create->execute($goutte, $obj, $path);
        return;
    }
}
