@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>Find Challenge</title>   
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/mystyle.css') }} ">     
    </head> 

<body>



<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<div class="container">

    

    <div id="myBtnContainer" class="d-flex justify-content-between">
        
        <div >
            <button class="btn  btn-secondary btn-sm butn" onclick="filterSelection('all')">All</button>   
        </div>
        
        @isset($sportsTypes)
            @foreach($sportsTypes as $sportsType)
            <div>
                <button class="btn  btn-secondary btn-sm butn" onclick="filterSelection('{{$sportsType->sportsTypeName}}')">{{$sportsType->sportsTypeName}}</button>  
            </div>
                
            @endforeach
        @endisset
    </div>
    <br>

    <div class="container">
        <div class="row" >
            @isset($challenges)
            @foreach($challenges as $challenge)
                @isset($sportsTypes)
                    @foreach($sportsTypes as $sportsType)
                        @if($sportsType->sportsType_ID == $challenge->sportsType_ID)  
                                                    
                        <div class="col-md-4 filterDiv {{$sportsType->sportsTypeName}}">
                            
    
                                
                            
                            <div class="card mb-3 filterDiv {{$sportsType->sportsTypeName}}">
                            <div class="card-header text-center "><h2>{{$challenge->challengeName}}</h2></div>
                                <div class="card-body text-md-left">
                                    @isset($sportsTypes)
                                    @foreach($sportsTypes as $sportsType)
                                    @if($sportsType->sportsType_ID == $challenge->sportsType_ID)                                
                                        <div  id="sportsBox">
                                            <p><b>Sports Type:</b> {{$sportsType->sportsTypeName}}</p>   
                                        </div>
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
                                    <p><b>Goals:</b></p>
                                    @foreach($measurements as $measurement)
                                    @if($challenge->challenge_ID == $measurement->challenge_ID)
                                    
                                    <div class="card mb-2" style="">
                                        <div class="card-body" style="padding: 5px;">
                                            <div class="justify-content-center">
                                                
                                                @foreach ($units as $unit)
                                                        @if($unit->unit_ID == $measurement->unit_ID)
                                                            @foreach ($comparisons as $comparison)
                                                                @if ($measurement->comparison_ID == $comparison->comparison_ID)
                                                                <div class="row">
                                                                    <div class="col" style="background-color:">
                                                                        <h6>{{ $unit->unitName }} </h6> 
                                                                       
                                                                    </div>
                                                                    <div class="col" style="background-color:; text-align: right">
                                                                        @if ($comparison->comparison_ID == 3)
                                                                            <h1><span style="font-size: 20px">{{ $comparison->comparisonSign }}</span>{{$measurement->goalValue}}<span style="font-size: 12px">{{ $unit->unitCode }}</span></h1>
                                                                        @else
                                                                            <h1>{{$measurement->goalValue}}<span style="font-size: 12px"> {{ $unit->unitCode }}</span></h1>
                                                                        @endif
                                                                        
                                                                    </div>
                                                                  </div>
                                                                 
                                                                @endif
                                                            @endforeach
                                                            
                                                        @endif
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                    </div>
                                        
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
                                                
                                            
                                                 <button class="btn btn-block btn-danger btn-lg" style="font-size: 14px;" type="submit">Unsubscribe</button>
                                            </form>
                                            @else
                                            <form method="POST" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'subscribe'], $challenge->challenge_ID)}}"> @csrf @method('POST')
                                                            
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" value="{{ $challenge->challenge_ID }}">
                                                
                                            
                                                 <button class="btn btn-block btn-success btn-lg" style="font-size: 14px;" type="submit">Subscribe</button>
                                            </form>
                                            @endif
                                        @endisset
                                    @endisset
                                    
                                </div>
                            </div>
                        </div>
        
                        
                        @endif
                    @endforeach
                 @endisset
            @endforeach
            @endisset
        </div>
    </div>

    
<script>
    filterSelection("all")
    function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("filterDiv");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
    }
    }

    function w3AddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
    }
    }

    function w3RemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
        arr1.splice(arr1.indexOf(arr2[i]), 1);     
        }
    }
    element.className = arr1.join(" ");
    }

    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function(){
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
    }

</script>

    <div class="row" data-masonry='{"percentPosition": true }'>
        {{--
        @isset($challenges)
        @foreach($challenges as $challenge)
        <div class="col-md-4 @isset($sportsTypes)@foreach($sportsTypes as $sportsType)@if($sportsType->sportsType_ID==$challenge->sportsType_ID){{$sportsType->sportsType_ID}}@endif @endforeach @endisset">
            <div class="">
                
                    <div class="card mb-3">
                        <div class="card-header text-center "><h2>{{$challenge->challengeName}}</h2></div>
                            <div class="card-body text-md-left">
                                @isset($sportsTypes)
                                @foreach($sportsTypes as $sportsType)
                                @if($sportsType->sportsType_ID == $challenge->sportsType_ID)                                
                                    <div  id="sportsBox">
                                        <p><b>Sports Type:</b> {{$sportsType->sportsTypeName}}</p>   
                                    </div>
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
                                
                            </div>
                        
                    </div>   
                </div>
            </div>
        @endforeach
        @endisset
    </div>
   --}}
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
                                        <form method="POST" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'erase'], $challenge->challenge_ID)}}"> @csrf @method('DELETE')
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
</div>

@endcan


</body>

</html>
@endsection