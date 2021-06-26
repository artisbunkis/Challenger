@extends('layouts.app')
@section('content')

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" type="text/javascript">
</script>
<script src="path/to/chartjs/dist/Chart.js"></script>

<?php
    $summa = 0;
    $avgCount = 1;
    $card = 0;
?>


<!DOCTYPE html>   
<html> 
    
 

    <head>    
        <title>Find Challenge</title>
            
    </head> 
<body>


    <div class="container">
        <h1>Running Totals</h1>
        @php
            $cntOfFinished = 0;
        @endphp
        @isset($finishedSubscribedChallenges)
            @foreach ($finishedSubscribedChallenges as $fsc)
                @php
                    $cntOfFinished += 1;
                @endphp
            @endforeach
            <p>Finished Challenges: {{ $cntOfFinished }}</p>
        @endisset
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    <div class="container">
        <div class="row" data-masonry='{"percentPosition": true }'>
            
            @isset($challenges)
                @foreach($challenges as $chal)
                
                    

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header text-center ">
                                <h2>{{$chal->challengeName}}</h2>
                                @isset($sportsType)
                                    @foreach ($sportsType as $sport)
                                        @if ($sport->sportsType_ID == $chal->sportsType_ID)
                                            <h6>{{ $sport->sportsTypeName }}</h6>
                                        @endif
                                    @endforeach                                
                                @endisset
                            </div>

                            <div class="card-body text-md-left">
                                <div class="card-body-{{$card}}">
                                    
                                        {{-- GOAL VALUES --}}
                                        @isset($runningValues)
                                            @foreach ($runningValues as $item)
                                                @foreach ($item as $it)
                                                    
                                                        @if ($it->challenge_ID == $chal->challenge_ID)
                                                        <div class="card mb-2" style="padding: 10px">
                                                            <div class="card-body-{{$card}}-2">
                                                                <div class="justify-content-center">
                                                                    <p><b>Goal value:</b> {{ $it->goalValue }}
                                                                        @isset($units)
                                                                            @foreach ($units as $unit)
                                                                                @if ($unit->unit_ID == $it->unit_ID) 
                                                                                    {{ $unit->unitCode }}
                                                                                        <i>({{ $unit->unitName }})</i>
                                                                                    

                                                                                        
                                                                                    {{-- RUNNING TOTALS --}}
                                                                                    <p><b>My Running total:</b>
                                                                                    @isset($myActivities)
                                                                                        @foreach ($myActivities as $activity)
                                                                                            @if ($activity->startTime > $chal->beginDate and $activity->startTime < $chal->endDate)
                                                                                                @isset($runningMeasurements)
                                                                                                    @foreach ($runningMeasurements as $rm)
                                                                                                    
                                                                                                        @foreach ($rm as $r)
                                                                                                            
                                                                                                            @if ($r->unit_ID == $unit->unit_ID)
                                                                                                                @if ($r->activity_ID == $activity->activity_ID and $activity->sportsType_ID == $chal->sportsType_ID)
                                                                                                                    
                                                                                                                    <?php
                                                                                                                        
                                                                                                                        if (strpos($unit->unitName, 'verage') !== false) {
                                                                                                                            $summa = ($summa += $r->value)/$avgCount;
                                                                                                                            $avgCount += 1;
                                                                                                                        } else {
                                                                                                                            $summa += $r->value;
                                                                                                                        }

                                                                                                                        
                                                                                                                    ?> 
                                                                                                                    

                                                                                                                @endif
                                                                                                            @endif
                                                                                                            
                                                                                                        @endforeach
                                                                                                    
                                                                                                    @endforeach
                                                                                                @endisset  
                                                                                            @endif
                                                                                            
                                                                                                
                                                                                            
                                                                                            
                                                                                        @endforeach                                                        
                                                                                    @endisset
                                                                                    
                                                                                   
                                                                                    {{ $summa }} {{ $unit->unitCode }} <i>({{ $unit->unitName }})</i>

                                                                                    @if ($summa/($it->goalValue/100) >= 100)
                                                                                            <div id="myProgress" style=" width: 100%; height: 10px; background-color: #ddd; border-radius: 25px">
                                                                                                <div id="myBar" style="width: 100%;
                                                                                                

                                                                                                height: 30px;
                                                                                                background-color: #04AA6D;
                                                                                                text-align: center;
                                                                                                line-height: 30px;
                                                                                                color: white ; border-radius: 25px; height: 10px; ">
                                                                                                    <p style="font-size: 12px;"></p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <p style="font-size: 11px; padding-top: 5px; font-weight: bold">Completed</p>
                                                                                        @else
                                                                                            <div id="myProgress" style=" width: 100%; height: 10px; background-color: #ddd ; border-radius: 25px ">
                                                                                                <div id="myBar" style="width: {{ 
                                                                                                    
                                                                                                $summa/($it->goalValue/100)
                                                                                                
                                                                                                }}%;
                                                                                                

                                                                                                height: 30px;
                                                                                                background-color: #C91919;
                                                                                                text-align: center;
                                                                                                line-height: 30px;
                                                                                                color: white ; border-radius: 25px; height: 10px; ">
                                                                                                    <p style="font-size: 10px; padding: 115px;"></p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <p style="font-size: 11px; padding-top: 5px; font-weight: bold">{{ round($summa/($it->goalValue/100), 1) }}%</p>

                                                                                            
                                                                                        @endif  
                                                                                    
                                                                                    
                                                                                </p>
                                                                                @php
                                                                                    $avgCount = 1;
                                                                                    $summa = 0;
                                                                                @endphp 
                                                                                @endif
                                                                                
                                                                            @endforeach
                                                                        @endisset
                                                                        
                                                                    </p>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                        @endif
                                                    
                                                @endforeach
                                                
                                            @endforeach
                                        @endisset

                                        @php
                                            $irFinished = false;
                                        @endphp  
                                        @isset($finishedSubscribedChallenges)
                                            @foreach ($finishedSubscribedChallenges as $fsc)
                                                @if ($chal->challenge_ID == $fsc->challenge_ID)
                                                    @php
                                                        $irFinished = true;
                                                    @endphp  
                                             
                                                @endif
                                            @endforeach
                                            @if ($irFinished)
                                            <button type="button" class="btn btn-success btn-lg btn-block" type="submit" style="font-size: 14px;">Completed</button>
                                            @else
                                                <form method="POST" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'unsubscribe'], $chal->challenge_ID)}}"> @csrf @method('POST')
                                                        
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{ $chal->challenge_ID }}">
                                                    
                                                
                                                    <button type="button" class="btn btn-secondary btn-lg btn-block" style="font-size: 14px;">Unsubscribe</button>
                                                </form>
                                            @endif
                                        @endisset

                                        
                                    
                                </div>
                            </div>
                            
                        </div>   
                    
                    </div>

                    <?php $card += 1 ?>   
                    
                @endforeach
            @endisset
        </div>
    </div>
    

</body>





</html>

@endsection