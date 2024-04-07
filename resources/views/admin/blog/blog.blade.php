@extends('admin.layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{session('success')}}
</div>
@endif
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Country</h4>
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
    <div class="card-body">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-active" >
                        <tr>
                            <th style="width: 5%;" scope="col">#</th>
                            <th style="width: 20%;" scope="col">Title</th>
                            <th style="width: 10%;" scope="col">Image</th>
                            <th style="width: 45%;" scope="col">Description</th>
                            <th style="width: 15%;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($listBlog))
                            @foreach($listBlog as $key => $value)
                        <tr>
                            <td class="align-middle" scope="row">{{$key + 1}}</td>
                            <td class="align-middle">{{$value->title}}</td>
                            <td class="align-middle">{{$value->avatar}}</td>
                            <td class="align-middle">{{$value->description}}</td>
                            <td>
                                <a href="{{route('dashboard.blog.editBlog', ['id' => $value->id])}}" title="Delete"><i class="mdi mdi-account-edit"></i>Edit</a>
                                <br>
                                <a href="{{route('dashboard.blog.delete', ['id' => $value->id])}}" title="Delete"><i class="mdi mdi-delete"></i>Delete</a>
                            </td>
                        </tr>
                            @endforeach
                        @else
                        <tr>
                            <td class="text-center align-middle text-danger" colspan="5">Không có dữ liệu</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><<</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">>></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-sm-12">
            <a href="{{route('dashboard.blog.getBlog')}}"><button class="btn btn-success text-white">Add Blog</button></a>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End PAge Content -->
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
