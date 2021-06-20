@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>Track Activity</title>         
    </head> 
<body>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center"><h2>Track Activity</h2></div>
                        <div class="form text-center">
                            <form method="POST" action="{{ action([App\Http\Controllers\ChallengeController::class, 'store']) }}"> @csrf
                            {{-- <input type="hidden" name="challenge_ID" value="{{ $challenge->id }}">   

                            <input type="hidden" name="sportsType_ID" value="{{ $challenge->foreignId }}">
                            <input type="hidden" name="creatorUser_ID" value="{{ $challenge->foreignId }}">  --}}
                            <br><br>
                            <label for="challengeName">Chellenge Name: </label>
                            <input type="text" name="challengeName" id="challengeName"><br>
                            <br><br>
                            <label for="beginDate">Begin Date:</label>
                            <input type="date" name="beginDate" id="beginDate">
                            <br><br>
                            <label for="endDate">End Date:</label>
                            <input type="date" name="endDate" id="endDate"><br>
                            <br><br>
                            <label for="isPublic">Public: </label>
                            <input type="checkbox" checked name="isPublic" id="isPublic"><br>
                            <br><br>
                            <input type="submit" value="add">
                            <br><br>
                        </form>
                   
                   </div>
                </div>
                
            </div>
        </div>
</div>
    
</body>
</html>
@endsection
