@extends('admin.layouts.app')


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
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Profile</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3">
            <div class="card">
                <div class="card-body">
                    <center class="mt-4"> <img src="{{asset('admin/assets/images/users/'. Auth::user()->avatar)}}"
                        class="rounded-circle" width="150" />
                        <h4 class="card-title mt-2">{{Auth::user()->name}}</h4>
                        <h6 class="card-subtitle">Accoubts Manager</h6>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                class="mdi mdi-account-network"></i>
                                <font class="font-medium">254</font>
                            </a></div>
                            <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                class="mdi mdi-camera"></i>
                                <font class="font-medium">54</font>
                            </a></div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body"> <small class="text-muted">Email address </small>
                    <h6>{{Auth::user()->email}}</h6> <small class="text-muted pt-4 db">Phone</small>
                    <h6>+91 654 784 547</h6> <small class="text-muted pt-4 db">Address</small>
                    <h6>{{Auth::user()->address ?? '71 Pilgrim Avenue Chevy Chase, MD 20815'}}</h6>
                    <div class="map-box">
                        <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                        width="100%" height="150" frameborder="0" style="border:0"
                        allowfullscreen></iframe>
                    </div> <small class="text-muted pt-4 db">Social Profile</small>
                    <br />
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('dashboard.updateProfile')}}" class="form-horizontal form-material mx-2" enctype="multipart/form-data"   method="POST">
                        <div class="form-group">
                            @csrf
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Johnathan Doe" class="form-control form-control-line" value="{{old('name') ?? Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email"name="email" placeholder="johnathan@admin.com" class="form-control form-control-line"  id="example-email" value="{{Auth::user()->email}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" name="password" placeholder="***********" class="form-control form-control-line" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <input type="text" name="address" placeholder="71 Pilgrim Avenue Chevy Chase, MD 20815
                                " class="form-control form-control-line" value="{{old('address') ?? Auth::user()->address}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone</label>
                            <div class="col-md-12">
                                <input type="text" name="phone" placeholder="123 456 7890" class="form-control form-control-line" value="{{old('phone') ?? Auth::user()->phone}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12" for="customFile">Default file Image</label>
                            <div class="col-md-12">
                                <input type="file" name="avatar" class="form-control form-control-line" id="customFile"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Message</label>
                            <div class="col-md-12">
                                <textarea rows="5" class="form-control form-control-line"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select name="country" class="form-select shadow-none form-control-line">
                                @if(!empty($dataCountry))
                                    @foreach($dataCountry as $value)
                                    <option value="{{ $value['id'] }}">{{$value->title}}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success text-white">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer text-center">
    All Rights Reserved by Nice admin. Designed and Developed by
    <a href="https://www.wrappixel.com">WrapPixel</a>.
</footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
@endsection
