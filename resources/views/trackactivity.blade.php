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
                            <form method="POST" action="{{ action([App\Http\Controllers\TrackActivityController::class, 'store']) }}"> @csrf
                            {{-- 
                                SPORTSNAME TABULA
                                
                             --}}
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
