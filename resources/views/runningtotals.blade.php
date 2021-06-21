@extends('layouts.app')
@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-info mb-3">
                <div class="card-header text-center"><h2>Running Totals</h2></div>
                
                    <div class="card-body">
                        <div class="form text-center">
                            {{-- Visi Running totals cards --}}
                            
                            @isset($challenge)
                                @foreach ($challenge as $chal)

                                <div class="card-body" style="background-color: rgb(189, 189, 189)">
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
                                                                    
                                                                @endif
                                                            @endforeach
                                                        @endisset
                                                        
                                                    </p>
                                                @endif

                                            @endforeach
                                            
                                        @endforeach
                                    @endisset

                                    {{-- RUNNING TOTALS --}}

                                </div>
                                <br>
                                    
                                @endforeach
                            @endisset
                            

                            

                            
                        </div>
                    </div>
            </div>   
        </div>
    </div>
</div>


@endsection