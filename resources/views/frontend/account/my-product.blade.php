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
<div class="account-post-area">
    <h2 class="title text-center">LIST PRODUCT</h2>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu" style="background: #fe9a15;">
                    <td class="image">Id</td>
                    <td class="title">Name</td>
                    <td class="image">Image</td>
                    <td class="price">Price</td>
                    <td class="Action">Action</td>
                </tr>
            </thead>
            <tbody>
                @if(!empty($dataProduct))

                @foreach($dataProduct as $value)
                @php
                    $decodedImage = json_decode($value->image);
                @endphp
                <tr>
                    <td class="cart_id">
                        <p>{{$value->id}}</p>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{$value->name}}</a></h4>
                    </td>
                    <td class="cart_product">
                        <a href=""><img style="width: 100px" src="{{asset('uploads/product/' . $decodedImage[0])}}" alt=""></a>
                    </td>

                    <td class="cart_price">
                        <p>{{$value->price}}</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_edit" href="{{route('account.editProduct', ['id' => $value->id])}}"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="cart_quantity_delete" href="{{route('account.deleteProduct', ['id' => $value->id])}}"><i class="fa fa-times"></i></a>
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
         <div class="text-right"> <!-- Đưa nút submit về phía bên phải -->
            <a class="" href="{{route('account.addProduct')}}" title=""><button type="submit" class="btn btn-primary">Add new</button></a>
        </div>
    </div>
</div>
</section><!--/form-->
@endsection
