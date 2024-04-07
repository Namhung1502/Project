@extends('frontend.layouts.app')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
          </ol>
      </div><!--/breadcrums-->

      <div class="step-one">
        <h2 class="heading">Step1</h2>
    </div>
    <div class="checkout-options">
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
    </div><!--/checkout-options-->

    <div class="register-req">
        <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
    </div><!--/register-req-->

    <div class="shopper-informations">
        <div class="row">
            <div class="col-sm-3">
                <div class="shopper-info">
                    <p>Shopper Information</p>
                    <form>
                        <input type="text" placeholder="Display Name">
                        <input type="text" placeholder="User Name">
                        <input type="password" placeholder="Password">
                        <input type="password" placeholder="Confirm password">
                    </form>
                    {{-- <a class="btn btn-primary" href="">Get Quotes</a> --}}
                    <a class="btn btn-primary" href="{{url('cart/checkout/test')}}">Continue</a>
                </div>
            </div>
        </div>
    </div>
    <div class="review-payment">
        <h2>Review & Payment</h2>
    </div>

    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @php
                $sumTotal = 0;
                @endphp
                @if (session()->has('cart'))
                    @php
                        $getSession = session()->get('cart');
                        $total = 0;
                    @endphp
                    @foreach($getSession as $value)
                    @php
                        $decodedImage = json_decode($value['image']);
                        $total = $value['price'] * $value['qty'];
                        $sumTotal += $total;
                    @endphp
                <tr>
                    <td class="cart_product">
                        <a href=""><img style="width: 100px" src="{{asset('uploads/product/'. $decodedImage[0])}}" alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{$value['name']}}</a></h4>
                        <p>Web ID: 100014</p>
                    </td>
                    <td class="cart_price">
                        <p>{{$value['price']}}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <a class="cart_quantity_up" data-id="{{$value['id']}}" href=""> + </a>
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{$value['qty']}}" autocomplete="off" size="2">
                            <a class="cart_quantity_down" data-id="{{$value['id']}}" href=""> - </a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">${{$total}}</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" data-id="{{$value['id']}}" href=""><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condenssed total-result">
                            <tr>
                                <td>Cart Sub Total</td>
                                <td>$59</td>
                            </tr>
                            <tr>
                                <td>Exo Tax</td>
                                <td>$2</td>
                            </tr>
                            <tr class="shipping-cost">
                                <td>Shipping Cost</td>
                                <td>Free</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><span>${{$sumTotal}}</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="payment-options">
        <span>
            <label><input type="checkbox"> Direct Bank Transfer</label>
        </span>
        <span>
            <label><input type="checkbox"> Check Payment</label>
        </span>
        <span>
            <label><input type="checkbox"> Paypal</label>
        </span>
    </div>
</div>
</section> <!--/#cart_items-->
<script>
$(document).ready(function(){
    var checkLogin = {{Auth::check()}}
    if(checkLogin) {
        $('.signup-form').hide();
    } else {
        $('.signup-form').show();
    }
});

</script>
@endsection
