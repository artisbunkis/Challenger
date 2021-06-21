<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\SportsType;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateChallengeController extends Controller
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
        return view('createchallenge', compact('units', 'sportsType'));
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
        
        $challenge = new Challenge();
        $challengeID = $challenge->id;
        $challenge->creatorUser_ID = Auth::id();;
        $challenge->sportsType_ID = $sportsType;
        $challenge->challengeName = $challengeName;
        $challenge->beginDate = $beginDate;
        $challenge->endDate = $endDate;
        $challenge->isPublic = $isPublic;

        $challenge->isPublic = ($isPublic=='on')? 1 : 0;

        $challenge->save();
        

        $arr = ($request->arrayOfUnits);
        for($i = 0; $i< count(json_decode($arr)); $i+=1) {
            //echo (json_decode($arr)[$i]->unit);
            //echo (json_decode($arr)[$i]->measurement);

            $unitID = Unit::where('unitName', '=', json_decode($arr)[$i]->unit)->value('unit_ID');

            DB::table('challenge_measurements')->insert([
                'challenge_ID' => $challenge->id,
                'unit_ID' => $unitID,
                'goalValue' => json_decode($arr)[$i]->measurement,
                'comparison_ID' => 1
            ]);
        }


        
        return view('findchallenges');
        
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
