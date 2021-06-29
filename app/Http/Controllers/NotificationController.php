<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use App\Models\User;
use App\Notifications\ChallengeComplete;

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
    
    public function sendNotification() {
        
        $data = User::first();
        echo($data);
        $challengeData = [
            'name' => 'bla bla bla',
            'body' => 'test text',
        ];
        
        //echo($challengeData['body']);
        Notification::sendNow($data, new ChallengeComplete($challengeData), ['mail', 'database']);
        //Notification::send($data, new ChallengeComplete($challengeData));
        echo($challengeData['body']);
        dd(' notification has been sent!');
    }
}
