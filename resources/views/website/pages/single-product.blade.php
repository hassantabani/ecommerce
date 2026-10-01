@extends("layouts.websitelayout")
@section('content')
 
<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">{{ $product->name }}</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
            <ul class="list-group margin-bottom-25 sidebar-menu">
             @foreach ($categories as $c)
              <li class="list-group-item clearfix"><a href="{{ route('product-categories',['id'=>$c->id]) }}"><i class="fa fa-angle-right"></i> {{ $c->name }}</a></li>
              @endforeach
            </ul>

           
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="product-main-image">
                    <img src="{{ asset($product->main_image) }}" id="main_image" alt="Cool green dress with red bell" class="img-responsive" data-BigImgsrc="{{ asset($product->main_image) }}">
                  </div>
                  <div class="product-other-images">
                  
                    @foreach (json_decode($product->more_media) as $media)
                    @php
                    $extension = pathinfo($media, PATHINFO_EXTENSION);
                    @endphp
                    @if($extension == 'mp4')
                    <a href="{{ asset($media) }}" class="fancybox-button" rel="photos-lib">
                    <video width="100%" controls>
                    <source src="{{ asset($media) }}" type="video/mp4" class="other_videos">
                        Your browser does not support the video tag.
                            </video>
                    </a>
                    @else
                    <a href="{{ asset($media) }}" class="fancybox-button " rel="photos-lib"><img alt="{{ $product->name }}" class="other_images" src="{{ asset($media) }}"></a>
                    @endif
                    @endforeach
                   
                    


                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <h1>{{ $product->name }}</h1>
                  <div class="price-availability-block clearfix">
                    <div class="price">
                     
                      @if($product->is_sale)
                      <strong><span>Rs</span>{{ $product->sale_price }}</strong>
                      <em>Rs <span>{{ $product->price }}</span></em>
                      @else
                      <strong><span>Rs</span>{{ $product->price }}</strong>
                      @endif
                     
                      <!-- <em>$<span>62.00</span></em> -->
                    </div>
                    <div class="availability">
                        @if($product->stock > 0)
                        Availability: <strong>In Stock</strong>
                        @else
                        Availability: <strong>Out of Stock</strong>
                        @endif
                     
                    </div>
                  </div>
                  <div class="description">
                    <p>{{ $product->description }}</p>
                  </div>
                  <form action="{{ route('website-add-to-cart') }}" method="post">
                    @csrf
                  <div class="row px-4" style="margin: 20px 0;">
                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                  <label style="font-size:15px;">Enter Net Profit :</label>
                  <input id="profit_amount" name="profit_amount" type="number" value="0" placeholder="Enter Profit" class="form-control input-sm" style="height: 40px;">
                  </div>
                  @if($product->attribute == '1')
                  <div class="product-page-options">
                  @php
                        $attributes = json_decode($product->attribute_items)
                      @endphp
                      @if(isset($attributes->size))
                    <div class="pull-left">
                     
                      <label class="control-label">Size:</label>
                      <select class="form-control" id="size" name="size">
                        @foreach($attributes->size as $size) 
                        <option value="{{$size}}">{{$size}}</option>
                        @endforeach
                      </select>
                    </div>
                    @endif
                    @if(isset($attributes->color))
                    <div class="pull-left">
                      <label class="control-label">Color:</label>
                      <select class="form-control " id="color" name="color">
                      @foreach($attributes->color as $color) 
                        <option value="{{$color}}">{{$color}}</option>
                        @endforeach
                      </select>
                    </div>
                    @endif
                  </div>
                  @endif
                  <div class="product-page-cart row">
                    <div class="product-quantity col-md-4">
                        <input id="product-quantity" name="product_quantity" type="text" value="1" readonly class="form-control input-sm">
                    </div>
                   <div class="col-md-8">
                   <button class="btn btn-primary" type="submit">Add to cart</button>
                   </div>
                   </form>      
                  </div>

                  <div class="row">
                    <h5 class="text-danger">Note: Delivery charges will be added on the checkout page.</h5>
  <table style="width: 100%; border-collapse: collapse;">
    <thead>
      <tr>
        <th style="text-align: center; border: none;">Product Name</th>
        <th style="text-align: center; border: none;">Price</th>
        <th style="text-align: center; border: none;">Quantity</th>
        <th style="text-align: center; border: none;">Profit</th>
        <th style="text-align: center; border: none;">Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <td style="text-align: center; border: none;">{{ \Illuminate\Support\Str::limit($product->name, 12) }}</td>
      @if($product->is_sale)
        <td style="text-align: center; border: none;">Rs <span id="price">{{ $product->sale_price }}</span></td>
      @else  
      <td style="text-align: center; border: none;">Rs <span id="price">{{ $product->price }}</span></td>
      @endif
        <td style="text-align: center; border: none;" id="quantity">1</td>
        <td style="text-align: center; border: none;">Rs <span id="profit">0</span></td>
        <td style="text-align: center; border: none;"><span id="total">0</span></td>
      </tr>
    </tbody>
  </table>
