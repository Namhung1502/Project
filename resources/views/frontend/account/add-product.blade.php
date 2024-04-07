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
    <div class="blog-post-area">
        <h2 class="title text-center">CREATE PRODUCT</h2>
        <div class="signup-form"><!--sign up form-->
            <h2>Create product!</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('account.postProduct')}}" class="form-horizontal form-material mx-2" enctype="multipart/form-data"   method="POST">
                    @csrf
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Johnathan Doe" class="form-control form-control-line">
                            </div>
                        </div>
                        @if($errors->has('name'))
                        <div class="alert alert-danger alert-dismissible">
                                <span>{{ $errors->first('name') }}</span>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" name="price" placeholder="56" class="form-control form-control-line">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <select class="form-select form-control-line" name="id_category">
                                    <option selected>Please choose category</option>
                                    @if(!empty($listCategory))
                                    @foreach($listCategory as $value)
                                        <option value="{{$value->id}}">{{$value->category}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <select class="form-select shadow-none form-control-line" name="id_brand">
                                    <option selected = "selected">Please choose Brand</option>
                                    @if(!empty($listBrand))
                                    @foreach($listBrand as $value)
                                        <option value="{{$value->id}}">{{$value->brand}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <select id="saleOption" name="status" class="form-select shadow-none form-control-line">
                                    <option value="0">New</option>
                                    <option value="1">Sale</option>
                                </select>
                            </div>
                        </div>
                        <div id="saleInput" class="form-group" style="display: none;">
                            <div class="col-md-3">
                                <input type="text" name="sale" placeholder="0" class="form-control form-control-line">
                            </div>
                            <label style="height: 40px; display: flex; align-items: center;">%</label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" name="company" placeholder="Company profile" class="form-control form-control-line" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="file" name="image[]" class="form-control form-control-line" id="files" multiple accept="image/*"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea name="detail" placeholder="Detail" class="form-control form-control-line"></textarea>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="col-sm-12">
                                <button class="btn btn-success text-white">Add Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section><!--/form-->
<script type="text/javascript">
    // Đặt một sự kiện "change" lên thẻ <select> có ID là 'saleOption'.
    // Khi giá trị của thẻ này thay đổi, hàm được truyền vào sẽ được gọi.
    document.getElementById('saleOption').addEventListener('change', function() {
        // Lấy thẻ <input> có ID là 'saleInput' để thực hiện việc thay đổi
        // hiển thị của nó dựa trên giá trị của thẻ <select>.
        var saleInput = document.getElementById('saleInput');
        if (this.value === '1') {
            // Hiển thị thẻ <input> có ID là 'saleInput' và đặt thuộc tính style.display thành 'block')
            saleInput.style.display = 'block';
        } else {
            // Ẩn thẻ <input> có ID là 'saleInput' và đặt thuộc tính style.display thành 'none')
            saleInput.style.display = 'none';
        }
    });
</script>
@endsection
