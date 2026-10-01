@extends("layouts.websitelayout")
@section('content')
<style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');


        .center-wrapper {
   
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    padding: 2rem;
    overflow: hidden;
}

        .card {
            border: none
        }

        .logo {
            background-color: #eeeeeea8
        }

        .totals tr td {
            font-size: 13px
        }

        .footer {
            background-color: #eeeeeea8
        }

        .footer span {
            font-size: 12px
        }

        .product-qty span {
            font-size: 12px;
            color: #dedbdb
        }
    </style>

    <div class="center-wrapper">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">

                <div class="card">


                    <div class="text-center logo p-2 px-5">

                      <h3 style="font-size: 65px;font-weight: 900;font-family: inherit;">Thank You!</h3>


                    </div>

                    <div class="invoice p-5">

                        <h5 style="font-size: 25px;">Your order Confirmed!</h5>
                        @php
                            $user = App\Models\User::find($order->user_id);
                        @endphp
                        <span class="font-weight-bold d-block mt-4" style="font-size: 18px;font-weight:bold;">Hello {{$user->username}}, </span>
                        <span style="font-size: 16px;">You order has been confirmed and will be shipped in next two days!</span>
                        <br>
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <br>
                            <table class="table table-borderless">

                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2">

                                                <span class="d-block text-muted">Order Date</span>
                                                <span>{{ date($order->created_at) }}</span>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="py-2">

                                                <span class="d-block text-muted">Order No#</span>
                                                <span>{{ $order->id}}</span>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="py-2">

                                                <span class="d-block text-muted">Payment</span>
                                                <span>{{ $order->payment_method }}</span>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="py-2">

                                                <span class="d-block text-muted">Shiping Address</span>
                                                <span>{{ $order->customer_address1 }} {{ $order->customer_address2 }}, {{ $order->customer_city }}, {{ $order->postal_code }}, {{ $order->customer_province }} , {{ $order->customer_country }}</span>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>





                        </div>




                        <div class="product border-bottom table-responsive">

                            <table class="table table-borderless">
                                <tr>
                                    <th >Image</th>
                                    <th >Name</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Profit</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                <tbody>
                                    @foreach (json_decode($order->cart_items) as $c)
                                    @php
                                        $product = App\Models\Products::find($c->product_id);
                                    @endphp
                                    
                                    <tr>
                                        <td width="20%">

                                            <img src="{{ asset($product->main_image)  }}" width="40px">

                                        </td>

                                        <td width="20%">
                                            <span class="font-weight-bold">{{ $product->name }}</span>
                                            <div class="product-qty">
                                                <span class="d-block">Quantity: {{ $c->quantity }}</span>
                                                <span>Color:{{ $c->attributes->color }} Size:{{ $c->attributes->size }}</span>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right">
                                                <span class="font-weight-bold">Rs {{ $c->price }}</span>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right">
                                                <span class="font-weight-bold">Rs {{ $c->profit }}</span>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right">
                                                <span class="font-weight-bold">Rs {{ ($c->quantity*$c->price) +  $c->profit}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    


                                    
                                </tbody>

                            </table>



                        </div>



                        <div class="row d-flex justify-content-end" style="justify-content: end;display: flex;">

                            <div class="col-md-5">

                                <table class="table table-borderless">

                                    <tbody class="totals">

                                        <tr>
                                            <td>
                                                <div class="text-left">

                                                    <span class="text-muted">Subtotal</span>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <span>Rs {{ (float)$order->admin_cost + (float)$order->user_profit}}</span>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>
                                                <div class="text-left">

                                                    <span class="text-muted">Shipping Fee</span>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <span>Rs {{ $order->shipping_cost }}</span>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left">

                                                    <span class="font-weight-bold">Total</span>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <span class="font-weight-bold">Rs {{ $order->total_price }}</span>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>



                        </div>


                        <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                        <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                        <span>Nike Team</span>





                    </div>




                </div>

            </div>

        </div>

    </div>
    </div>

<br>
<br>

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

@endsection