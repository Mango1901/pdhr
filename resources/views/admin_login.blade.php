<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="{{asset("tables/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("tables/css/bootstrap.css")}}" rel="stylesheet">
    <link href="{{asset("tables/css/font-awesome.min.css")}}" rel="stylesheet">
    <link href="{{asset("tables/css/style.css")}}" rel="stylesheet">

    <script src="{{asset("tables/js/bootstrap.min.js")}}"></script>
    <script src="{{asset("tables/js/bootstrap.js")}}"></script>
</head>
<body>
<div class="container bgr_login">
    <!---heading---->
    <header class="heading"> Đăng nhập</header><hr>
    @if (session('message'))
        <div class="alert alert-success help-block">{{session('message')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger help-block">{{session('error')}}</div>
@endif
    <!---Form starting---->
    <form action="{{route("execute.login")}}" method="post">
        @csrf
    <div class="row">
        <!--- For Name---->
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-lg-3 firstname">User name :</label>
                    <div class="col-lg-8">
                        <input type="text" name="username" placeholder="Enter your User name or email" class="form-control ">
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-lg-3 firstname">Password :</label>
                    <div class="col-lg-8">
                        <input type="password" name="password" placeholder="Enter your Password" class="form-control ">
                    </div>
                </div>
            </div>

            <!-----------For Phone number-------->
            <div class="col-sm-12">
                <div class="col-sm-12">
                    <button class="btn btn-warning" type="submit">Submit</button>
                </div>
            </div>
    </div>
    </form>

</div>

</body>
</html>
