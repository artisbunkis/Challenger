<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\Models\User;
use App\Notifications\ChallengeComplete;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index()
    {
        return view('welcome');
    }
    
    public function sendNotification($challengeID) {
        
        $data = User::all()->where('user_ID', '=', Auth::id())->first();

        // $challengeData = [
        //     'challenge_ID' => 1,
        //     'name' => 'bla bla bla',
        //     'body' => 'test text',
        // ];
        
        $challenge = Challenge::all()->where('challenge_ID', '=', $challengeID)->first();

        //echo($challengeData['body']);
        Notification::send($data, new ChallengeComplete($challenge));
        //Notification::send($data, new ChallengeComplete($challengeData));

        // echo($challengeData['body']);
        return redirect('findchallenges');
    }
}
