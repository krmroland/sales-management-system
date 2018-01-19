<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ company()->name }} System</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="bg-grey">
    <div class="conatiner is-fullheight d-flex align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h2 class="text-primary text-center p-2">{{ company()->name }}</h2>
                <div class="card-block">
                    <h4 class="card-title text-center">Admin Login Form</h4>
                    <form action="/login" method="post">
                        {{ csrf_field() }}
                        {{-- Emaill Address --}}
                        <div class="form-group {{$errors->has("email")?'has-danger':''}}">
                            <label  for="email">Emaill Address (admin@sales.com)</label>
                            <input type="email" name="email" class="form-control" placeholder="Emaill Address" value="{{old("email",'admin@sales.com')}}">
                            @if($errors->has("email"))
                            <p class="form-text text-danger">
                                {{$errors->first("email")}}
                            </p>
                            @endif
                        </div>
                        
                        {{-- Password --}}
                        <div class="form-group {{$errors->has("password")?'has-danger':''}}">
                            <label  for="password">Password (password)</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" value="{{old('password','password')}}">
                            @if($errors->has("password"))
                            <p class="form-text text-danger">
                                {{$errors->first("password")}}
                            </p>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-sign-in"></i>
                                Login
                            </button>
                        </div>
                        
                    </form>
                    <p class="text-right">
                       A project by <a href="https://www.facebook.com/ahimbisibwe.roland" target="_blank">
                        <strong>Ahimbisibwe Roland</strong>
                    </a>
                    </p>
                </div>
            </div>
        </div>
        

    
      
    </div>
</body>
</html>

