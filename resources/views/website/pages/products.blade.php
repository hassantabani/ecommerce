@extends("layouts.websitelayout")
@section('content')
<style>
  .image_size{
    height: 220px !important;
    width: 200px !important;
  }
</style>
<div class="title-wrapper">
      <div class="container"><div class="container-inner">
        @if(isset($category))
        <h1><span>{{ $category->name }}</span> CATEGORY</h1>
        @else
        <h1><span>All Products</span></h1>
        @endif
       
       
      </div></div>
    </div>

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">Men category</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
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
          <div class="col-md-9 col-sm-7">
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href="javascript:;"><i class="fa fa-th-large"></i></a>
                <a href="javascript:;"><i class="fa fa-th-list"></i></a>
              </div>
              <div class="col-md-10 col-sm-10">
                <!-- <div class="pull-right">
                  <label class="control-label">Sort&nbsp;By:</label>
                  <select class="form-control input-sm">
                    <option value="#?sort=p.sort_order&amp;order=ASC" selected="selected">Default</option>
                    <option value="#?sort=pd.name&amp;order=ASC">Name (A - Z)</option>
                    <option value="#?sort=pd.name&amp;order=DESC">Name (Z - A)</option>
                    <option value="#?sort=p.price&amp;order=ASC">Price (Low &gt; High)</option>
                    <option value="#?sort=p.price&amp;order=DESC">Price (High &gt; Low)</option>
                    <option value="#?sort=rating&amp;order=DESC">Rating (Highest)</option>
                    <option value="#?sort=rating&amp;order=ASC">Rating (Lowest)</option>
                    <option value="#?sort=p.model&amp;order=ASC">Model (A - Z)</option>
                    <option value="#?sort=p.model&amp;order=DESC">Model (Z - A)</option>
                  </select>
                </div> -->
              </div>
            </div>
            <!-- BEGIN PRODUCT LIST -->

          
            <div class="row product-list">
              <!-- PRODUCT ITEM START -->
              @if(!empty($products))
              @foreach ($products as $product)
              <div class="col-md-4 col-sm-6 col-xs-12">
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
              <!-- PRODUCT ITEM END -->
              @endforeach
              @endif
            
            </div>
           
            <!-- BEGIN PAGINATOR -->
            <div class="row">
            {{ $products->links() }}
            </div>
            <!-- END PAGINATOR -->
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

@endsection