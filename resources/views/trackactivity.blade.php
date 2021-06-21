@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>Track Activity</title>         
    </head> 
<body>
<br><br>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-info mb-3">
                    <div class="card-header text-center"><h2>Track Activity</h2></div>
                    
                        <div class="card-body">
                            <div class="form text-center">
                                <form method="POST" id="forma" action="{{ action([App\Http\Controllers\TrackActivityController::class, 'store']) }}"> @csrf
                                    <br>
                                    <select name="sportsType" id="sportsType">
                                        <option selected="selected">Sports Type</option>
                                        <?php
                                            foreach($sportsType as $sport) { ?>
                                            <option value="<?= $sport->sportsTypeName ?>"><?= $sport->sportsTypeName ?></option>
                                        <?php
                                            } ?>
                                    </select> 

                                    <br><br><br>
                                    <label for="startTime">Start Time</label>
                                    <input type="datetime-local" name="startTime" id="startTime" require>
                                    <br><br><br>
                                    <label for="Duration">Duration(seconds):</label>
                                    <input type="number" name="Duration" id="Duration"><br>
                                    <br><br>
                                    <button type="button" class="btn btn-dark" onclick="add(); showSaveButton()">Add Units</button>
                                    <br><br>

                                    <div id="uniti"> 
                                    
                                    </div>
                                    <br>

                                    <input type="hidden" name="arrayOfUnits" id="arrayOfUnits">
                                    

                                    <button type="button" class="btn btn-dark" style="display: none" id="saveButton" onclick="saveUnits()">Save Units</button>
                                    
                                    <input type="submit" class="btn btn-dark" value="Submit">
                                    <br><br>

                                </form>
                    
                            </div>
                        </div>
                </div>   
            </div>
        </div>
</div>
    
</body>

<script type='text/javascript'>
     
    function add() {
        inputs = document.getElementById("uniti");
        var unit = document.createElement("SELECT");
        unit.setAttribute("placeholder", "Unit");
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


        inputs.appendChild(document.createElement("br"));
        inputs.appendChild(y);
        inputs.appendChild(unit);
        inputs.appendChild(document.createElement("br"));
        
    }

    function saveUnits() {
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
