<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Unit;
use App\Models\SportsType;
use App\Models\Challenge;


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
    
        $sportsType = SportsType::all();
        return view('trackactivity', compact('units', 'sportsType'));
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

            // DB::table('challenge_measurements')->insert([
            //     'challenge_ID' => $challenge->id,
            //     'unit_ID' => $unitID,
            //     'goalValue' => json_decode($arr)[$i]->measurement,
            //     'comparison_ID' => 1
            // ]);
                DB::table('activity_measurements')->insert([
               'activity_ID' => $activity->id,
               'unit_ID' => $unitID,
               'value' => json_decode($arr)[$i]->measurement
            ]);
            $units = Unit::all();
    
            $sportsType = SportsType::all();
            return view('trackactivity', compact('units', 'sportsType'));
            
        };


       

       
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
