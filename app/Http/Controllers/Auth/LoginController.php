<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Mail ;
use Auth ;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

     public function login(Request $request){
         $this->validate($request, [
             'id_number' => 'required|string',
             'password' => 'required|string',
             'type_login' => 'required|string'
         ]);


         if($request->type_login == 'ldap'){
             try {
                 $ldapCon = ldap_connect(env('LDAP_HOST'), env('LDAP_PORT'));
                 $ldapBind = ldap_bind($ldapCon, $request->id_number.'@gmf-aeroasia.co.id', $request->password );
             } catch (\Exception $e) {
                 return redirect()->back()->withErrors(['error' => 'Your Personal Number and Password Not match with account LDAP ']);
             }

             ldap_close($ldapCon);

             if($ldapBind) {
                 $cek = \App\User::where('id_number', $request->id_number)->count() ;
                 if($cek == 0){
                     $http = new Client;
                     $response = $http->request('GET', 'http://172.16.40.238/codeigniter-restserver/employee?nopeg='.$request->id_number.'&token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImVtYWlsIjoia2lraWsuZGV2QGdtYWlsLmNvbSJ9fQ.bFBBep7EDAwjIioDWsQHt2_mHFnUPy3ea6ocRVxNcm4');
                     $result =  json_encode(json_decode($response->getBody()));
                     $data = json_decode($result, true);
                     if(empty($data['employee'][0][0])){
                         return redirect()->back()->withErrors(['error' => 'Your user not detected in LDAP ACCOUNT']);
                     }else{
                         $input['name'] =  $data['employee'][0][0]['nama'];
                         $input['id_number'] =  $data['employee'][0][0]['nopeg'];
                         $input['position_name'] =  $data['employee'][0][0]['jabatan'];
                         $input['unit_code'] =  $data['employee'][0][0]['unit'];
                         $input['email'] =  $data['employee'][0][0]['email'];
                         $input['role'] = 0;
                         $input['password'] = Hash::make($request->id_number);

                         $save = \App\User::create($input) ;
                         if($save){
                             foreach ( \App\User::where('role', 1)->get() as $res) {
                                 Mail::send('emails.RegisteNotification', compact('res'), function($message) use ($res)
                                 {
                                     $message->from(env('MAIL_USERNAME'), env('MAIL_HOST'));
                                     $message->to([$res->email], $res->name)
                                     ->subject('New User Waiting to Approve role');
                                 });
                             }
                         }
                         return redirect()->back()->with('message', 'Register Success! Wait till activated status from admin, dont forget to check your email');$input['id_number'] = '';
                     }
                 }else{
                     $user = \App\User::where('id_number', $request->id_number)->first();
                     Auth::login($user, $request->remember,  true);
                     $link = redirect()->intended()->getTargetUrl() ;
                     if($link != redirect(url(''))->getTargetUrl()){
                         return redirect($link);
                     }else{
                         return redirect(url('app')) ;
                     }
                 }
             }else{
                 return redirect()->back()->withErrors(['failed' => 'Your ID Number and Password Not match']);
             }
         }else{
             $cek = \App\User::where('id_number', $request->id_number)->where('role','<>', 0)->count() ;
             if($cek !=0 ){
                 if (auth()->attempt(['id_number' => $request->id_number, 'password' => $request->password], true)) {
                    $link = redirect()->intended()->getTargetUrl() ;
                    if($link == url('/gmf_theme/css/login/bootstrap.min.css.map') ){
                      return redirect(url('app')) ;
                    }else{
                      return redirect($link);
                    }
                 }else{
                     return redirect()->back()->withErrors(['error' => 'Username and Password not match']);
                 }
             }else{
                 return redirect()->back()->withErrors(['error' => 'Username and Password not match']);
             }
         }
     }

    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
