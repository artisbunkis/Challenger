@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>Track Activity</title>         
    </head> 
<body>


<div class="container">
        <div class="row justify-content">
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-header "><h2 class="text-center">Track Activity</h2></div>
                    
                        <div class="card-body">
                            <div class="form-group">
                                <form method="POST" id="forma" action="{{ action([App\Http\Controllers\TrackActivityController::class, 'store']) }}"> @csrf
                                    
                                    <label for="startTime">Select Sports Type</label>
                                    <select class="form-control" name="sportsType" id="sportsType">
                                        <?php
                                        
                                            foreach($sportsType as $sport) { ?>
                                            <option value="<?= $sport->sportsTypeName ?>"><?= $sport->sportsTypeName ?></option>
                                        <?php
                                            } ?>
                                    </select> 
                                    <br>

                                    
                                    <label for="startTime" >Set Start Time</label>

                                

                                    <input class="form-control" type="datetime-local" name="startTime" id="startTime" require>
                                    <div class="alert-danger" style="font-weight: bold;"> @error('startTime') {{$message}} @enderror </div>
                                    <br>
                                    
                                    
                                    <button type="button" class="btn btn-secondary btn-lg btn-block" style="font-size: 14px;" onclick="add(); showSaveButton()">Add Units</button>
                                    

                                    
                                    <div class="container" id="unitsContainer" style="display:none; padding: 15px">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="justify-content-center">
                                                    <div id="uniti"> 
                                    
                                                    </div>
                                                    <br>
                
                                                    <input type="hidden" class="form-control" name="arrayOfUnits" id="arrayOfUnits">

                                                </div>
                                            </div>
                                        </div>
                                        
    
                                    </div>
                                    

                                    <button type="button" class="btn btn-success btn-lg btn-block" style="display: none; font-size: 14px;" id="saveButton" onclick="saveUnits()">Save Units</button>
                                    
                                    <input type="hidden" id="submitButton" class="btn btn-success btn-lg btn-block" style="font-size: 14px;" value="Submit">
                                    <br><br>

                                </form>
                    
                            </div>
                        </div>
                </div>   


                

            </div>

            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-header "><h2 class="text-center">Activities</h2></div>

                        <div class="card-body">
                           
                            @isset($allActivities)
                            @if($allActivities == NULL)
                                <p>You have no Activities</p>
                            @endif
                            @foreach ($allActivities as $activity)
                            <div class="card mb-3">
                                <div class="card-header text-white bg-secondary">
                                    
                                        @foreach ($sportsType as $sport)
                                            @if ($sport->sportsType_ID == $activity[0]->sportsType_ID)
                                                {{ $sport->sportsTypeName }}
                                            @endif
                                        @endforeach    
                                </div>
                                <div class="card-body bg-light">
                                
                                <div class="row">
                                    <div class="col md-3">
                                        <p><b>Start Time:</b> {{ $activity[0]->startTime }}</p>
                                    </div>
                                    <div class="col md-3">
                                        <form method="POST" id="forma" action="{{ action([App\Http\Controllers\TrackActivityController::class, 'destroy'], $activity[0]->activity_ID)}}"> @csrf @method('POST')
                                                        
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" value="{{ $activity[0]->activity_ID }}">
                                                            
                                            <button class="btn btn-block btn-danger btn-sm">Delete Activity</button>
                                        </form>
                                        
                                    </div>
                                </div>
                                

                                <div class="row">

                                    @foreach ($activity[1] as $a)
                                        <div class="col md-3">
                                            <div class="card mb-10">
                                                
                                                
                                                    @isset($units)
                                                        @foreach ($units as $unit)
                                                            
                                                            @if ($unit->unit_ID == $a->unit_ID)
                                                            <div class="card-body" style="font-size: 12px; padding: 5px">
                                                                <b>{{ $unit->unitName }}:</b>
                                                                {{ $a->value }} 
                                                                {{ $unit->unitCode }}
                                                            </div>
                                                                
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                    
                                            </div>
                                            
                                        </div>
                                        
                                    @endforeach
                                </div>
                                
                                    </div>
                                    
                            </div>
                                
                            

                            
                            @endforeach
                        @endisset
                           </div>
                            
                            
                                  
                              
                       

            </div>   

</div>

<style>

</style>

</body>

<script type='text/javascript'>
     
    function add() {
        unitsContainer = document.getElementById("unitsContainer");
        unitsContainer.style.display = "block";

        inputs = document.getElementById("uniti");
        var unit = document.createElement("SELECT");
        unit.setAttribute("placeholder", "Unit");
        unit.setAttribute("class", "form-control");
        unit.setAttribute("name", "unit");
        unit.setAttribute("id", "Unit1");
        
        


        var units = {!! json_encode($units->toArray()) !!};
        var length = units.length;
        var i = 0;
        
        arrayOfUnits = document.getElementById("arrayOfUnits");

        units.forEach(function (oneUnit) {
            var xx = oneUnit.unitName;
            option = document.createElement("option");
            option.text = xx;
            option.value = xx;
            unit.appendChild(option);
            arrayOfUnits[i] = xx;
            i+=1; 
        });
        
        var y = document.createElement("INPUT");
        y.setAttribute("type", "number");
        y.setAttribute("placeholder", "Goal value");
        y.setAttribute("id", "Measurement1");
        y.setAttribute("class", "form-control");
        y.required = true;
        

        inputs.appendChild(document.createElement("br"));
        label = document.createElement("label");
        label.innerHTML += 'Enter Measurement Values:';
        inputs.appendChild(label);
        inputs.appendChild(document.createElement("br"));
        inputs.appendChild(y);
        inputs.appendChild(document.createElement("br"));
        inputs.appendChild(unit);
        
        
    }

    function saveUnits() {
        $submitButton = document.getElementById("submitButton");
        $submitButton.type = "submit";
        //var data = document.getElementById("");
        //var selectedUnits = document.getElementById();
        var arrayOfUnits = [];
        //alert(arrayOfUnits[0]);

        var inputs = document.getElementById("forma").elements;
        for (i = 0; i < inputs.length; i++) {
            if(inputs[i].type === "number") {
                var measurement_ = inputs[i].value;
                var unit_ = inputs[i+1].value;
                console.log(measurement_);
                console.log(unit_);
                
                let object = {unit: unit_, measurement: measurement_};
                arrayOfUnits.push(object);
            }
            
            
        }
        console.log(arrayOfUnits);
        
        arrayOfUnitsElement = document.getElementById("arrayOfUnits");
        
        var arr = [{"name": "abc", "age": "123"}, {"name": "def", "age": "456"}];
        arrayOfUnitsElement.value = (JSON.stringify(arrayOfUnits));
        console.log(JSON.stringify(arrayOfUnits));    
        console.log(JSON.stringify(arr));   
    }

    function showSaveButton() {
        var data = document.getElementById("saveButton");
        if(data.style.display = "none") {
            data.style.display = "inline";
        }
        
    }
</script>
</html>
@endsection
