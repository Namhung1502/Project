<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    {{-- <p>{{dd($data['body'])}}</p> --}}
    {{-- <p>{{$data['body']}}</p> --}}
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
                @foreach($data['body'] as $value)
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
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{$value['qty']}}" autocomplete="off" size="2" disabled>
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
</body>
</html>
