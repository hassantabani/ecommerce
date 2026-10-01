@extends("layouts.websitelayout")
@section('content')

<div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Shopping cart</h1>
            @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image">Image</th>
                    <th class="goods-page-description">Name</th>
                    <th class="goods-page-quantity">Quantity</th>
                    <th class="goods-page-price">Unit price</th>
                    <th class="goods-page-ref-no">Profit</th>
                    <th class="goods-page-total" colspan="2">Total</th>
                  </tr>
                
                  @if(count($cart) > 0)
                  @foreach ($cart as $c)
                  <tr>
                    <td class="goods-page-image">
                      <a href="javascript:;"><img src="{{ asset($c->associatedModel->main_image) }}" alt="Berry Lace Dress"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="javascript:;">{{ $c->name }}</a></h3>
                      <p><strong>Item 1</strong> - Color: {{ $c->attributes->color }}; Size: {{ $c->attributes->size }}</p>
                      <em>More info is here</em>
                    </td>
                   
                    <td class="goods-page-quantity">
                      <div class="product-quantity">
                          <input data_id="{{ $c->id }}" id="product-quantity"  type="number" min="1" value="{{ $c->quantity }}" readonly class="form-control input-sm">
                      </div>
                    </td>
                    <td class="goods-page-price" data_id="{{ $c->id }}">
                      <strong>Rs<span> {{$c->price}}</span></strong>
                    </td>
                    <td class="goods-page-price" data_id="{{ $c->id }}">
                    <strong>Rs<span> <input type="number"  data_id="{{ $c->id }}" class="profit-input" id="cart-profit-{{ $c->id }}" min="1"  value="{{ $c->attributes->profit }}" style="width: 80px;background: #edeff1 ;border: none;height: 36px;padding: 0px 10px;text-align: center;"></span></strong>
                      
                    </td>
                    <td class="goods-page-total" data_id="{{ $c->id }}">
                        @php
                        $total = ((float)$c->price * (float)$c->quantity) + (float)$c->attributes->profit;
                        @endphp
                        
                      <strong>Rs<span id="cart-total-{{ $c->id }}" class="cart-total"> {{$total}}</span></strong>
                    </td>

                    <td class="del-goods-col">
                        <form action="{{ route('website-delete-cart') }}" method="post">
                            @csrf
                            <input name="row_id" type="hidden" value="{{ $c->id }}">
                      <button type="submit" style="border: none;background: none;"><a class="del-goods" href="javascript:;">&nbsp;</a></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                 @else
                 <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-size:20px;font-weight:900">Empty Cart</td>
                    <td></td>
                    <td></td>
                    </tr>
                 @endif
                 
                </table>
                </div>
                <div class="row">
                <div class="select-shipping col-md-6" style="margin-top: 30px;">
                    <label style="font-size: 20px;font-weight: 800;font-family: PT Sans Narrow, sans-serif;">Select Shipping Gateway</label>
                    <select class="form-control" id="shipping_method" name="shipping_method" style="width: 400px;background: #edeff1 ;border: none;padding: 0px 10px;text-align: center;">
                    @foreach ($shippings as $ship)
                    <option selected disabled>Select Shipping</option>
                    <option value="{{ $ship->name }}">{{ $ship->name }}</option>
                    @endforeach   
                    </select>
                </div>
                <div class="shopping-total col-md-6">
                  <ul>
                    <li>
                      <em>Sub total</em>
                      <strong class="price">Rs<span id="sub_total"></span></strong>
                    </li>
                    <li>
                      <em>Shipping cost</em>
                      <strong class="price">Rs<span id="shipping">250</span></strong>
                    </li>
                    <li class="shopping-total-price">
                      <em>Total</em>
                      <strong class="price">Rs<span id="total_price"></span></strong>
                    </li>
                  </ul>
                </div>
                </div>
              
              </div>
              <button class="btn btn-default" type="submit">Continue shopping <i class="fa fa-shopping-cart"></i></button>
              <a href="{{ route('website-checkout') }}"><button class="btn btn-primary">Checkout <i class="fa fa-check"></i></button></a>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

       
      </div>
    </div>

    <!-- BEGIN STEPS -->
    <div class="steps-block steps-block-red">
      <div class="container">
        <div class="row">
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-truck"></i>
            <div>
              <h2>Fast shipping</h2>
              <em>Express delivery withing 3 days</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-gift"></i>
            <div>
              <h2>Daily Gifts</h2>
              <em>3 Gifts daily for lucky customers</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-phone"></i>
            <div>
              <h2>477 505 8877</h2>
              <em>24/7 customer care available</em>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END STEPS -->
