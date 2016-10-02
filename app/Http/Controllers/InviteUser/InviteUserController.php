<?php

namespace App\Http\Controllers\InviteUser;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response;

use Invite;
use App\User;

use Junaidnasir\Larainvite\Models\LaraInviteModel;
use Mail;

class InviteUserController extends Controller
{
	public $code;
    
    public function invite_user(Request $request){

        if(is_null(User::where('name','Labeeb')->first())){
            User::create([
                'name' => 'Labeeb',
                'email' => 'labeebmaqsood@yahoo.com',
                'password' => 'something',
                ]);
        }

        $user = User::where('name', 'Labeeb')->first();

        $invite_email = $request->email;
        $refCode = Invite::invite($invite_email, $user->id , date("Y-m-d H:i:s", strtotime('+1 hours')));

        $data = ['code' => $refCode, 'email' => $invite_email , 'name' => $user->name];
        Mail::send('emails.register', $data, function($message) use($data){
            $message->from('labeebmaqsood13@gmail.com');
            $message->to($data['email']);
            $message->subject('This is an invitation email');
        });
        // return $refCode;
        return \Redirect::route('dashboard')->with('message', $invite_email.' has been invited.');

    }

    public function check_status($code){

        $user = LaraInviteModel::where('code', $code)->first();
        if($user->status == "pending"){

            if(date('Y-m-d H:i:s') <= $user->valid_till){

                // User::create($user->email);
                $user_email = $user->email;
                $this->code = $code;
                // LaraInviteModel::where('code', $code)->update(['status' => 'successful']); 
                return view('register', ['user_email' => $user_email]);

                // return 'Success'; 

            }else{

                return 'Sorry the time of the token has been expired';

            }



        }elseif($user->status == "successful"){

            return 'Invite token already used';

        }
        // return $user;

    }

    public function register_user(Request $request){

        // LaraInviteModel::where('code', $code)->update(['status' => 'successful']);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            ]);

        LaraInviteModel::where('code', $this->code)->update(['status' => 'successful']); 
        return \Redirect::route('dashboard')->with('message', 'New User has been registered successfully');


    }


    
}
