<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Relationship;
use App\Post;
use Session;
use Auth;

class UsersController extends Controller
{
    public function getRegister(){
    	return view('users.register');
    }

    public function postRegister(Request $request){
    	
    	$this->validate($request,[
    		'username' => 'required|unique:users|max:100',
    		'email' => 'required|unique:users|max:100',
            'password' => 'required|min:6|max:100',
    		'confirmPassword' => 'required|min:6|max:100|same:password',
    		'firstname' => 'required|max:100',
    		'lastname' => 'required|max:100'
    	]);

        //create new user
    	User::create($request->all());
    	Session::flash('message','Successfully Registered !!!');

        return view('users.register');
    }


    public function postLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->intended('home');
        }

        Session::flash('err_message','Invalid Login');
        return redirect('/');
    }


    public function getLogout(){
        Auth::logout();
        return redirect('/');
    }


    public function searchUsers(Request $request){
        $search = "%".$request->search."%";
        $users = User::orWhere('firstname', 'LIKE' , $search)
                        ->orWhere('lastname', 'LIKE', $search)
                        ->orWhere('username', 'LIKE', $search)
                        ->get();

        $relationships = Relationship::all();
        $counter = 0;

        return view('users.search',compact('users','relationships','counter'));
    }

    public function updateRel(Request $request){
        $user1 = $request->user1;
        $user2 = $request->user2;
        $action = Auth::user()->id;
        $status = $request->status;

        if($status == 1){
            $status = 2;
        }else if($status == 2){
            $status = 3;
        }else if($status == 3){
            $status = 1;
        }else if($status == 0){
            $status = 1;
            $relationship = new Relationship;
            $relationship->user1 = $user1;
            $relationship->user2 = $user2;
            $relationship->action_user_id = $action;
            $relationship->status_id = $status;
            $relationship->save();

            return;
        }

        Relationship::where('user1',$user1)
                    ->where('user2',$user2)
                    ->update(['action_user_id' => $action, 'status_id' => $status]);
    }


    public function friendRequest(){
        $user = Auth::user()->id;
        $friendRequests = Relationship::whereNested(function($query){
                                $user = Auth::user()->id;
                                $query->where('user1','=', $user);
                                $query->orWhere('user2','=', $user);
                            })
                            ->where('action_user_id','!=',$user)
                            ->where('status_id','=',1)
                            ->get();
        return view('users.friendrequest', compact('friendRequests'));
    }

    public function getMessages(){
        
        return view('users.messages');
    }

    public function getProfile($id){
        $user = User::find($id);
        /*$posts = Post::whereUserId($id)->get();*/
        return view('users.profile',compact('user'));
    }

    public function getEditProfile(){
        $user = User::find(Auth::user()->id);
        return view('users.edit',compact('user'));
    }

    public function updateProfile(Request $request){
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'newPassword' => 'required|min:6|max:20',
            'confirmPassword' => 'required|min:6|max:20|same:newPassword',
        ]);

        //update user profile
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $confirmPassword = bcrypt($request->confirmPassword);

        $user = User::whereId(Auth::user()->id)
                    ->update(['firstname' => $firstname, 'lastname' => $lastname, 'password' => $confirmPassword]);

        //upload image
        $userId = Auth::user()->id;
        $file = $request->file('profile_pic');
        $name = $userId.'.jpg';
        $destinationPath = 'uploads/images/profile_pic';
        $file->move($destinationPath,$name);

        Session::flash('updateSuccess','User Profile Updated Successfully !!!');
        return redirect()->back();
    }

}
