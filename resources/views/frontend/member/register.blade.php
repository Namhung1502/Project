@extends('frontend.layouts.app')

@section('content')
@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <a href="{{route('member.login')}}" title=""><button type="submit" class="btn btn-default">Signup</button></a>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{route('member.postRegister')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="name" placeholder="Full Name"/>
                        <input type="email" name="email" placeholder="Email"/>
                        <input type="password" name="password"  placeholder="Password"/>
                        <input type="text" name="address" placeholder="address">
                        <input type="text" name="phone" placeholder="Phone" >
                        <input type="file" name="avatar" placeholder="Default file Image"/>
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection
