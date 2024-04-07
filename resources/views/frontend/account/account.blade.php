@extends('frontend.layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{session('success')}}
</div>
@endif
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
<section><!--form-->
<div class="col-sm-9">
    <div class="account-post-area">
        <h2 class="title text-center">Update user</h2>
        <div class="signup-form"><!--sign up form-->
            <h2>Update user!</h2>
            <form action="{{route('account.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" value = "{{old('name') ?? Auth::user()->name}}" placeholder="Name"/>
                <input type="email" name="email" value = "{{old('email') ?? Auth::user()->email}}" placeholder="Email Address" disabled/>
                <input type="password" name="password" value = "{{old('password')}}" placeholder="*********"/>
                <input type="text" name="phone" value = "{{old('phone') ?? Auth::user()->phone}}" placeholder="Number Phone">
                <input type="text" name="address" value = "{{old('address') ?? Auth::user()->address}}" placeholder="city">
                <input type="file" name="avatar" />
                <button type="submit" class="btn btn-default">Signup</button>
            </form>
        </div>
    </div>
</div>
</section><!--/form-->

@endsection
