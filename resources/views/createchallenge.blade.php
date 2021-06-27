@extends('layouts.app')
@section('content')

<!DOCTYPE html>    
<html>  
    <head>    
        <title>Create Challenge</title>         
    </head> 
<body>
        
    <div class="container">
        <div class="row justify-content">
                <div class="col-md-6">


                    



                    <div class="card mb-3">
                        <div class="card-header text-center"><h2>Create Challenge</h2></div>
                            <div class="card-body">
                                <div class="form-group">
                                    <form method="POST" id="forma" class="form-group" action="{{ action([App\Http\Controllers\CreateChallengeController::class, 'store']) }}"> @csrf
                                        {{--
                                        <input type="hidden" name="sportsType_ID" value="{{ $challenge->sportsType_ID }}"> // te vajag fk sataisit pareizi 
                                        --}} 
                                        <label for="challengeName">Challenge Name: </label>
                                        <input class="form-control" type="text" name="challengeName" id="challengeName">
                        
                                        

                                        <div class="row" style="padding-top: 10px">
                                            <div class="col mb-7">
                                                <select class="form-control" name="sportsType" id="sportsType">
                                                    <option selected="selected">Sports Type</option>
                                                    <?php
                                                        foreach($sportsType as $sport) { ?>
                                                        <option value="<?= $sport->sportsTypeName ?>"><?= $sport->sportsTypeName ?></option>
                                                    <?php
                                                        } ?>
                                                </select>                               
                                            </div>
                                            <div class="col mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" checked name="isPublic" id="isPublic">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Public:
                                                    </label>
                                                  </div>
                                              
                                            </div>
                                           
                                        </div>

                                        <div class="row" style="padding-top: 10px">
                                            <div class="col mb-5">
                                                <label for="beginDate">Begin Date:</label>
                                                <input class="form-control" type="date" name="beginDate" id="beginDate">
                                
                                               
                                
                                            </div>
                                            <div class="col mb-5">
                                                <label for="endDate">End Date:</label>
                                                <input class="form-control" type="date" name="endDate" id="endDate">
                                            </div>
                                           
                                        </div>
    
                                        
                                        
                                        <button type="button" class="btn btn-secondary btn-lg btn-block" style="font-size: 14px;" onclick="add(); showSaveButton()">Add Units</button>
                                        
                                        
                                        <div class="container" id="unitsContainer" style="display:none; padding: 15px">
                                            <div class="card mb-2">
                                                <div class="card-body">
                                                    <div class="justify-content-center">
                                                        <div id="uniti">
    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>


                                       
                                        
                                        <input type="hidden" name="arrayOfUnits" id="arrayOfUnits">
                                        <input type="hidden" name="arrayOfComparisons" id="arrayOfComparisons">
    
                                        <button type="button" class="btn btn-success btn-lg btn-block" style="display: none; font-size: 14px;" id="saveButton" onclick="saveUnits()">Save Units</button>
    
                                        <input type="hidden" id="submitButton" class="btn btn-success btn-lg btn-block" style="font-size: 14px;" value="Submit">
                                        </form>
                                </div>
                                
                       
                       </div>
                    </div>
                    
                </div>


   
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header "><h2 class="text-center">My Challenges</h2></div>

                    <div class="card-body">
                    
                        @isset($challenges)
                        @foreach ($challenges as $challenge)
                        <div class="card mb-3">
                            <div class="card-header text-white bg-secondary">
                                {{$challenge->challengeName}}
                                    
                            </div>
                            <div class="card-body bg-light">
                            
                            
                            
                            @foreach ($sportsType as $sport)
                                @if ($sport->sportsType_ID == $challenge->sportsType_ID)
                                    {{ $sport->sportsTypeName }}
                                @endif
                            @endforeach  

                            <div class="row">

                                @foreach ($measurements as $measurement)
                                    @if ($measurement->challenge_ID == $challenge->challenge_ID)
                                        <div class="col md-3">
                                            <div class="card mb-10">
                                                
                                                
                                                    @isset($units)
                                                        @foreach ($units as $unit)
                                                            
                                                            @if ($unit->unit_ID == $measurement->unit_ID)
                                                            <div class="card-body" style="font-size: 12px; padding: 5px">
                                                                <b>{{ $unit->unitName }}:</b>
                                                                {{ $measurement->goalValue }} 
                                                                {{ $unit->unitCode }}
                                                            </div>
                                                                
                                                            @endif
                                                        @endforeach
                                                    @endisset
                                                    
                                            </div>
                                            
                                        </div>
                                    @endif
                                    
                                    
                                @endforeach
                            </div>
                            
                            <div class="row" style="padding-top: 10px;">
                                <div class="col md-3">
                                    <?php $irSaraksta = false ?>
                                
                                    @isset($subscriptions)
                                        @foreach ($subscriptions as $sc)
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
                                                
                                            
                                                <button type="submit" class="btn btn-block btn-outline-success btn-sm" >Unsubscribe</button>
                                            </form>
                                            @else
                                            <form method="POST" id="forma" action="{{ action([App\Http\Controllers\FindChallengesController::class, 'subscribe'], $challenge->challenge_ID)}}"> @csrf @method('POST')
                                                            
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" value="{{ $challenge->challenge_ID }}">
                                                
                                            
                                                <button class="btn btn-block btn-success btn-sm" type="submit">Subscribe</button>
                                            </form>
                                            @endif
                                        @endisset
                                    @endisset
                                </div>

                                <div class="col md-3">
                                    <button class="btn btn-block btn-danger btn-sm">Delete Challenge</button>
                                    
                                </div>





                            </div>
                            
                                </div>
                                
                        </div>
                            
                        

                        
                        @endforeach
                    @endisset
                    </div>
                        
                        
                            
                        
                

         
    </div>
    
