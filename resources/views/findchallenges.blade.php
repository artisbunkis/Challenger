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
                        
                        <form method="POST" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'subscribe'], $challenge->challenge_ID)}}"> @csrf @method('POST')
                                    
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $challenge->challenge_ID }}">
                            
                        
                        <button type="submit">Subscribe</button>
                    </form>
                        
                    </div>

            </div>   
        </div>
        @endforeach
        @endisset
    </div>
</div>

@can('is-admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-info mb-3">
                <div class="card-header text-center "><h2>List of all challenges</h2></div>
                    <div class="card-body text-md-left">
                        <table>
                            <tr>
                                <th>Challenge Title</th>
                                <th>Delete</th>
                                
                            </tr>
                        @isset($challenges)
                        @foreach($challenges as $challenge)
                            <tr>
                                <td>{{$challenge->challengeName}}</td>
                                                
                               
                                <td>
                                    {{--
                                        <form method="POST" action="{{ action('FindChallengesController@destroy')}}"> @csrf @method('POST')
                                        <form action="{{ action('FindChallengesController@destroy', $challenge->challenge_ID) }}" method="POST"> @csrf
                                            --}}
                                        <form method="DELETE" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'erase'], $challenge->challenge_ID)}}"> @csrf @method('DELETE')
                                    
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $challenge->challenge_ID }}">
                                            
                                        
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                
                            </tr>
                            
                        @endforeach
                        @endisset
                        </table>
                    </div>

            </div>   
        </div>

    </div>
</div>

@endcan


</body>
</html>
@endsection