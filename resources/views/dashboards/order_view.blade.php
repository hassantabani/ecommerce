<x-app-layout :assets="$assets ?? []">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

body {
    background-color: #eeeeee;
    font-family: 'Open Sans', serif
}

.container {
    margin-top: 50px;
    margin-bottom: 50px
}

.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.10rem
}

.card-header:first-child {
    border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
}

.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1)
}

.track {
    position: relative;
    background-color: #ddd;
    height: 7px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 60px;
    margin-top: 50px
}

.track .step {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative
}

.track .step.active:before {
    background: #FF5722
}

.track .step::before {
    height: 7px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px
}

.track .step.active .icon {
    background: #ee5435;
    color: #fff
}

.track .icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    position: relative;
    border-radius: 100%;
    background: #ddd
}

.track .step.active .text {
    font-weight: 400;
    color: #000
}

.track .text {
    display: block;
    margin-top: 7px
}

.itemside {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%
}

.itemside .aside {
    position: relative;
    -ms-flex-negative: 0;
    flex-shrink: 0
}

.img-sm {
    width: 80px;
    height: 80px;
    padding: 7px
}

ul.row,
ul.row-sm {
    list-style: none;
    padding: 0
}

.itemside .info {
    padding-left: 15px;
    padding-right: 7px
}

.itemside .title {
    display: block;
    margin-bottom: 5px;
    color: #212529
}

p {
    margin-top: 0;
    margin-bottom: 1rem
}

.btn-warning {
    color: #ffffff;
    background-color: #ee5435;
    border-color: #ee5435;
    border-radius: 1px
}

.btn-warning:hover {
    color: #ffffff;
    background-color: #ff2b00;
    border-color: #ff2b00;
    border-radius: 1px
}
    </style>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
            <div class="container">
    <article class="card">
        <header class="card-header"> Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: #{{ $order->id }}</h6>
            @if(auth()->user()->user_type == 'admin')
            <div style="display: flex;justify-content:end;gap:10px">
            <div style="display: flex;justify-content:space-between">
                <form action="{{ route('order-status-update',['id'=>$order->id]) }}" method="post">
                    @csrf
                        <select name = 'update_status' id="update_status" style="width:200px;padding: 0.5rem 1rem;font-weight: 400;line-height: 1.5;color: #8A92A6;background-color: #fff;background-clip: padding-box;border: 1px solid #eee;appearance: none;border-radius: 0.25rem;box-shadow: 0 0 0 0;transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                            <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                            <option value="inprocess" @if($order->status == 'inprocess') selected @endif>Inprocess</option>
                            <option value="deliver" @if($order->status == 'deliver') selected @endif>Delivered</option>
                            <option value="reject" @if($order->status == 'reject') selected @endif>Reject</option>
                        </select>

                        <button type="submit" class="btn btn-primary">Save</button>
                </form>
                </div>
                <a href='{{ route('order-print',['id'=>$order->id]) }}' class="btn btn-primary">Print Delivery Slip</a>
                </div>
                <br>
            @endif
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Estimated Delivery time:</strong> <br>{{ \Carbon\Carbon::parse($order->created_at)->addDays(4) }} </div>
                    <div class="col"> <strong>Shipping By:</strong> <br> {{$order->shipping_gateway}}</div>
                    <div class="col"> <strong>Status:</strong> <br> {{$order->status}} </div>
                    <div class="col"> <strong>Payment #:</strong> <br> {{$order->payment_method}} </div>
                    <div class="col"> <strong>Tracking status #:</strong> <br> {{ $order->order_tracking }} </div>
                    <div class="col"> <strong>Tracking #:</strong> <br> {{ $order->tracking_id }} </div>
                </div>
            </article>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Customer Name:</strong> <br>{{ $order->customer_fname }} {{ $order->customer_lname }}</div>
                    <div class="col"> <strong>Customer Phone Number:</strong> <br> {{ $order->customer_number }}</div>
                    <div class="col"> <strong>Customer Extra Details:</strong> <br> {{$order->extra_customer_details}} </div>
                    <div class="col"> <strong>Customer Shipping Address</strong> <br> {{$order->customer_address1}} {{$order->customer_address2}}, {{$order->customer_city}}, {{$order->postal_code}}, {{$order->customer_province}}, {{$order->customer_country}}</div>
                </div>
            </article>
            <div class="track">
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
            </div>
            <hr>
            <p>Delivery Comment: {{ $order->extra_shipping_details }}</p>
            <br>
            <ul class="row">
                @if(json_decode($order->cart_items))
                @foreach(json_decode($order->cart_items) as $o)
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="{{ asset($o->image) }}" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title">{{ $o->product_name }} <br>@if(isset($o->attributes)) Color: {{ $o->attributes->color  }} Size: {{ $o->attributes->size  }}@endif<br> Quantity: {{ $o->quantity }}</p><span class="text-muted">Price: Rs {{ $o->price}} </span><br> <span class="text-muted">Profit: Rs {{ $o->profit}} </span><br><span class="text-muted">Total: Rs {{ ((float)$o->price * (float)$o->quantity) + (float)$o->profit }} </span>
                        </figcaption>
                    </figure>
                </li>
                @endforeach
                @endif
                
            </ul>
            <hr>
           <div class="ml-auto" style="display: flex;justify-content: end;">
            <table>
                <tbody>
                    <tr>
                        <td style="width:180px">Subtotal</td>
                        <td>Rs {{ $order->admin_cost }}</td>
                    </tr>
                    <tr>
                        <td style="width:180px">Profit</td>
                        <td>Rs {{ $order->user_profit }}</td>
                    </tr>
                    <tr>
                        <td style="width:180px">Shipping Cost</td>
                        <td>Rs {{ $order->shipping_cost }}</td>
                    </tr>
                    <tr>
                        <td style="width:180px;font-size:17px;font-weight:900">Total</td>
                        <td style="font-size:17px;font-weight:900">Rs {{ $order->total_price }}</td>
                    </tr>
                </tbody>
            </table>
           </div>
        </div>
    </article>
</div>
            </div>
        </div>
    </div>
</x-app-layout>