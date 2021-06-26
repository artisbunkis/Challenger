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
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<div class="container">
    <div class="row" data-masonry='{"percentPosition": true }'>
        
        @isset($challenges)
        @foreach($challenges as $challenge)
        
            

            <div class="col-md-4">
                <div class="card border-info mb-3">
                    <div class="card-header text-center "><h2>{{$challenge->challengeName}}</h2></div>
                        <div class="card-body text-md-left">
                            @isset($sportsTypes)
                            @foreach($sportsTypes as $sportsType)
                            @if($sportsType->sportsType_ID == $challenge->sportsType_ID)                                
                                <p><b>Sports Type:</b> {{$sportsType->sportsTypeName}}</p>   
                            @endif
                            @endforeach
                            @endisset

                            <p><b>Subscriber Count: </b>
                                @isset($subscribedCountArray)
                                    @foreach ($subscribedCountArray as $s)
                                        @if($s[0] == $challenge->challenge_ID)
                                            {{$s[1]}}
                                        @endif
                                    @endforeach
                                @endisset
                            </p>

                            @isset($measurements)
                            @foreach($measurements as $measurement)
                            @if($challenge->challenge_ID == $measurement->challenge_ID)
                                <p><b>Goal:</b> 
                                    @foreach ($units as $unit)
                                        @if($unit->unit_ID == $measurement->unit_ID)
                                            @foreach ($comparisons as $comparison)
                                                @if ($measurement->comparison_ID == $comparison->comparison_ID)
                                                    {{ $unit->unitName }} {{ $comparison->comparisonSign }} {{$measurement->goalValue}} {{ $unit->unitCode }}
                                                @endif
                                            @endforeach
                                            
                                        @endif
                                    @endforeach
                                    </p>
                            @endif
                            @endforeach
                            @endisset

                            
                            <p><b>Ends in:</b> {{$challenge->endDate}}</p>

                            @isset($user_ids)
                            @foreach($user_ids as $user_id)
                            @if($user_id->user_ID == $challenge->creatorUser_ID)
                                <p><b>Creator:</b> {{$user_id->username}}</p>
                            @endif
                            @endforeach
                            @endisset
                            
                            <?php $irSaraksta = false ?>
                            
                            @isset($subscrChal)
                                @foreach ($subscrChal as $sc)
                                    @if($sc->challenge_ID == $challenge->challenge_ID)
                                        @php $irSaraksta = true @endphp
                                        @break
                                    @endif
                                
                                @endforeach
                                @isset($irSaraksta)
                                    @if ($irSaraksta)
                                    <form method="POST" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'unsubscribe'], $challenge->challenge_ID)}}"> @csrf @method('POST')
                                                    
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $challenge->challenge_ID }}">
                                        
                                    
                                         <button type="submit">Unsubscribe</button>
                                    </form>
                                    @else
                                    <form method="POST" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'subscribe'], $challenge->challenge_ID)}}"> @csrf @method('POST')
                                                    
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $challenge->challenge_ID }}">
                                        
                                    
                                         <button type="submit">Subscribe</button>
                                    </form>
                                    @endif
                                @endisset
                            @endisset

                            {{--
                                <form method="POST" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'subscribe'], $challenge->challenge_ID)}}"> @csrf @method('POST')
                                                    
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $challenge->challenge_ID }}">
                                        
                                    
                                         <button type="submit">Subscribe</button>
                                    </form>
                                --}}
                            
                        
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