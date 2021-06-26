<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Activity_Measurements;
use App\Models\Unit;
use App\Models\SportsType;
use App\Models\Challenge;
use App\Models\Challenge_Measurements;
use App\Models\Comparison;
use App\Models\Subscription;

class TrackActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        $allActivities = [];
        $activityMeasurements = [];
        $activID = [];

        $activities = Activity::all()->where('user_ID', '=', Auth::id());//->join('activity_measurements','activities.activity_ID','=','activity_measurements.activity_ID')->get();
        //$activity_measurements = Activity_Measurements::all()->where('user_ID', '=', Auth::id());
        // foreach($activities as $activity) {
        //     echo($activity->activity_ID);
        // }
        // foreach($activities as $activity) {
        //     $activID = [];
        //     $activity_measurements = Activity_Measurements::all()->where('activity_ID', '=', $activity->activity_ID);
        //     foreach($activity_measurements as $activMeas) {
        //         array_push($activityMeasurements, $activMeas);
        //         //echo($activMeas);
        //     }
        //     array_push($activID, $activity);
        //     array_push($activID, $activityMeasurements);
        //     array_push($allActivities, $activID);
        //     // echo($allActivities[0][0]);
        // }
        foreach($activities as $activity) {
            $activID = [];
            array_push($activID, $activity);
            $activityMeasurements = [];
            $activity_measurements = Activity_Measurements::all()->where('activity_ID', '=', $activity->activity_ID);
            foreach($activity_measurements as $actMeas) {
                if($actMeas->activity_ID == $activity->activity_ID) {
                    array_push($activityMeasurements, $actMeas);
                }
            }
            array_push($activID, $activityMeasurements);
            array_push($allActivities, $activID);
        }
        

        //echo($allActivities[1][0]);
        // // echo($allActivities[1][0]);
        // // echo($allActivities[0][1][1]);
        // // echo($allActivities[0][1][0]);
        // // echo($allActivities[0][1][3]);

        
        
        

        $sportsType = SportsType::all();
        return view('trackactivity', compact('units', 'sportsType', 'allActivities'));
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
        $sportsType = SportsType::where('sportsTypeName', '=', $request->sportsType)->value('sportsType_ID');

        $id = Auth::id(); 
        if(is_null($id)){
            return redirect('login');
        }
        $activity = new Activity();
        $activity->activity_ID = $request->id; 
        $activity->startTime = $request->startTime; 
        $activity->sportsType_ID = $sportsType;
        $activity->User_ID = $id; 
        $activity->save();

        
        $arr = ($request->arrayOfUnits);
        
        for($i = 0; $i < count(json_decode($arr)); $i+=1) {
            //echo (json_decode($arr)[$i]->unit);
            //echo (json_decode($arr)[$i]->measurement);

            $unitID = Unit::where('unitName', '=', json_decode($arr)[$i]->unit)->value('unit_ID');

                DB::table('activity_measurements')->insert([
               'activity_ID' => $activity->id,
               'unit_ID' => $unitID,
               'value' => json_decode($arr)[$i]->measurement
            ]);
            $units = Unit::all();
            $sportsType = SportsType::all();
            
            
        };

        $comparisons = Comparison::all();
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

        return redirect()->action([TrackActivityController::class, 'index']);

       

       
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
    public function destroy(Request $request)
    {
        $activity = Activity::where('activity_ID', '=', $request->id)->delete();
        $activity_measurements = Activity_Measurements::where('activity_ID', '=', $request->id)->delete();
        // foreach($activity_measurements as $actMeas) {
        //     $actMeas->delete();
        // }

        // Nonem subscriptionam isDone ja vairs nav sasniegts
        $comparisons = Comparison::all();
        $subscription = Subscription::all()->where('user_ID', '=', Auth::id());
        $activities = Activity::all()->where('user_ID', '=', Auth::id());

        foreach($subscription as $sub) {
            $challenge = Challenge::all()->where('challenge_ID', '=', $sub->challenge_ID)->first();
            $challenge_measurements = Challenge_Measurements::all()->where('challenge_ID', '=', $challenge->challenge_ID);
            $measurementCount = 0;
            $doneMeasurements = 0;
                foreach($challenge_measurements as $challenge_measurement) {
                    
                    if($sub->subscription_ID == 7) echo("A");
                   
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

        return redirect()->action([TrackActivityController::class, 'index']);
    }
}
