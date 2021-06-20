@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>Home</title>         
    </head> 
<body>
        @isset($units)
            @foreach ( $units as $unit )
                <h1>{{ $unit->unitName }}</h1>
            @endforeach
        @endisset
        

         <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header text-center"><h2>Track Activity</h2></div>
                            <div class="form text-center">
                                <form method="POST" id="forma" action="{{ action([App\Http\Controllers\ChallengeController::class, 'store']) }}"> @csrf
                                    {{--
                                    <input type="hidden" name="sportsType_ID" value="{{ $challenge->sportsType_ID }}"> // te vajag fk sataisit pareizi 
                                    --}} 
                                    <label for="challengeName">Challenge Name: </label>
                                    <input type="text" name="challengeName" id="challengeName"><br>
                    
                                    <label for="beginDate">Begin Date:</label>
                                    <input type="date" name="beginDate" id="beginDate">
                    
                                    <label for="endDate">End Date:</label>
                                    <input type="date" name="endDate" id="endDate"><br>
                    
                                    <label for="isPublic">Public: </label>
                                    <input type="checkbox" checked name="isPublic" id="isPublic"><br>
                                    
                                    <button type="button" onclick="add()">Add Units</button>
                                    <br>
                                    
                                    <div id="uniti">

                                    </div>
                                    <br>

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
        unit.setAttribute("id", "Unit1");


        var units = {!! json_encode($units->toArray()) !!};
        var length = units.length;
        var i = 0;
        

        units.forEach(function (oneUnit) {
            var xx = oneUnit.unitName;
            option = document.createElement("option");
            option.text = xx;
            option.value = xx;
            unit.appendChild(option);
        });

        var y = document.createElement("INPUT");
        y.setAttribute("type", "text");
        y.setAttribute("placeholder", "Goal value");
        y.setAttribute("id", "Measurement1");


        inputs.appendChild(document.createElement("br"));
        inputs.appendChild(y);
        inputs.appendChild(unit);
        inputs.appendChild(document.createElement("br"));
    }
</script>


</html>
@endsection