</div>
</div>

       



    
</body>

<script type='text/javascript'>
    
    function add() {
        unitsContainer = document.getElementById("unitsContainer");
        unitsContainer.style.display = "block";
        inputs = document.getElementById("uniti");
        var unit = document.createElement("SELECT");
        var comparison = document.createElement("SELECT");
        unit.setAttribute("placeholder", "Unit");
        unit.setAttribute("name", "unit");
        unit.setAttribute("id", "Unit1");
        unit.setAttribute("class", "form-control");
        comparison.setAttribute("placeholder", "Comparison");
        comparison.setAttribute("name", "comparison");
        comparison.setAttribute("id", "Comparison");
        comparison.setAttribute("class", "form-control");
        
        

        var units = {!! json_encode($units->toArray()) !!};

        var comparisons = {!! json_encode($comparisons->toArray()) !!};

        var length = units.length;
        var length2 = comparisons.length;
        var i = 0;
        var k = 0;
        
        arrayOfUnits = document.getElementById("arrayOfUnits");
        arrayOfComparisons = document.getElementById("arrayOfComparisons");

        units.forEach(function (oneUnit) {
            var xx = oneUnit.unitName;
            option = document.createElement("option");
            option.text = xx;
            option.value = xx;
            unit.appendChild(option);
            arrayOfUnits[i] = xx;
            i+=1;
        });

        comparisons.forEach(function (oneComparison) {
            console.log(oneComparison.comparisonSign);
            var v = oneComparison.comparisonName;
            option = document.createElement("option");
            option.text = v;
            option.value = oneComparison.comparisonSign;
            comparison.appendChild(option);
            arrayOfComparisons[i] = oneComparison.comparisonSign;
            k+=1;
        });
        // comparison.appendChild(document.createElement(">"));

        

        var y = document.createElement("INPUT");
        y.setAttribute("type", "number");
        y.setAttribute("placeholder", "Goal value");
        y.setAttribute("id", "Measurement1");
        y.setAttribute("class", "form-control");

        console.log(comparison);
        console.log(unit);
        //inputs.appendChild(document.createElement("br"));
        
        var cardBody = document.createElement("div");
        cardBody.setAttribute("class", "card-body");

        var cardBlock = document.createElement("div");
        cardBlock.setAttribute("class", "card mb-3");
        cardBlock.appendChild(cardBody);
        
        deletePoga = document.createElement("button");
        deletePoga.setAttribute("class", "btn btn-danger btn-sm btn-block");
        deletePoga.innerHTML += "Remove";
        deletePoga.setAttribute("onclick", "RemoveItself(this)");
        

        label = document.createElement("label");
        label.innerHTML += 'Enter Measurement Values:';
        inputs.appendChild(cardBlock);
        cardBody.appendChild(label);
        cardBody.appendChild(y);
        cardBody.appendChild(document.createElement("br"));
        cardBody.appendChild(unit);
        cardBody.appendChild(document.createElement("br"));
        cardBody.appendChild(comparison);
        cardBody.appendChild(document.createElement("br"));
        cardBody.appendChild(deletePoga);
        
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
                
                var measurement_ = inputs[i].value
                var unit_ = inputs[i+1].value;
                var comparison_ = inputs[i+2].value;
                console.log(measurement_);
                console.log(unit_);
                console.log(comparison_);
                
                let object = {unit: unit_, measurement: measurement_, comparison: comparison_};
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

    function RemoveItself(e) {
        e.parentElement.parentElement.remove();
    }
</script>


</html>
@endsection
