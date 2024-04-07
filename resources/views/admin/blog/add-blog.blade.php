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
            <h4 class="page-title">Create Blog</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
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
        <div class="col-12">
            <div class="card card-body">
                <form action="{{route('dashboard.blog.postBlog')}}" class="form-horizontal mt-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12" >Title <span class="help text-danger">(*)</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Country">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="custom-file">
                            <textarea class="form-control" name="description" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Content</label>
                        <textarea class="form-control" name="content" id="editorContent"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" name="submit" class="btn btn-success text-white">Add Country</button>
                            <a href="{{route('dashboard.blog.index')}}" class="btn btn-danger text-white">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