<script>
    let profit_input = document.getElementsByClassName('profit-input');
    let shipping_method = document.getElementById('shipping_method');

    for (let i = 0; i < profit_input.length; i++) {
        profit_input[i].addEventListener('change', function () {
        let input = profit_input[i];
        let row_id = input.getAttribute('data_id');
        let quantity = 0;
        let profit = profit_input[i].value;
        
        updatecart(row_id,quantity,profit);
    });
}

shipping_method.addEventListener('change',function(){
  let value = shipping_method.value;
  $.ajax({
            url: '{{ route('website-store-shipping-method') }}',
            type:'POST',
            data:{
                '_token': '{{ csrf_token() }}',
                'shipping':value,
            },
            success: function(data) {
                let status = data.status;
                if(status){
                   console.log('done');
                }
    },
    error: function(data) {
       alert("Something went wrong");
    }
        })
})

function total_cost(){
    let totaldiv = document.getElementsByClassName('cart-total');
    
    let subTotal = 0;
    for (let i = 0; i < totaldiv.length; i++) {
       
        let productTotal = totaldiv[i].innerHTML;
        subTotal = subTotal + parseInt(productTotal); 
}

let shipping = document.getElementById('shipping').innerHTML;
    let addShipping = parseInt(shipping) + parseInt(subTotal);
    document.getElementById('sub_total').innerHTML = subTotal;
    document.getElementById('total_price').innerHTML = addShipping;
}
    setTimeout(function(){
        let button_up = document.getElementsByClassName('bootstrap-touchspin-up');
        let button_down = document.getElementsByClassName('bootstrap-touchspin-down');

        for (let i = 0; i < button_up.length; i++) {
    button_up[i].addEventListener('click', function () {
        let input = button_up[i].closest('.input-group').querySelector('input');
        let row_id = input.getAttribute('data_id');
        let quantity = 1;
        let profit = document.getElementById('cart-profit-'+row_id).value;
        
        updatecart(row_id,quantity,profit);
    });
}

for (let i = 0; i < button_down.length; i++) {
    button_down[i].addEventListener('click', function () {
        let input = button_down[i].closest('.input-group').querySelector('input');
        let row_id = input.getAttribute('data_id');
        let quantity = -1;
        let profit = document.getElementById('cart-profit-'+row_id).value;
        updatecart(row_id,quantity,profit);
    });
}
total_cost();
    },3000)



    function updatecart(row_id,quantity,profit){
        $.ajax({
            url: '{{ route('website-update-cart') }}',
            type:'POST',
            data:{
                '_token': '{{ csrf_token() }}',
                'profit':profit,
                'quantity':quantity,
                'row_id':row_id
            },
            success: function(data) {
                let status = data.status;
                if(status){
                    let cart = data.cart;
                    let cart_data = cart[row_id];
                    document.getElementById('cart-profit-'+row_id).value = parseInt(cart_data.attributes.profit);
                    document.getElementById('cart-total-'+row_id).innerHTML = (parseInt(cart_data.price)* parseInt(cart_data.quantity)) + parseInt(cart_data.attributes.profit);
                    document.querySelector(`input[data_id='${row_id}']`).value = cart_data.quantity;
                    total_cost();
                }
    },
    error: function(data) {
       alert("Something went wrong");
    }
        })
    }
   

   
</script>
    @endsection