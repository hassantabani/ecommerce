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
                    <form action="{{ route('product-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body px-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name"  value="{{ old('name') }}"
                                        required>
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Main Image</label>
                                    <input type="file" class="form-control" placeholder="Add Main Image"  value="{{ old('main_image') }}"
                                        name="main_image" required>
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Category</label>
                                    <select name="category" class="form-control" >
                                        @foreach ($category as $c)
                                        <option value="{{ $c->id }}" @if(old('category') == $c->id ) selected @endif>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Related Media (png,jpg,mp4)</label>
                                    <input type="file" class="form-control" name="more_media[]"  value="{{ old('more_media[]') }}"
                                        placeholder="Add Related Media" required multiple>
                                </div>
                                <div class="col-md-4 mt-2 mb-3">
                                    <label>Purchase Price</label>
                                    <input type="number" class="form-control" name="purchase_price" value="{{ old('purchase_price') }}"
                                        placeholder="Enter Purchase Price" required>
                                </div>
                                <div class="col-md-4 mt-2 mb-3">
                                    <label>Price</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price') }}"
                                        placeholder="Enter Price" required>
                                </div>
                                <div class="col-md-4 mt-2 mb-3">
                                    <label>Stock</label>
                                    <input type="number" class="form-control" name="stock" value="{{ old('stock') }}"
                                        placeholder="Enter Stock" required>
                                </div>

                                <div class="col-md-12 mt-2 mb-3">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" value="{{ old('description') }}"
                                        placeholder="Enter Description" required> {{ old('description') }}</textarea>
                                </div>

                                <div class="col-md-12 mt-2 mb-3">
                                    <label>About Product</label>
                                    <div class="flex" style="display:flex;gap:10px;text-align:center;margin-bottom:8px">
                                        <span style="margin-top: 8px;">1) </span>
                                        <input type="text" class="form-control" name="points1" value="{{ old('points1') }}">
                                    </div>
                                    <div class="flex" style="display:flex;gap:10px;text-align:center;margin-bottom:8px">
                                        <span style="margin-top: 8px;">2) </span>
                                        <input type="text" class="form-control" name="points2" value="{{ old('points2') }}">
                                    </div>
                                    <div class="flex" style="display:flex;gap:10px;text-align:center;margin-bottom:8px">
                                        <span style="margin-top: 8px;">3) </span>
                                        <input type="text" class="form-control" name="points3" value="{{ old('points3') }}">
                                    </div>
                                    <div class="flex" style="display:flex;gap:10px;text-align:center;margin-bottom:8px">
                                        <span style="margin-top: 8px;">4) </span>
                                        <input type="text" class="form-control" name="points4" value="{{ old('points4') }}">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2 mb-3" >
                                    <label>Status</label>
                                    <select name="status" class="form-control" value="{{ old('status') }}">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                        </select>
                                </div>

                                <div class="col-md-6 mt-2 mb-3">
                                    <label>Have Attributes?</label>
                                    <select name="attribute" id="attribute" class="form-control" value="{{ old('attribute') }}">
                                    <option value=""></option>    
                                    <option value="1">Yes</option>
                                        <option value="0">No</option>
                                        </select>
                                </div>
                                <div class="col-md-6 mt-2 mb-3" id="size" style="display:none">
                                    <label>Size</label>
                                    <select name="size[]" class="form-control" multiple>
    @php
        $oldSizes = old('size', []);
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
        $oldColors = old('color', []);
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
                                    <option value="1">Yes</option>
                                        <option value="0">No</option>
                                        </select>
                                </div>

                                <div class="col-md-6 mt-2 mb-3" id="sale_price" style="display:none">
                                    <label>Sale Price</label>
                                    <input type="number" name="sale_price"  class="form-control" value="{{ old('sale_price') }}" >
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
