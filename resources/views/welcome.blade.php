@extends('layouts.app')
@section('content')

<!DOCTYPE html>    
<html>    
    <head>    
        <title>WELCOME PAGE</title>   
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/welcomestyle.css') }} ">   
    </head>      
    <body>
        <div class="bg-image"></div>
        <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
            <h1 class="welcomeText fade-in">{{ __("Welcome To Challenger")}}!</h1>
            <h1></h1>

        </div>
        
    
         
            
       
    </body>    
</html>     
@endsection