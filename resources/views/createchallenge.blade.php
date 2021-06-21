@extends('layouts.app')
@section('content')

<!DOCTYPE html>    
<html>  
    <head>    
        <title>Home</title>         
    </head> 
<body>
        

         <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header text-center"><h2>Track Activity</h2></div>
                            <div class="form text-center">
                                <form method="POST" id="forma" action="{{ action([App\Http\Controllers\CreateChallengeController::class, 'store']) }}"> @csrf
                                    {{--
                                    <input type="hidden" name="sportsType_ID" value="{{ $challenge->sportsType_ID }}"> // te vajag fk sataisit pareizi 
                                    --}} 
                                    <label for="challengeName">Challenge Name: </label>
                                    <input type="text" name="challengeName" id="challengeName"><br>
                    
                                    <select name="sportsType" id="sportsType">
                                        <option selected="selected">Sports Type</option>
                                        <?php
                                            foreach($sportsType as $sport) { ?>
                                            <option value="<?= $sport->sportsTypeName ?>"><?= $sport->sportsTypeName ?></option>
                                        <?php
                                            } ?>
                                    </select> 

                                    <label for="beginDate">Begin Date:</label>
                                    <input type="date" name="beginDate" id="beginDate">
                    
                                    <label for="endDate">End Date:</label>
                                    <input type="date" name="endDate" id="endDate"><br>
                    
                                    <label for="isPublic">Public: </label>
                                    <input type="checkbox" checked name="isPublic" id="isPublic"><br>
                                    
                                    <button type="button" onclick="add(); showSaveButton()">Add Units</button>
                                    <br>
                                    
                                    <div id="uniti">

                                    </div>
                                    <br>

                                    <input type="hidden" name="arrayOfUnits" id="arrayOfUnits">

                                    <button type="button" style="display: none" id="saveButton" onclick="saveUnits()">Save Units</button>

                                    <button type="submit">Submit</button>
                                    </form>
                       
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
                var measurement_ = inputs[i].value
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
