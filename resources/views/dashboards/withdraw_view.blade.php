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
        <header class="card-header"> Withdraw Request </header>
        <div class="card-body">
            <h6>Withdraw ID: #{{ $withdraw->id }}</h6>
           <br>
           @if(auth()->user()->user_type == 'admin')
            <div>
            <div >
                <form action="{{ route('withdraw-status-update',['id'=>$withdraw->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>Status:</label>
                        <select name = 'status' id="update_status" style="width:200px;padding: 0.5rem 1rem;font-weight: 400;line-height: 1.5;color: #8A92A6;background-color: #fff;background-clip: padding-box;border: 1px solid #eee;appearance: none;border-radius: 0.25rem;box-shadow: 0 0 0 0;transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;">
                            <option value="paid" @if($withdraw->status == 'paid') selected @endif>Paid</option>
                            <option value="unpaid" @if($withdraw->status == 'unpaid') selected @endif>Unpaid</option>
                        </select>
                        </div>
                        <div class="col-md-4">
                        <label>Transaction Id:</label>
                        <input type="text" name="transaction_id" value="{{ $withdraw->transaction_id }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                        <label>Payment Slip:</label>
                        <input type="file" name="payment_slip" value="{{ $withdraw->payment_slip }}" class="form-control">
                        </div>
                    </div>
                       



                        <button type="submit" class="btn btn-primary">Save</button>
                </form>
                </div>
              
                </div>

                @endif
                <br>

                <article class="card">
                <div class="card-body row">
                <div class="col"> <strong>Username:</strong> <br>{{$withdraw->user->username}}</div>
                    <div class="col"> <strong>Payment Type:</strong> <br>{{$withdraw->payment_details->payment_type}}</div>
                    <div class="col"> <strong>Account Name:</strong> <br> {{$withdraw->payment_details->account_name}}</div>
                    <div class="col"> <strong>Account Number:</strong> <br> {{ $withdraw->payment_details->account_number}} </div>
                </div>
            </article>
           
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Amount:</strong> <br>Rs {{$withdraw->amount}}</div>
                    <div class="col"> <strong>Status:</strong> <br> {{$withdraw->status}}</div>
                    <div class="col"> <strong>Requested Date:</strong> <br> {{ \Carbon\Carbon::parse($withdraw->created_at) }} </div>
                </div>
            </article>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Trasanction Id:</strong> <br>{{$withdraw->transaction_id}}</div>
                    
                </div>
            </article>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Payment slip:</strong> <br>
                @if(!empty($withdraw->payment_slip))
                <img src="{{ asset($withdraw->payment_slip) }}" style="width: 400px;height:400px;">
                @endif
                </div>
                   
                </div>
            </article>
            
           
         
        </div>
    </article>
</div>
            </div>
        </div>
    </div>
</x-app-layout>