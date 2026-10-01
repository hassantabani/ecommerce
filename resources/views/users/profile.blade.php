<x-app-layout :assets="$assets ?? []">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="d-flex flex-wrap align-items-center justify-content-between">
                  <div class="d-flex flex-wrap align-items-center">
                     <div class="profile-img position-relative me-3 mb-3 mb-lg-0">
                        <img src="{{ $profileImage ?? asset('images/avatars/01.png')}}" alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill avatar-100">
                        <img src="{{asset('images/avatars/avtar_1.png')}}" alt="User-Profile" class="theme-color-purple-img img-fluid rounded-pill avatar-100">
                        <img src="{{asset('images/avatars/avtar_2.png')}}" alt="User-Profile" class="theme-color-blue-img img-fluid rounded-pill avatar-100">
                        <img src="{{asset('images/avatars/avtar_4.png')}}" alt="User-Profile" class="theme-color-green-img img-fluid rounded-pill avatar-100">
                        <img src="{{asset('images/avatars/avtar_5.png')}}" alt="User-Profile" class="theme-color-yellow-img img-fluid rounded-pill avatar-100">
                        <img src="{{asset('images/avatars/avtar_3.png')}}" alt="User-Profile" class="theme-color-pink-img img-fluid rounded-pill avatar-100">
                     </div>
                     <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                        <h4 class="me-2 h4">{{ $data->full_name ?? 'Austin Robertson'  }}</h4>
                        <span class="text-capitalize"> - {{ str_replace('_',' ',auth()->user()->user_type) ?? 'Marketing Administrator' }}</span>
                     </div>
                  </div>
                  <ul class="d-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab" id="profile-pills-tab" role="tablist">
                   
                     <li class="nav-item">
                        <a class="nav-link active" href="/users/{{ auth()->user()->id }}/edit" >Edit Profile</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
     
      <div class="col-lg-12">
         <div class="profile-content tab-content">
        
         <div id="profile-profile" class="tab-pane active show">
            <div class="card">
               <div class="card-header">
                  <div class="header-title">
                     <h4 class="card-title">Profile</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="text-center">
                     <div class="user-profile">
                        <img src="{{asset('images/avatars/01.png')}}" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                     </div>
                     <div class="mt-3">
                        <h3 class="d-inline-block">{{ auth()->user()->first_name ?? 'Austin Robertson'  }}</h3>
                        
                        <p class="mb-0">Username : {{ auth()->user()->username}}</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <div class="header-title">
                     <h4 class="card-title">About User</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="user-bio">
                     <p>Tart I love sugar plum I love oat cake. Sweet roll caramels I love jujubes. Topping cake wafer.</p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">Joined:</h6>
                  <p>{{date($data->created_at)}}</p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">Phone Number:</h6>
                  <p>{{ $data->phone_number }}</p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">CNIC:</h6>
                  <p><a href="#" class="text-body"> {{ $data->nic_number }}</a></p>
                  </div>
                  <div class="mt-2">
                  <h6 class="mb-1">CNIC Front Image:</h6>
                  <img src="{{ asset($data->nic_front_image) }}">
                  </div>

                  <div class="mt-2">
                  <h6 class="mb-1">CNIC Back Image:</h6>
                  <img src="{{ asset($data->nic_back_image) }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
     
   </div>

   @include('partials.components.share-offcanvas')
</x-app-layout>
