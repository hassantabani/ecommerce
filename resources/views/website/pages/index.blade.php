@extends("layouts.websitelayout")
@section('content')
@include('website.component.slider')
<style>
  .image_size{
    height: 220px !important;
    width: 200px !important;
  }
</style>
<div class="main">
      <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SALE PRODUCT -->
          <div class="col-md-12 sale-product">
            <h2>New Arrivals</h2>
            <div class="owl-carousel owl-carousel5">
              @if(!empty($latests))
              @foreach ($latests as $product)
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
              @endif
             
              
           
            </div>
          </div>
          <!-- END SALE PRODUCT -->
        </div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 ">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-4">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              @foreach ($categories as $c)
              <li class="list-group-item clearfix"><a href="{{ route('product-categories',['id'=>$c->id]) }}"><i class="fa fa-angle-right"></i> {{ $c->name }}</a></li>
              @endforeach
            </ul>
          </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-8">
            <h2>Most Selling</h2>
            <div class="owl-carousel owl-carousel3">
            @if(!empty($MostSelling))
              @foreach ($MostSelling as $product)
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
              @endif
             
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN TWO PRODUCTS & PROMO -->
        <div class="row margin-bottom-35 ">
          <!-- BEGIN TWO PRODUCTS -->
          <div class="col-md-6 two-items-bottom-items">
            <h2>Most Profitable</h2>
            <div class="owl-carousel owl-carousel2">
            @if(!empty($MostProfitable))
              @foreach ($MostProfitable as $product)
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
              @endif
             
            </div>
          </div>
          <!-- END TWO PRODUCTS -->
          <!-- BEGIN PROMO -->
          <div class="col-md-6 shop-index-carousel">
            <div class="content-slider">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{ asset('assets/pages/img/index-sliders/homef1.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                  </div>
                  <div class="item">
                    <img src="{{ asset('assets/pages/img/index-sliders/homef2.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                  </div>
                  <div class="item">
                    <img src="{{ asset('assets/pages/img/index-sliders/homef3.jpg') }}" class="img-responsive" alt="Berry Lace Dress">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END PROMO -->
        </div>        
        <!-- END TWO PRODUCTS & PROMO -->
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
@endsection