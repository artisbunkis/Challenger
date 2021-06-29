<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct() {
        // only Admins have access to the following methods
        $this->middleware('auth');
        $this->middleware('auth.admin')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $thisuser = User::all()->where('user_ID', '=', Auth::id())->first();
        $gender = Gender::all()->where('gender_ID', '=', $thisuser->gender_ID)->first();
        return view('/profile', compact('users', 'thisuser', 'gender'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users = User::all();
        $thisuser = User::all()->where('user_ID', '=', Auth::id())->first();
        $gender = Gender::all()->where('gender_ID', '=', $thisuser->gender_ID)->first();
        
        return view('/profile', compact('users', 'thisuser', 'gender'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        
        $thisuser = User::all()->where('user_ID', '=', Auth::id())->first();

        if($request->username == $thisuser->username && $request->email == $thisuser->email) {
            $uservalidation = request()->validate([
                //'username'=>'required|unique:users,',
                'firstname'=>'nullable|regex:/^[a-zA-Z]+$/|max:30',
                'lastname'=>'nullable|string|regex:/^[a-zA-Z]+$/|max:30',
                //'username'=>'unique:users',
                //'email'=>'unique:users',
                'birthday'=>'nullable|before_or_equal:today',
                'photo' => 'mimes:jpeg,png,bmp,tiff |max:4096'
    
            ]);
        } else {
            
            if($request->username == $thisuser->username || $request->email == $thisuser->email) {
                if($request->username == $thisuser->username) {
                    $uservalidation = request()->validate([
                        //'username'=>'required|unique:users,',
                        'firstname'=>'nullable|regex:/^[a-zA-Z]+$/|max:30',
                        'lastname'=>'nullable|string|regex:/^[a-zA-Z]+$/|max:30',
                        // 'username'=>'unique:users',
                        'email'=>'unique:users|max:70',
                        'birthday'=>'nullable|before_or_equal:today',
                        'photo' => 'mimes:jpeg,png,bmp,tiff |max:4096'
            
                    ]);
                }
                if($request->email == $thisuser->email) {
                    $uservalidation = request()->validate([
                        //'username'=>'required|unique:users,',
                        'firstname'=>'nullable|regex:/^[a-zA-Z]+$/|max:30',
                        'lastname'=>'nullable|string|regex:/^[a-zA-Z]+$/|max:30',
                        'username'=>'required|unique:users|max:30',
                        //'email'=>'unique:users'
                        'birthday'=>'nullable|before_or_equal:today',
                        'photo' => 'mimes:jpeg,png,bmp,tiff |max:4096'
            
                    ]);
                } 
            } else {
                $uservalidation = request()->validate([
                    //'username'=>'required|unique:users,',
                    'firstname'=>'nullable|regex:/^[a-zA-Z]+$/|max:30',
                    'lastname'=>'nullable|string|regex:/^[a-zA-Z]+$/|max:30',
                    'username'=>'required|unique:users|max:30',
                    'email'=>'unique:users|max:70',
                    'birthday'=>'nullable|before_or_equal:today',
                    'photo' => 'mimes:jpeg,png,bmp,tiff |max:4096'
        
                ]);
            }
            
        }
        
        //if ($uservalidation->fails()) {
        //   echo ('textfailed');
       // }return;
        $user = User::all()->where('user_ID', '=', Auth::id())->first();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->birthdate = $request->birthday;
        $user->gender_ID = $request->gender;
        

        // Profile photo
        if ($request->hasFile('photo')) {
        
            $file = $request->file('photo');
            // $name = Auth::id();
            // $filepath = 'uploads/images/';

            $filename = Auth::id();
            $directory  = 'uploadimages/photos/';
            $file->move($directory, $filename);
            //echo($file);
            $user->hasProfilePicture = true;
        }

        $user->save();

        return redirect('profile');
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
        User::find($id)->delete();
        return redirect('profile');
        // City::where('country_id', $id)->delete();
        // Country::findOrFail($id)->delete();
        // return redirect('country/');
    }
}
