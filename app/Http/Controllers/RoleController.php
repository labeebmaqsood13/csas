<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;

use App\User;
use App\Role;
use App\Userinvitation;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        $users = User::all();
        return view('roles', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $role = Role::create([
            'name' => $request->name,
            ]);

        if(!is_null($request->users)){
            foreach($request->users as $user){
                $user = User::find($user);
                $user->role()->attach($role->id);
            }
        }    
        return \Redirect::route('roles.index')->with('success', 'Success! Role Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

    // if($role->user()->get()){
        //Destroy role_user associations
        foreach($role->user()->get() as $role){
            // echo $role->pivot->role_id;
            // $user_id = $role->pivot->user_id;
            // $user = User::find($user_id);
            // $user->role()->detach($role->pivot->role_id);
            $user = User::find($role->pivot->user_id);
            $user->role()->detach($role->pivot->role_id);
        }

        $this->destroy_role_userinvitation($id);
        $this->destroy_role($id);
        return \Redirect::route('roles.index');
        // return \Redirect::route('roles.index')->with('success', 'Success! Role Deleted');
    

    }    

    public function destroy_role_userinvitation($id){

        $role = Role::find($id);
        foreach($role->user_invitation()->get() as $role){
            // echo $role->pivot->role_id;
            // $user_id = $role->pivot->userinvitation_id;
            // $user = User::find($user_id);
            // $user->role()->detach($role->pivot->role_id);
            $user_invited = Userinvitation::find($role->pivot->userinvitation_id);
            $user_invited->role()->detach($role->pivot->role_id);
        }

    } 

    public function destroy_role($id){

        $role = Role::find($id);
        $role->delete();

    }    



    
}
