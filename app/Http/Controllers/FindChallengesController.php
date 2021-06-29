<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use DB;


class FindChallengesController extends Controller
{

    public function __construct() {
        // only Admins have access to the following methods
        $this->middleware('auth');
        $this->middleware('auth.admin')->only(['destroy', 'erase']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // JA NESTRADA TAD ATKOMENTET SITO
        // $challenges = DB::select('select * from challenge');
        // return view('findchallenges',['challenges'=>$challenges]);
        
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
    public function erase(Request $request)
    {   
        $subscriptions = Subscription::all()->where('challenge_ID', '=', $request->id);
        foreach($subscriptions as $s) {
            $s->delete();
        }
        $challenge = Challenge::where('challenge_ID', '=', $request->id)->delete();        
        return redirect('findchallenges');
    }

    public function subscribe(Request $request) {
        $subscription = new Subscription();
        $subscription->challenge_ID = $request->id;
        $subscription->user_ID = Auth::id();
        $subscription->isDone = false;
        $subscription->subscriptionDate = date("Y-m-d");
        $subscription->save();
        return redirect('findchallenges')->with('success', 'Challenge Subscribed');
    }

    public function unsubscribe(Request $request) {

        $subscription = Subscription::where('challenge_ID', '=', $request->id)->delete();
        return redirect('findchallenges')->with('success', 'Challenge Removed');

    }


}
