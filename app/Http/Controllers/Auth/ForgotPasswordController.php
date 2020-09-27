<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Modules\Sms\Core\Facade\Sms;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendSms(Request $request)
    {
        $to = $request->to;

        $message = $request->message;
        Sms::to($to)->content($message)->send();
    }

    public function changePassword(Request $request)
    {

        $filtered_phone_number = filter_var($request->phone, FILTER_SANITIZE_NUMBER_INT);
        $phone_to_check = str_replace("-", "", $filtered_phone_number);

        $urow = User::where('phone', $phone_to_check)->get()->first();
        $new_password = str_random(8);
        $urow->password = Hash::make($new_password);
        $urow->save();
        Mail::to($urow)->send(new \Modules\Email\Emails\TestEmail( $new_password ));

    }

}
