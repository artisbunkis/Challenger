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
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2 class="text-center">{{ __("My Profile")}}</h2></div>
                        <div class="card-body">
                            <div class="info">
                                <div class="row d-flex justify-content-center">
                                    
                                    <div>
                                        <div>
                                            @if ($thisuser->hasProfilePicture == true)
                                                {{-- show image --}}
                                                <img class="image rounded-circle" src="{{asset('/uploadimages/photos/'.Auth::id())}}" alt="profile_image" style="width: 180px;height: 180px; padding: 10px; margin: 0px; ">
                                            @else
                                                {{-- show default image --}}
                                                <img class="image rounded-circle" src="{{asset('/uploadimages/photos/default.jpg')}}" alt="profile_image" style="width: 180px;height: 180px; padding: 10px; margin: 0px; ">
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div>
                                        {{-- PROFILE CARD BODY --}}
                                <b>{{ __("Username")}}:</b> {{$thisuser->username}}<br>
                                <b>{{ __("E-mail")}}:</b> {{$thisuser->email}}<br>
                                <b>{{ __("First Name")}}:</b> {{$thisuser->firstName}}<br>
                                <b>{{ __("Last Name")}}:</b> {{$thisuser->lastName}}<br>
                                <b>{{ __("Birthday")}}:</b> {{$thisuser->birthDate}}<br>
                                @isset($gender)
                                    <p><b>{{ __("Gender")}}:</b> {{$gender->genderName}}</p>
                                @else
                                    <p><b>{{ __("Gender")}}:</b> None </p>
                                @endisset
                                
                                
                                <button class="btn btn-block btn-secondary btn-lg" style="font-size: 14px;" onclick="showEdit(this)" id="edit" value="profile">{{ __("Edit")}}</button>
                                    </div>
                                </div>
                                
                            </div>

                            <div id="editProfile" style="display: none">
                                <div class="form-group">
                                    <form method="POST" id="forma" action="{{ action([App\Http\Controllers\UserController::class, 'edit']) }}" enctype="multipart/form-data"> @csrf @method('POST')
                                        <br>
                                        <label for="username">{{ __("Username")}}:</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{$thisuser->username}}">
                                        <div class="alert-danger" style="font-weight: bold;">@error('username') {{$message}} @enderror</div>
                                        
                                        <label for="email">{{ __("E-mail")}}:</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="{{$thisuser->email}}">
                                        <div class="alert-danger" style="font-weight: bold;">@error('email') {{$message}} @enderror</div>

                                        <label for="firstname">{{ __("First Name")}}:</label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value="{{$thisuser->firstName}}">
                                        <div class="alert-danger" style="font-weight: bold;">@error('firstname') {{$message}} @enderror</div>

                                        <label for="lastname">{{ __("Last Name")}}:</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" value="{{$thisuser->lastName}}">
                                        <div class="alert-danger" style="font-weight: bold;">@error('lastname') {{$message}} @enderror</div>

                                        <label for="birthday">{{ __("Birthday")}}:</label>
                                        <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Birthday" value="{{$thisuser->birthdate}}">
    
                                        <label for="gender">{{ __("Gender")}}:</label>
                                        <select type="text" class="form-control" name="gender" id="gender" placeholder="Gender" selected="{{$thisuser->gender_ID}}">
                                            <option value="1">{{ __("Male")}}</option>
                                            <option value="2">{{ __("Female")}}</option>
                                            <option value="3">{{ __("Unknown")}}</option>
                                        </select>
                                        <br>

                                        <label for="photo">{{ __("Photo")}}:</label>
                                        <input type="file" name="photo" id="photo">
                                        
                                        <button type="submit" class="btn btn-block btn-success btn-lg" style="font-size: 14px; ">{{ __("Submit")}}</button>
                                    
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
                        <H1>{{ __("List Of Users")}}</H1>
                    </div>
                    <div class="card-body">
                        <table>
                        
                        @isset($users)
                        @foreach($users as $user)
                        @if($user->role !== 1)
                            <tr>
                                <td><b>ID:</b> {{$user->user_ID}}</td>
                                <td><b>{{ __("Username")}}:</b> {{$user->username}}</td>
                                <td><b>{{ __("Last Login")}}:</b> {{$user->last_login_at}}</td>
                                <td><b>{{ __("Last Login IP")}}</b>{{$user->last_login_ip}}</td>
                                <td>
                                    <form method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'destroy'], $user->user_ID) }}">@csrf @method('DELETE')
                                    
                                             <button type="submit" class="btn btn-danger">{{ __("Delete")}}</button>
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
