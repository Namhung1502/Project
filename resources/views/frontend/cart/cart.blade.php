@extends('frontend.layouts.app')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
          </ol>
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
                @else
                    <tr>
                        <td style="text-align: center;" colspan="5">Không có dữ liệu</td>
                    </tr>
                @endif
            </tbody>
        </table>
</div>
</div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{$sumTotal}}</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="{{url('/cart/checkout')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('a.cart_quantity_up').click(function(e){
            e.preventDefault();
            var tempInput = $(this).closest("td.cart_quantity").find("input");
            var tempTotal = $(this).closest("tr").find("p.cart_total_price");
            var tempPrice = $(this).closest("tr").find("td.cart_price").text().replace('$', '').trim();
            var getId = $(this).data("id");
            var currentValue = parseInt(tempInput.val()) + 1;
            var currentTotal = "$" + (tempPrice * currentValue);
            tempInput.val(currentValue);
            tempTotal.text(currentTotal);
            $.ajax({
                type: 'POST',
                url:'{{url("cart/ajax")}}',
                data: {
                    id:getId,
                    qty: currentValue,
                    up : 1
                },
                success:function(data){
                    console.log(data.success);
                }
            });

            //tính tổng các total
            var total = $("tbody").find("p.cart_total_price").text().split("$");
            var sumTotal = 0;
            var totalArea = $("div.total_area").find("li:last-child span");
            for(var  i = 1; i < total.length; i++){
                sumTotal = sumTotal + parseInt(total[i]);
            }
            totalArea.text(sumTotal);
        });
        $('a.cart_quantity_down').click(function(e){
            e.preventDefault();
            var tempInput = $(this).closest("td.cart_quantity").find("input");
            var tempTotal = $(this).closest("tr").find("p.cart_total_price");
            var tempPrice = $(this).closest("tr").find("td.cart_price").text().replace('$', '').trim();
            var currentValue = parseInt(tempInput.val()) - 1;
            var getId = $(this).data("id");
            if(currentValue > 0) {
                var currentTotal = "$" + (tempPrice * currentValue);
                tempInput.val(currentValue);
                tempTotal.text(currentTotal);
            } else {
                $(this).closest("tr").remove();
            }
            $.ajax({
                type:'POST',
                url: '{{url("cart/ajax")}}',
                data: {
                    id:getId,
                    qty: currentValue,
                    up : 2
                }
            });
            var total = $("tbody").find("p.cart_total_price").text().split("$");
            var sumTotal = 0;
            var totalArea = $("div.total_area").find("li:last-child span");
            for(var  i = 1; i < total.length; i++){
                sumTotal = sumTotal + parseInt(total[i]);
            }
            totalArea.text("$"+sumTotal);

        });
        $('a.cart_quantity_delete').click(function(e){
            e.preventDefault();
            var getId = $(this).data("id");
            if(confirm("Bạn có muốn xóa sản phẩm không?")){
                $(this).closest("tr").remove();
                $.ajax({
                    type:'POST',
                    url: '{{url("cart/ajax")}}',
                    data: {
                        id:getId,
                        up : 3
                    },
                    success:function(data){
                        console.log(data)
                    }
                });
            }
        });

    })
</script>
@endsection
