@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>User profile</title>         
    </head> 
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <h1>Challenger profile</h1>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>

    @can('is-admin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <div class="card text-center">
                    <div class="card-header">
                        <H1>List Of Users</H1>
                    </div>
                    <div class="card-body">
                        <table>
                        
                        @isset($users)
                        @foreach($users as $user)
                        @if($user->role !== 1)
                            <tr>
                                <td><b>ID:</b> {{$user->user_ID}}</td>
                                <td><b>Username:</b> {{$user->username}}</td>
                                <td><b>Last Login:</b> {{$user->last_login_at}}</td>
                                <td><b>Last Login IP</b>{{$user->last_login_ip}}</td>
                                <td>
                                    <form method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'destroy'], $user->user_ID) }}">@csrf @method('DELETE')
                                    
                                             <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                
                                </td>
                            </tr>
                            
                        @endif
                        @endforeach
                        @endisset
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endcan

</body>
</html>



@endsection
