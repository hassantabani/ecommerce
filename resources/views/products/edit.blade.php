@push('scripts')

@endpush
<style>
    label{
        display: inline-block;
    font-size: 15px;
    color: black;
    margin-bottom: 5px;
    }
</style>
<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Product</h4>
                        </div>
                    </div>
                    <form action="{{ route('product-update',['id'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body px-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name"  value="{{ $product->name }}"
                                        required>
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Main Image</label>
                                    <input type="file" class="form-control" placeholder="Add Main Image"  value="{{ $product->main_image }}"
                                        name="main_image">
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Category</label>
                                    <select name="category" class="form-control" >
                                        @foreach ($category as $c)
                                        <option value="{{ $c->id }}" @if(old($product->category) == $c->id ) selected @endif>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="col-md-4 mt-2 mb-3">
                                    <label>Purchase Price</label>
                                    <input type="number" class="form-control" name="purchase_price" value="{{ $product->purchase_price }}"
                                        placeholder="Enter Purchase Price" required>
                                </div>
                                <div class="col-md-4 mt-2 mb-3">
                                    <label>Price</label>
                                    <input type="number" class="form-control" name="price" value="{{ $product->price }}"
                                        placeholder="Enter Price" required>
                                </div>
                                <div class="col-md-4 mt-2 mb-3">
                                    <label>Stock</label>
                                    <input type="number" class="form-control" name="stock" value="{{ $product->stock }}"
                                        placeholder="Enter Stock" required>
                                </div>

                                <div class="col-md-12 mt-2 mb-3">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" value=" {{ $product->description }}"
                                        placeholder="Enter Description" required> {{ $product->description }}</textarea>
                                </div>

                                <div class="col-md-12 mt-2 mb-3">
                                    <label>About Product</label>
                                    @if(!empty($product->points))
                                    @foreach (json_decode($product->points) as $key => $value)
                                    <div class="flex" style="display:flex;gap:10px;text-align:center;margin-bottom:8px">
                                        <span style="margin-top: 8px;">{{  (float)$key + 1 }}) </span>
                                        <input type="text" class="form-control" name="points{{ (float)$key + 1 }}" value="{{ $value }}">
                                    </div>
                                    @endforeach
                                  
                                    @endif
                                    
                                </div>

                                <div class="col-md-6 mt-2 mb-3" >
                                    <label>Status</label>
                                    <select name="status" class="form-control" value="{{ old('status') }}">
                                        <option value="1" @if ($product->status == 1)
                                        selected
                                        @endif>Active</option>
                                        <option value="0"  @if ($product->status == 0)
                                        selected
                                        @endif>InActive</option>
                                        </select>
                                </div>
                                
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Have Attributes?</label>
                                    <select name="attribute" id="attribute" class="form-control" value="{{ old('attribute') }}">
                                    <option value=""></option>    
                                    <option value="1"  @if ($product->attribute == 1)
                                        selected
                                        @endif>Yes</option>
                                        <option value="0" @if ($product->attribute == 0)
                                        selected
                                        @endif>No</option>
                                        </select>
                                </div>
                                <div class="col-md-6 mt-2 mb-3" id="size" style="display:none">
                                    <label>Size</label>
                                    <select name="size[]" class="form-control" multiple>
                                       
    @php
        if(isset($product->attribute_items)){
        $size = json_decode($product->attribute_items);
        if(isset($size->size))
            $oldSizes = $size->size;
        }else{
            $oldSizes = old('size', []);
        }
        
    @endphp
    @foreach (['S' => 'Small', 'M' => 'Medium', 'L' => 'Large', 'XL' => 'Extra Large', 'XXL' => 'Double Extra Large'] as $value => $label)
        <option value="{{ $value }}" {{ in_array($value, $oldSizes) ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>
                                </div>
                                <div class="col-md-6 mt-2 mb-3" id="color" style="display:none">
    <label>Color</label>
    <select name="color[]" class="form-control" multiple>
    @php
      if(isset($product->attribute_items)){
        $color = json_decode($product->attribute_items);
        if(isset($color->color))
        $oldColors = $color->color;
        }else{
            $oldColors = old('color', []);
        }
        
       
    @endphp
    <option value="">-- Select Color --</option>
    @foreach (['Red', 'Green', 'Blue', 'Yellow', 'Orange', 'Purple', 'Pink', 'Brown', 'Black', 'White', 'Gray', 'Cyan', 'Magenta', 'Beige', 'Maroon', 'Olive', 'Teal', 'Navy', 'Silver', 'Gold', '0'] as $color)
        <option value="{{ $color }}" {{ in_array($color, $oldColors) ? 'selected' : '' }}>{{ $color == '0' ? 'No' : $color }}</option>
    @endforeach
</select>
</div>


                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Have Sale?</label>
                                    <select name="is_sale" id="sale" class="form-control" value="{{ old('is_sale') }}">
                                    <option value=""></option>       
                                    <option value="1" @if ($product->is_sale == 1)
                                        selected
                                        @endif>Yes</option>
                                        <option value="0" @if ($product->is_sale == 0)
                                        selected
                                        @endif>No</option>
                                        </select>
                                </div>

                                <div class="col-md-6 mt-2 mb-3" id="sale_price" style="display:none">
                                    <label>Sale Price</label>
                                    <input type="number" name="sale_price"  class="form-control" value="{{ $product->sale_price }}" >
                                </div>

                                <button type="submit" class="btn btn-primary" >Save</button>
                            </div>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>

        if({{ $product->is_sale }} == 1){
            document.getElementById('sale_price').style.display = 'block';
        }
        if({{ $product->attribute }} == 1){
            document.getElementById('size').style.display = 'block';
            document.getElementById('color').style.display = 'block';
        }
        let attribute = document.getElementById('attribute');
        let sale = document.getElementById('sale');
        let sale_price = document.getElementById('sale_price');
        let size = document.getElementById('size');
        let color = document.getElementById('color');

        attribute.addEventListener('change',function(){
            let value = attribute.value;
            if(value == 1){
                size.style.display = 'block';
                color.style.display = 'block';
            }else{
                size.style.display = 'none';
                color.style.display = 'none';
            }
        })


        sale.addEventListener('change',function(){
            console.log('hello')
            let value = sale.value;
            if(value == 1){
                console.log(1)
                sale_price.style.display = 'block';
            }else{
                console.log(0)
                sale_price.style.display = 'none';
            }
        })
    </script>
</x-app-layout>
