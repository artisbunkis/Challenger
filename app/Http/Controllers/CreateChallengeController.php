<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Subscription;
use App\Models\Comparison;
use App\Models\SportsType;
use Illuminate\Http\Request;
use App\Models\Challenge_Measurements;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CreateChallengeController extends Controller
{

    public function __construct() {
        // only Admins have access to the following methods
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        $sportsType = SportsType::all();
        $comparisons = Comparison::all();
        $challenges = Challenge::all()->where('creatorUser_ID', '=', Auth::id());
        $measurements = Challenge_Measurements::all();
        $subscriptions = Subscription::all()->where('user_ID', '=', Auth::id());
        // foreach($comparisons as $c) {
        //     echo($c);
        // }
        return view('createchallenge', compact('units', 'sportsType', 'comparisons', 'measurements', 'challenges', 'subscriptions'));
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

        $challengeName = $request->challengeName;
        $beginDate = $request->beginDate;
        $endDate = $request->endDate;
        $isPublic = $request->isPublic;
        
       // $dateverification = array(
       //     'start_date'=>'2000-01-01',
       //     'end_date'=>'date("Y-m-d")'
//
     //   );

        $challengevalidation = request()->validate([
            'challengeName'=>'required|max:100',
            'beginDate'=>'required|after_or_equal:today',
            'endDate'=>'required|after_or_equal:today'
        ]);
        $challenge = new Challenge();
        $challengeID = $challenge->id;
        $challenge->creatorUser_ID = Auth::id();
        $challenge->sportsType_ID = $sportsType;
        $challenge->challengeName = $challengeName;
        $challenge->beginDate = $beginDate;
        $challenge->endDate = $endDate;
        $challenge->isPublic = $isPublic;
        $challenge->isPublic = $isPublic;

        $challenge->isPublic = ($isPublic=='on')? 1 : 0;

        $challenge->save();
        

        $arr = ($request->arrayOfUnits);
        for($i = 0; $i< count(json_decode($arr)); $i+=1) {
            //echo (json_decode($arr)[$i]->unit);
            //echo (json_decode($arr)[$i]->measurement);

            $unitID = Unit::where('unitName', '=', json_decode($arr)[$i]->unit)->value('unit_ID');
            $comparisonID = Comparison::where('comparisonSign', '=', json_decode($arr)[$i]->comparison)->value('comparison_ID');

            DB::table('challenge_measurements')->insert([
                'challenge_ID' => $challenge->id,
                'unit_ID' => $unitID,
                'goalValue' => json_decode($arr)[$i]->measurement,
                'comparison_ID' => $comparisonID
            ]);
        }

        return redirect()->action([NotificationController::class, 'sendNotification'], [$challenge]);
        
        
        return redirect('findchallenges');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = Auth::id();
        if(is_null($id)){ 
            return redirect('login');
        }

        $subscribedChallengesID = Subscription::all()->where('user_ID', '=', Auth::id());

        $subscrChal = [];
        
        $subscribedCountArray = [];
        $subscriberCount = [];

        foreach($subscribedChallengesID as $s) {
            $challenge = Challenge::all()->where('challenge_ID', '=', $s->challenge_ID)->first();

            array_push($subscrChal, $challenge);

        }


        $sportsTypes = SportsType::all();
        $challenges = Challenge::all()->where('isPublic');
        $measurements = Challenge_Measurements::all();
        $units = Unit::all();
        $user_ids = User::all();
        $comparisons = Comparison::all();

        foreach($challenges as $c) {
            $subscriberCount = [];
            $subscriptionCnt = Subscription::all()->where('challenge_ID', '=', $c->challenge_ID)->count();
            array_push($subscriberCount, $c->challenge_ID);
            array_push($subscriberCount, $subscriptionCnt);
            array_push($subscribedCountArray, $subscriberCount);
        }

        


        return view('findchallenges', compact('challenges', 'sportsTypes', 'measurements', 'user_ids', 'subscrChal', 'subscribedCountArray', 'units', 'comparisons'));
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
        //echo($request->id);
        $subscriptions = Subscription::where('challenge_ID', '=', $request->id)->delete();
        // foreach($subscriptions as $s) {
        //     $s->delete();
        // }
        $challenge = Challenge::where('challenge_ID', '=', $request->id)->delete();        
        return redirect('createchallenge');
    }

    public function showMyChallenges(Request $request) {

    }

}
