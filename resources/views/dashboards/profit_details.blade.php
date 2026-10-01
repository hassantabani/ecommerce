@push('scripts')

@endpush

<x-app-layout :assets="$assets ?? []">
<div>
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Orders List</h4>
               </div>
            </div>
            <div class="card-body px-0">
               <div class="table-responsive">
                 <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                     <thead>
                        <tr class="ligth">
                        <th class="text-center">Order Id</th>
                           <th class="text-center">Profit</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td class="text-center"><a href="{{ route('view-order',['id'=>$book->order_id]) }}">#{{ $book->order_id }}</a></td>
                           <td class="text-center">{{ $book->price }}</td>
                        </tr>
                        @endforeach
                       
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</x-app-layout>