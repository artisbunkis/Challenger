@extends('layouts.app')
@section('content')

<?php
    $summa = 0;
    $avgCount = 1;
    $card = 0;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-info mb-3">
                <div class="card-header text-center"><h2>Running Totals</h2></div>
                
                    <div class="card-body">
                        <div class="form text-center">
                            {{-- Visi Running totals cards --}}
                            
                            @isset($challenges)
                                @foreach ($challenges as $chal)
                                

                                <div class="card-body-{{$card}}" style="background-color: rgb(189, 189, 189)">
                                    <h6>{{ $chal->challengeName }}</h6>

                                    @isset($sportsType)
                                        @foreach ($sportsType as $sport)
                                            @if ($sport->sportsType_ID == $chal->sportsType_ID)
                                                <h5>{{ $sport->sportsTypeName }}</h5>
                                            @endif
                                        @endforeach                                
                                    @endisset

                                    {{-- GOAL VALUES --}}
                                    @isset($runningValues)
                                        @foreach ($runningValues as $item)
                                            @foreach ($item as $it)
                                                @if ($it->challenge_ID == $chal->challenge_ID)
                                                    <p>Goal value: {{ $it->goalValue }}
                                                        @isset($units)
                                                            @foreach ($units as $unit)
                                                                @if ($unit->unit_ID == $it->unit_ID) 
                                                                    {{ $unit->unitCode }}
                                                                     ({{ $unit->unitName }})
                                                                   

                                                                     
                                                                    {{-- RUNNING TOTALS --}}
                                                                    <p>My Running total:
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
                                                                    {{ $summa }} {{ $unit->unitCode }} ({{ $unit->unitName }})
                                                                    
                                                                </p>
                                                                <?php
                                                                    $avgCount = 1;
                                                                    $summa = 0;
                                                                ?> 
                                                                ____
                                                                @endif
                                                            @endforeach
                                                        @endisset
                                                        
                                                    </p>

                                                    

                                                @endif

                                            @endforeach
                                            
                                        @endforeach
                                    @endisset

                                    

                                </div>
                                <br>
                                <?php $card += 1 ?>   
                                @endforeach
                            @endisset
                            

                            

                            
                        </div>
                    </div>
            </div>   
        </div>
    </div>
</div>


@endsection