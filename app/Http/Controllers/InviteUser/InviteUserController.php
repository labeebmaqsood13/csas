<?php

namespace App\Http\Controllers\InviteUser;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response;

use Invite;
use App\User;
use App\Userinvitation;
use App\Project;
use Hash;
use Mail;
use Auth;

class InviteUserController extends Controller
{
	public $code;
    
    public function invite_user(Request $request){

        if($request->input('email')){
          
            if(Userinvitation::where('email',$request->input('email'))->exists() || User::where('email', $request->input('email'))->exists() ){
                return response()->json('0');
            }else if(!Userinvitation::where('email',$request->input('email'))->exists()){
                $user_id = Auth::user()->id;
                $code = md5(uniqid());
                $email = $request->input('email');
                $user_invited = Userinvitation::create([
                    'code'       => $code,
                    'email'      => $email,
                    'status'     => 'pending',
                    'valid_till' => date("Y-m-d H:i:s", strtotime('+1 hours')),
                    'user_id'    => $user_id,
                ]);

            }

            if($request->input('roles')){
                foreach($request->input('roles') as $role_id){   
                    $user_invited->role()->attach($role_id);
                }
            }

            if($request->input('project_id')){
                $user_invited->project()->attach($request->input('project_id'));
            }


            $data = ['code' => $code, 'email' => $email, 'name' => Auth::user()->name];
            Mail::send('emails.register', $data, function($message) use($data){
                $message->from('labeebmaqsood13@gmail.com');
                $message->to($data['email']);
                $message->subject('This is an invitation email');
            });

            return response()->json('1');
        
        }


        $user_id = Auth::user()->id;

        // $code = Hash::make(str_random(8));
        $code = md5(uniqid());

        $email = $request->email;

        $user_invited = Userinvitation::create([
            'code'       => $code,
            'email'      => $email,
            'status'     => 'pending',
            'valid_till' => date("Y-m-d H:i:s", strtotime('+1 hours')),
            'user_id'    => $user_id,
            ]);

        if(!is_null($request->roles)){
            foreach($request->roles as $role_id){   
                $user_invited->role()->attach($role_id);
            }
        }    

        $data = ['code' => $code, 'email' => $email , 'name' => Auth::user()->name];
        Mail::send('emails.register', $data, function($message) use($data){
            $message->from('labeebmaqsood13@gmail.com');
            $message->to($data['email']);
            $message->subject('This is an invitation email');
        });

        return \Redirect::route('dashboard')->with('message', $email.' has been invited.');

    }

    public function check_status($code){

        $code = htmlspecialchars($code);
        $user = Userinvitation::where('code', $code)->first();
        if($user->status == "pending"){

            if(date('Y-m-d H:i:s') <= $user->valid_till){

                $user_email = $user->email;
                $this->code = $code;
                return view('register', ['user_email' => $user_email]);

            }else{

                return 'Sorry the time of the token has been expired';

            }



        }elseif($user->status == "successful"){

            return 'Invite token already used';

        }

    }

    public function register_user(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            ]);

        $user_invited = Userinvitation::where('email',$request->email)->first();

        $role_ids = $user_invited->role()->get();

        foreach($role_ids as $role_id){
            $user->role()->attach($role_id->pivot->role_id);
        }

        if($user_invited->project()->exists()){
            $project = $user_invited->project()->first();
            $user->project()->attach($project->id);
        }


        $user_invited->update(['status' => 'successful']); 
        return \Redirect::route('users')->with('success', 'New User has been registered successfully');


    }


    
}