</div>
                 
                </div>

                <div class="product-page-content">
                  <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#Description" data-toggle="tab">Description</a></li>
                    <li ><a href="#Information" data-toggle="tab">Information</a></li>
                    <li ><a onclick="download_media()" data-toggle="tab" style="cursor: pointer;">Download Media</a></li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="Description">
                      <p>{{ $product->description }}</p>
                    </div>
                    <div class="tab-pane fade" id="Information">
                      <table class="datasheet">
                        <tr>
                          <th colspan="2">Additional features</th>
                        </tr>
                        @foreach (json_decode($product->points) as $point)
                        <tr>
                          <td class="datasheet-features-type">Value {{ $loop->iteration }}</td>
                          <td>{{$point}}</td>
                        </tr>
                        @endforeach
                       
                        
                      </table>
                    </div>
                    
                  </div>
                </div>

                <div class="sticker sticker-sale"></div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h2>Most popular products</h2>
            <div class="owl-carousel owl-carousel4">
              @foreach ($products as $product)
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{asset($product->main_image)}}" class="img-responsive image_size" alt="{{ $product->name }}">
                    <div>
                      <a href="{{asset($product->main_image)}}" class="btn btn-default fancybox-button">Zoom</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3>
                    <form action="{{ route('website-product') }}" style="margin-bottom:5px">
                      <input type="hidden" name="id" value="{{ $product->id }}">
                      <button type="submit" style="border: none;background: none;margin: 0;padding: 0;">    <b>{{ Str::limit($product->name, 20) }}</b>                      </button>
                    </form>
                  @if($product->is_sale)
                  <div class="pi-price" style="text-decoration: line-through;padding-right: 10px;">Rs {{ $product->price }} </div>
                  <div class="pi-price">  Rs {{ $product->sale_price }}</div>
                  @else 
                  <div class="pi-price">Rs {{ $product->price }}</div>
                  @endif
                  <form action="{{ route('website-product') }}">
                      <input type="hidden" name="id" value="{{ $product->id }}">
                      <button type="submit" class="add2cart" style="float: right;background: none;height: 29px;"><b>Details</b></button>
                    </form>
                  @if($product->is_sale)
                  <div class="sticker sticker-sale"></div>
                  @endif
                
                 
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <!-- END SIMILAR PRODUCTS -->
      </div>
    </div>

    <!-- BEGIN BRANDS -->
    <div class="brands">
      <div class="container">
            <div class="owl-carousel owl-carousel6-brands">
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/canon.jpg" alt="canon" title="canon"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/esprit.jpg" alt="esprit" title="esprit"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/gap.jpg" alt="gap" title="gap"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/next.jpg" alt="next" title="next"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/puma.jpg" alt="puma" title="puma"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/zara.jpg" alt="zara" title="zara"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/canon.jpg" alt="canon" title="canon"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/esprit.jpg" alt="esprit" title="esprit"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/gap.jpg" alt="gap" title="gap"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/next.jpg" alt="next" title="next"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/puma.jpg" alt="puma" title="puma"></a>
              <a href="shop-product-list.html"><img src="assets/pages/img/brands/zara.jpg" alt="zara" title="zara"></a>
            </div>
        </div>
    </div>
    <!-- END BRANDS -->

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
    <!-- END STEPS -->

    <script>
   let input_quantity = document.getElementById('product-quantity');
let price = parseInt(document.getElementById('price').innerHTML) || 0;
let profit_input = document.getElementById('profit_amount');
let quantity_down = document.getElementsByClassName('quantity-down');
let quantity_up = document.getElementsByClassName('quantity-up');
let lastQuantity = input_quantity.value;


console.log(quantity_down);
console.log(quantity_up);
function updateTotal() {
    let profit_value = parseInt(profit_input.value) || 0;
    let quantity_value = parseInt(input_quantity.value) || 1;

    let total = (price * quantity_value) + profit_value;
    document.getElementById('total').innerHTML = "Rs " + total;
    document.getElementById('profit').innerHTML =profit_value;
    document.getElementById('quantity').innerHTML = quantity_value;
}


updateTotal();

profit_input.addEventListener('change', updateTotal);

for (let btn of quantity_down) {
    btn.addEventListener('click', updateTotal);
}


for (let btn of quantity_up) {
    btn.addEventListener('click', updateTotal);
}
setInterval(() => {
        if (input_quantity.value !== lastQuantity) {
            lastQuantity = input_quantity.value;
            updateTotal();
        }
    }, 200);
input_quantity.addEventListener('change', updateTotal);

function download_media() {
    
    const mainImage = document.getElementById('main_image')?.src;
    if (mainImage) {
        downloadFile(mainImage);
    }

  
    const otherImages = document.getElementsByClassName('other_images');
    for (let i = 0; i < otherImages.length; i++) {
        const imgSrc = otherImages[i]?.src;
        if (imgSrc) {
            downloadFile(imgSrc);
        }
    }

   
    const otherVideos = document.getElementsByClassName('other_videos');
    for (let i = 0; i < otherVideos.length; i++) {
        const videoSrc = otherVideos[i]?.src || otherVideos[i]?.getAttribute('src');
        if (videoSrc) {
            downloadFile(videoSrc);
        }
    }
}

function downloadFile(url) {
    const a = document.createElement('a');
    a.href = url;
    a.download = url.split('/').pop(); // filename from URL
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
    </script>
    @endsection