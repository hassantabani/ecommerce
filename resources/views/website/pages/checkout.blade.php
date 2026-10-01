@extends("layouts.websitelayout")
@section('content')

 <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">Checkout</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Checkout</h1>
            <!-- BEGIN CHECKOUT PAGE -->
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
             <form action="{{ route('website-place-order') }}" method="post">
                @csrf
             
            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">


              <!-- BEGIN SHIPPING ADDRESS -->
              <div id="shipping-address" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-address-content" class="accordion-toggle">
                      Step 1: Customer Delivery Details
                    </a>
                  </h2>
                </div>
                <div id="shipping-address-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label for="firstname-dd">First Name <span class="require">*</span></label>
                        <input type="text" id="firstname-dd" value="{{ old('firstname') }}" name="firstname" class="form-control" require>
                      </div>
                      <div class="form-group">
                        <label for="lastname-dd">Last Name <span class="require">*</span></label>
                        <input type="text" id="lastname-dd" value="{{ old('lastname') }}" name="lastname" class="form-control" require>
                      </div>
                      <div class="form-group">
                        <label for="telephone-dd">Telephone <span class="require">*</span></label>
                        <input type="text" id="telephone-dd" value="{{ old('phone_number') }}" name="phone_number" class="form-control" require>
                      </div>
                      <div class="form-group">
                        <label for="extra-details-dd">Extra Detail About Customer</label>
                        <textarea name="extra_customer_details"  id="extra_customer_details" class="form-control" rows="8">{{ old('extra_customer_details') }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label for="address1-dd">Address 1</label>
                        <input type="text" id="address1-dd" value="{{ old('main_address') }}" name="main_address" class="form-control" require>
                      </div>
                      <div class="form-group">
                        <label for="address2-dd">Address 2</label>
                        <input type="text" id="address2-dd" value="{{ old('address2-dd') }}" name="address2-dd" class="form-control" require>
                      </div>
                      <div class="form-group">
                        <label for="city-dd">City <span class="require">*</span></label>
                        <select class="form-control" id="city-dd" name="city" require value="{{ old('city') }}">
                          <option value=""> --- Please Select --- </option>
                          @foreach ($cities as $city)
                          <option value="{{ $city->id }}" {{ old('city') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                          @endforeach
                        </select>
                        
                      </div>
                      <div class="form-group">
                        <label for="post-code-dd">Post Code <span class="require">*</span></label>
                        <input type="text" id="postal_code" value="{{ old('postal_code') }}" name="postal_code" class="form-control" require>
                      </div>
                      <div class="form-group">
                        <label for="country-dd">Country <span class="require">*</span></label>
                        <select class="form-control input-sm" id="country" name="country" require>
                          <option value=""> --- Please Select --- </option>
                          <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="region-state-dd">State <span class="require">*</span></label>
                        <select class="form-control input-sm" id="region-state-dd" name="province" require>
                          <option value=""> --- Please Select --- </option>
                          <option value="Sindh" {{ old('province') == 'Sindh' ? 'Sindh' : '' }}>Sindh</option>
                          <option value="Punjab" {{ old('province') == 'Punjab' ? 'Punjab' : '' }}>Punjab</option>
                          <option value="Balochistan" {{ old('province') == 'Balochistan' ? 'Balochistan' : '' }}>Balochistan</option>
                          <option value="KPK" {{ old('province') == 'KPK' ? 'KPK' : '' }}>KPK</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <a class="btn btn-primary  pull-right" id="button-shipping-address" data-toggle="collapse" data-parent="#checkout-page" data-target="#shipping-method-content" style="color:white;">Continue</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END SHIPPING ADDRESS -->

              <!-- BEGIN SHIPPING METHOD -->
              <div id="shipping-method" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-method-content" class="accordion-toggle">
                      Step 2: Delivery Method
                    </a>
                  </h2>
                </div>
                <div id="shipping-method-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12">
                      <p>Please select the preferred shipping gateway to use on this order.</p>
                      <div class="radio-list">
                        <label>
                          <input type="radio" checked name="shipping_gateway" value="{{ $shipping }}" require> {{ $shipping }}
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="delivery-comments">Add Comments About Your Order</label>
                        <textarea id="delivery-comments" name="delivery-comments" rows="8" class="form-control">{{ old('delivery-comments') }}</textarea>
                      </div>
                      <a class="btn btn-primary  pull-right" style="color:white;" id="button-shipping-method" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-method-content">Continue</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END SHIPPING METHOD -->

              <!-- BEGIN PAYMENT METHOD -->
              <div id="payment-method" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-method-content" class="accordion-toggle">
                      Step 3: Payment Method
                    </a>
                  </h2>
                </div>
                <div id="payment-method-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12">
                      <p>Please select the preferred payment method to use on this order.</p>
                      <div class="radio-list">
                        <label>
                          <input type="radio" name="payment_method" checked value="COD" require> Cash On Delivery
                        </label>
                      </div>
                     
                      <a class="btn btn-primary  pull-right" style="color:white;" id="button-payment-method" data-toggle="collapse" data-parent="#checkout-page" data-target="#confirm-content">Continue</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PAYMENT METHOD -->

              <!-- BEGIN CONFIRM -->
              <div id="confirm" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#confirm-content" class="accordion-toggle">
                      Step 4: Confirm Order
                    </a>
                  </h2>
                </div>
                <div id="confirm-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12 clearfix">
                      <div class="table-wrapper-responsive">
                      <table>
                        <tr>
                          <th class="checkout-image">Image</th>
                          <th class="checkout-description">Description</th>
                          <th class="checkout-quantity">Quantity</th>
                          <th class="checkout-price">Price</th>
                          <th class="checkout-quantity">Profit</th>
                          <th class="checkout-total">Total</th>
                        </tr>
                        @foreach ($carts as $cart)
                           @php
                           $product_id = $cart->associatedModel->id;
                           $product = \App\Models\Products::find($product_id);
                           @endphp
                            <tr>
                          <td class="checkout-image">
                            <a href="javascript:;"><img src="{{ asset($product->main_image) }}" alt="{{ $cart->name }}"></a>
                          </td>
                          <td class="checkout-description">
                            <h3><a href="javascript:;">{{ $cart->name }}</a></h3>
                            <p><strong>Item 1</strong> - Color: {{$cart->attributes->color }}; Size: {{ $cart->attributes->size }}</p>
                            <em>More info is here</em>
                          </td>
                          <td class="checkout-quantity">{{ $cart->quantity }}</td>
                          <td class="checkout-price"><strong><span>Rs</span>{{ $cart->price }}</strong></td>
                          <td class="checkout-price"><strong><span>Rs</span>{{ $cart->attributes->profit }}</strong></td>
                          @php
                        $total = ((float)$cart->price * (float)$cart->quantity) + (float)$cart->attributes->profit;
                        @endphp
                          <td class="checkout-total"><strong>Rs<span class="checkout-totals">{{$total }}</span></strong></td>
                        </tr>
                           @endforeach
                      </table>
                      </div>
                      <div class="checkout-total-block">
                        <ul>
                          <li>
                            <em>Sub total</em>
                            <strong class="price">Rs<span id="subtotal-price"></span></strong>
                          </li>
                          <li>
                            <em>Shipping cost</em>
                            <strong  class="price">Rs<span id="shipping-price">250</span></strong>
                          </li>
                          <li class="checkout-total-price">
                            <em>Total</em>
                            <strong class="price">Rs<span id="total-price"></span></strong>
                          </li>
                        </ul>
                      </div>
                      <div class="clearfix"></div>
                      <button class="btn btn-primary pull-right" type="submit" id="button-confirm">Confirm Order</button>
                      <button type="button" class="btn btn-default pull-right margin-right-20">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END CONFIRM -->
            </div>
            <!-- END CHECKOUT PAGE -->

            </form>
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
    function total_cost(){
    let totaldiv = document.getElementsByClassName('checkout-totals');
    
    let subTotal = 0;
    for (let i = 0; i < totaldiv.length; i++) {
       
        let productTotal = totaldiv[i].innerHTML;
        subTotal = subTotal + parseInt(productTotal); 
}
console.log(subTotal)
let shipping = document.getElementById('shipping-price').innerHTML;
    let addShipping = parseInt(shipping) + parseInt(subTotal);
    document.getElementById('subtotal-price').innerHTML = subTotal;
    document.getElementById('total-price').innerHTML = addShipping;
}

total_cost();
</script>
@endsection