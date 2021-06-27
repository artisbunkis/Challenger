@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>User profile</title>         
    </head> 
<body>

   

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="text-center">My Profile</h2></div>
                        <div class="card-body">
                            <div class="info">
                                {{-- PROFILE CARD BODY --}}
                                <p><b>Username:</b> {{$thisuser->username}}</p>
                                <p><b>E-mail:</b> {{$thisuser->email}}</p>
                                <p><b>First Name:</b> {{$thisuser->firstName}}</p>
                                <p><b>Last Name:</b> {{$thisuser->lastName}}</p>
                                <p><b>Birthday:</b> {{$thisuser->birthDate}}</p>
                                @isset($gender)
                                    <p><b>Gender:</b> {{$gender->genderName}}</p>
                                @else
                                    <p><b>Gender:</b> None </p>
                                @endisset
                                
                                
                                <button class="btn btn-block btn-secondary btn-lg" style="font-size: 14px;" onclick="showEdit(this)" id="edit" value="profile">Edit</button>
                            </div>

                            <div id="editProfile" style="display: none">
                                <div class="form-group">
                                    <form method="POST" id="forma" action="{{ action([App\Http\Controllers\UserController::class, 'edit']) }}"> @csrf @method('POST')
                                        <br>
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{$thisuser->username}}">
    
                                        <label for="email">E-mail:</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="{{$thisuser->email}}">
    
                                        <label for="firstname">First Name:</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value="{{$thisuser->firstName}}">
    
                                        <label for="lastname">Last Name:</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" value="{{$thisuser->lastName}}">
    
                                        <label for="birthday">Birthday:</label>
                                        <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Birthday" value="{{$thisuser->birthdate}}">
    
                                        <label for="gender">Gender:</label>
                                        <select type="text" class="form-control" name="gender" id="gender" placeholder="Gender" selected="{{$thisuser->gender_ID}}">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Unknown</option>
                                        </select>
                                        <br>

                                        <label for="photo">Photo:</label>
                                        <input type="file" name="photo" id="photo">

                                        <button type="submit" class="btn btn-block btn-success btn-lg" style="font-size: 14px; ">Submit</button>

                                    </form>
                        
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <br><br><br>

    {{-- ADMINAM --}}
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

<script>
    
    function showEdit(button) {
        var edit = document.getElementById("editProfile");
        

        if(button.value == "profile") {
            // Tagad rada profilu
            edit.style.display = "block";
            button.value = "edit";
            document.getElementById("edit").innerHTML = "Cancel";
            return;
        } 
        if(button.value == "edit") {
            // Tagad rada edit
            edit.style.display = "none";
            button.value = "profile";
            document.getElementById("edit").innerHTML = "Edit";
        }
    }

</script>

</html>



@endsection
