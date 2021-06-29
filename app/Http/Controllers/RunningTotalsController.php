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

        
        $subscription = Subscription::all()->where('user_ID', '=', Auth::id());
        $activities = Activity::all()->where('user_ID', '=', Auth::id());

        foreach($subscription as $sub) {
            $challenge = Challenge::all()->where('challenge_ID', '=', $sub->challenge_ID)->first();
            $challenge_measurements = Challenge_Measurements::all()->where('challenge_ID', '=', $challenge->challenge_ID);
            $measurementCount = 0;
            $doneMeasurements = 0;
                foreach($challenge_measurements as $challenge_measurement) {
                    
                    
                   
                    $measurementCount += 1;
                    $sumOfValues = 0;

                    foreach($activities as $activity) {
                        $activity_measurements = Activity_Measurements::all()->where('activity_ID', '=', $activity->activity_ID);
                        
                        foreach($activity_measurements as $activity_measurement) {
                            if($activity_measurement->unit_ID == $challenge_measurement->unit_ID && $activity->sportsType_ID == $challenge->sportsType_ID) {
                                
                                $sumOfValues += $activity_measurement->value;
                            }
                        }
                        
                    }
                    // echo($challenge->sportsType_ID);
                    // echo($challenge_measurement->challengeMeasurement_ID);
                    // echo(", ");
                    // echo($sumOfValues);
                    // echo(" | ");
                    if($sumOfValues >= $challenge_measurement->goalValue) {
                        $doneMeasurements += 1;
                        $sumOfValues = 0;
                        // echo("  ?  IS DONE  ?  ");
                        // echo($sub->subscription_ID);
                        // echo("  ?  IS DONE  ?  ");

                        // $values = Subscription::where('subscription_ID', $sub->subscription_ID)->update(['isDone'=>1]);
                        // $updateSubscription = Subscription::where('subscription_ID', '=', $sub->subscription_ID)->first();
                        //$updateSubscription->isDone = 1;
                        //$values->save();
                    }
                    
                }
                
                
                if($doneMeasurements == $measurementCount) {
                    $values = Subscription::where('subscription_ID', $sub->subscription_ID)->update(['isDone'=>1]);
                } else {
                    $values = Subscription::where('subscription_ID', $sub->subscription_ID)->update(['isDone'=>0]);
                }
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
