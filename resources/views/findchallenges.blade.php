@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>Find Challenge</title>         
    </head> 
<body>


{{--
@isset($challenges)
@foreach($challenges as $challenge)
    <p>{{$challenge}}</p>
    
@endforeach
@endisset
--}}

<div class="container">
    <div class="row justify-content-center">
        
        @isset($challenges)
        @foreach($challenges as $challenge)
        <div class="col-md-4">
            <div class="card border-info mb-3">
                <div class="card-header text-center "><h2>{{$challenge->challengeName}}</h2></div>
                    <div class="card-body text-md-left">
                        @isset($sportsTypes)
                        @foreach($sportsTypes as $sportsType)
                        @if($sportsType->sportsType_ID == $challenge->sportsType_ID)                                
                            <p>Sports Type: {{$sportsType->sportsTypeName}}</p>   
                        @endif
                        @endforeach
                        @endisset

                        <p>Subscriber Count: </p>

                        @isset($measurements)
                        @foreach($measurements as $measurement)
                        @if($challenge->challenge_ID == $measurement->challenge_ID)
                            <p>Goal: {{$measurement->goalValue}}</p>
                        @endif
                        @endforeach
                        @endisset

                        
                        <p>Ends in: {{$challenge->endDate}}</p>

                        @isset($user_ids)
                        @foreach($user_ids as $user_id)
                        @if($user_id->user_ID == $challenge->creatorUser_ID)
                            <p>Creator: {{$user_id->username}}</p>
                        @endif
                        @endforeach
                        @endisset
                        
                    </div>

            </div>   
        </div>
        @endforeach
        @endisset
    </div>
</div>


</body>
</html>
@endsection