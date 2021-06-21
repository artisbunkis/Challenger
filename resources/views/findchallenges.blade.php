@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>Find Challenge</title>         
    </head> 
<body>

@isset($challenges)
@foreach($challenges as $challenge)
    <p>{{$challenge}}</p>
    
@endforeach
@endisset




</body>
</html>
@endsection