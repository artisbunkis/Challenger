<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Activity_Measurements;
use App\Models\Challenge;
use App\Models\Challenge_Measurements;
use App\Models\SportsType;
use App\Models\Subscription;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RunningTotalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribedChallengesID = Subscription::all()->where('user_ID', '=', Auth::id());
        $finishedSubscribedChallenges = Subscription::all()->where('user_ID', '=', Auth::id())->where('isDone', '=', 1);
        //echo(Auth::id());
        $runningValues = [];
        $challenge = NULL;
        $challenges = [];

        foreach($subscribedChallengesID as $s) {
            $challenge = Challenge::all()->where('challenge_ID', '=', $s->challenge_ID)->first();
            array_push($challenges, $challenge);
            //array_push($challenges, $s->isDone);
            $values = Challenge_Measurements::all()->where('challenge_ID', '=', $challenge->challenge_ID);
            
            array_push($runningValues, $values);
        }

        
        $sportsType = SportsType::all();
        $units = Unit::all();
   
        
        

        $myActivities = Activity::all()->where('user_ID', '=', Auth::id());

        $runningMeasurements = [];

        foreach($myActivities as $activity) {
            $measurements = Activity_Measurements::all()->where('activity_ID', '=', $activity->activity_ID);
            
            array_push($runningMeasurements, $measurements);
        }

        


        return view('runningtotals', compact('challenges', 'sportsType', 'runningValues', 'units', 'myActivities', 'runningMeasurements', 'finishedSubscribedChallenges' ));
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
    public function destroy($id)
    {
        //
    }
}
