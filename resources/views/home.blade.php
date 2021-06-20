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
            <div class="col-sm-12">
                <div class="card">
                    <h1>Challenger profile</h1>
                </div>
            </div>
            <br>
            <div class="col-md-6">
                <div class="card">
                    <h1>Running totals</h1>
                </div>
            </div>
            <br>
            <div class="col-md-3">
                <div class="card">
                    <h1>Find Challenges</h1>
                </div>
            </div>
            <br>
            <div class="col-md-3">
            @guest
                <h1>WELCOME</h1>
            @else
                <div class="card">
                    <div class="card-header">Create challenge</div>
                    <div class="form"> 
                        <form method="POST" action="{{ action([App\Http\Controllers\ChallengeController::class, 'store']) }}"> @csrf
                        {{--
                        <input type="hidden" name="sportsType_ID" value="{{ $challenge->sportsType_ID }}"> // te vajag fk sataisit pareizi 
                        --}} 
                        <label for="challengeName">Chellenge Name: </label>
                        <input type="text" name="challengeName" id="challengeName"><br>

                        <label for="beginDate">Begin Date:</label>
                        <input type="date" name="beginDate" id="beginDate">

                        <label for="endDate">End Date:</label>
                        <input type="date" name="endDate" id="endDate"><br>

                        <label for="isPublic">Public: </label>
                        <input type="checkbox" checked name="isPublic" id="isPublic"><br>

                        <input type="submit" value="add">
                        </form>
                    
                    </div>
                </div>



            <br>
                <div class="card">
                    <div class="card-header">Track Activity</div>

                    <div class="form">
                        {{--aizkomenteto atkomentet kad izveidots lidz galam kontroleris un parejais--}}

                        
                    
                        <form method="POST"  > @csrf
                        {{-- <input type="hidden" name="challenge_ID" value="{{ $challenge->id }}">   


                        <input type="hidden" name="sportsType_ID" value="{{ $challenge->foreignId }}">
                        <input type="hidden" name="creatorUser_ID" value="{{ $challenge->foreignId }}">  --}}
                        
                        <label for="challengeName">Chellenge Name: </label>
                        <input type="text" name="challengeName" id="challengeName"><br>

                        <label for="beginDate">Begin Date:</label>
                        <input type="date" name="beginDate" id="beginDate">

                        <label for="endDate">End Date:</label>
                        <input type="date" name="endDate" id="endDate"><br>

                        <label for="isPublic">Public: </label>
                        <input type="checkbox" checked name="isPublic" id="isPublic"><br>

                        <input type="submit" value="add">
                        </form>
                    
                    </div>
                </div>
            </div>

            <br>

            
            @endguest
        </div>

       



    </div>
</body>
</html>
@endsection
