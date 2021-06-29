@extends('layouts.app')
@section('content')

<!DOCTYPE html>    
<html>    
    <head>    

        <title>Login Form</title>   
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/welcomestyle.css') }} ">   
    </head>    
    <body>

        

        <title>{{ __("Login Form")}}</title>   
        <link rel="stylesheet" type="text/css" href="css/style.css"> 
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">    
    </head>    
    <body>
        <div class="d-flex align-items-center justify-content-center" style="height: 90vh">
            <h1 class="welcomeText fade-in">{{ __("Welcome To Challenger")}}!</h1>
            <h1></h1>

        </div>
        
         
            
    </div>    
    </body>    
</html>     
@endsection