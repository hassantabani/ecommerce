<x-app-layout :assets="$assets ?? []">
   <div>
      <?php
$id = $id ?? null;
      ?>
      @if(isset($id))
        {!! Form::model($data, ['route' => ['users.update', $id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
     @else
        {!! Form::open(['route' => ['users.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
     @endif
      <div class="row">
         <div class="col-xl-3 col-lg-4">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">{{$id !== null ? 'Update' : 'Add' }} User</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="form-group">
                     <div class="profile-img-edit position-relative">
                        <img src="{{ $profileImage ?? asset('images/avatars/01.png')}}" alt="User-Profile"
                           class="profile-pic rounded avatar-100">
                        <div class="upload-icone bg-primary">
                           <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                              <path fill="#ffffff"
                                 d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                           </svg>
                           <input class="file-upload" type="file" accept="image/*" name="profile_image">
                        </div>
                     </div>
                     <div class="img-extension mt-3">
                        <div class="d-inline-block align-items-center">
                           <span>Only</span>
                           <a href="javascript:void();">.jpg</a>
                           <a href="javascript:void();">.png</a>
                           <a href="javascript:void();">.jpeg</a>
                           <span>allowed</span>
                        </div>
                     </div>
                  </div>
                  @if(auth()->user()->user_type == 'admin')
                 <div class="form-group">
                   <label class="form-label">Status:</label>
                   <div class="grid" style="--bs-gap: 1rem">
                     <div class="form-check g-col-6">
                        {{ Form::radio('status', 'active', old('status') || true, ['class' => 'form-check-input', 'id' => 'status-active'])}}
                        <label class="form-check-label" for="status-active">
                          Active
                        </label>
                     </div>
                     <div class="form-check g-col-6">
                        {{ Form::radio('status', 'pending', old('status'), ['class' => 'form-check-input', 'id' => 'status-pending']) }}
                        <label class="form-check-label" for="status-pending">
                          Pending
                        </label>
                     </div>
                     <div class="form-check g-col-6">
                        {{ Form::radio('status', 'banned', old('status'), ['class' => 'form-check-input', 'id' => 'status-banned']) }}
                        <label class="form-check-label" for="status-banned">
                          Banned
                        </label>
                     </div>
                     <div class="form-check g-col-6">
                        {{ Form::radio('status', 'inactive', old('status'), ['class' => 'form-check-input', 'id' => 'status-inactive']) }}
                        <label class="form-check-label" for="status-inactive">
                          Inactive
                        </label>
                     </div>
                   </div>
                 </div>
              @endif
               </div>
            </div>
         </div>
         <div class="col-xl-9 col-lg-8">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">{{$id !== null ? 'Update' : 'New' }} User Information</h4>
                  </div>
                  <div class="card-action">
                     <a href="{{route('users.index')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                  </div>
               </div>
               <div class="card-body">
                  <div class="new-user-info">
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label class="form-label" for="fname">First Name: <span class="text-danger">*</span></label>
                           {{ Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First Name', 'required']) }}
                        </div>
                        <div class="form-group col-md-6">
                           <label class="form-label" for="lname">Last Name: <span class="text-danger">*</span></label>
                           {{ Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name', 'required']) }}
                        </div>
                        <div class="form-group col-md-12">
                           <label class="form-label" for="uname">User Name: <span class="text-danger">*</span></label>
                           {{ Form::text('username', old('username'), ['class' => 'form-control', 'required', 'placeholder' => 'Enter Username']) }}
                        </div>
                        <div class="form-group col-md-6">
                           <label class="form-label" for="mobno">Mobile Number:</label>
                           {{ Form::text('userProfile[phone_number]', old('userProfile[phone_number]'), ['class' => 'form-control', 'id' => 'mobno', 'placeholder' => 'Mobile Number']) }}
                        </div>

                        <div class="form-group col-md-6">
                           <label class="form-label" for="email">Email: <span class="text-danger">*</span></label>
                           {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter e-mail', 'required']) }}
                        </div>
                     </div>
                     <hr>
                     <h5 class="mb-3">Security</h5>
                     <div class="row">

                        <div class="form-group col-md-6">
                           <label class="form-label" for="pass">Password:</label>
                           {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                        </div>
                        <div class="form-group col-md-6">
                           <label class="form-label" for="rpass">Repeat Password:</label>
                           {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat Password']) }}
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary">{{$id !== null ? 'Update' : 'Add' }} User</button>
                  </div>

               </div>
            </div>

         </div>
      </div>
      {!! Form::close() !!}
   </div>
   @if ($id !== null)
   
  
   <div class="col-xl-12 col-lg-12">
      <div class="card">
         <div class="card-body">
            <div class="new-user-info">
               <h5 class="mb-3">Payment Method</h5>
               <form method="post" action="{{ route('add-payment-method') }}">
                  @csrf
               <div class="row">
                  
                  <div class="form-group col-md-12">
                     <label class="form-label" for="pass">Payment Type:</label>
                     <select class="form-control" name="payment_type" required>
                        <option value="">Select Payment Method</option>
                        <option value="EasyPaisa" {{ (isset($user) && $user->payment_type == 'EasyPaisa') ? 'selected' : '' }}>EasyPaisa</option>
    <option value="JazzCash" {{ (isset($user) && $user->payment_type == 'JazzCash') ? 'selected' : '' }}>JazzCash</option>
    
    <!-- Major Pakistani Banks -->
    <option value="HBL" {{ (isset($user) && $user->payment_type == 'HBL') ? 'selected' : '' }}>HBL (Habib Bank Limited)</option>
    <option value="UBL" {{ (isset($user) && $user->payment_type == 'UBL') ? 'selected' : '' }}>UBL (United Bank Limited)</option>
    <option value="MCB" {{ (isset($user) && $user->payment_type == 'MCB') ? 'selected' : '' }}>MCB (Muslim Commercial Bank)</option>
    <option value="Allied Bank" {{ (isset($user) && $user->payment_type == 'Allied Bank') ? 'selected' : '' }}>Allied Bank</option>
    <option value="Meezan Bank" {{ (isset($user) && $user->payment_type == 'Meezan Bank') ? 'selected' : '' }}>Meezan Bank</option>
    <option value="Bank Alfalah" {{ (isset($user) && $user->payment_type == 'Bank Alfalah') ? 'selected' : '' }}>Bank Alfalah</option>
    <option value="Faysal Bank" {{ (isset($user) && $user->payment_type == 'Faysal Bank') ? 'selected' : '' }}>Faysal Bank</option>
    <option value="Askari Bank" {{ (isset($user) && $user->payment_type == 'Askari Bank') ? 'selected' : '' }}>Askari Bank</option>
    <option value="Standard Chartered" {{ (isset($user) && $user->payment_type == 'Standard Chartered') ? 'selected' : '' }}>Standard Chartered</option>
    <option value="Summit Bank" {{ (isset($user) && $user->payment_type == 'Summit Bank') ? 'selected' : '' }}>Summit Bank</option>
    <option value="Bank of Punjab" {{ (isset($user) && $user->payment_type == 'Bank of Punjab') ? 'selected' : '' }}>Bank of Punjab (BOP)</option>
    <option value="Bank Islami" {{ (isset($user) && $user->payment_type == 'Bank Islami') ? 'selected' : '' }}>Bank Islami</option>
    <option value="Soneri Bank" {{ (isset($user) && $user->payment_type == 'Soneri Bank') ? 'selected' : '' }}>Soneri Bank</option>
    <option value="Dubai Islamic Bank" {{ (isset($user) && $user->payment_type == 'Dubai Islamic Bank') ? 'selected' : '' }}>Dubai Islamic Bank</option>
    <option value="Al Baraka Bank" {{ (isset($user) && $user->payment_type == 'Al Baraka Bank') ? 'selected' : '' }}>Al Baraka Bank</option>
                     </select>
                  </div>

                  <div class="form-group col-md-6">
                     <label class="form-label" for="rpass">Account Name:</label>
                     <input class="form-control" name="account_name" value="{{ isset($user) ? $user->account_name : '' }}" required>
                  </div>

                  <div class="form-group col-md-6">
                     <label class="form-label" for="rpass">Account Number:</label>
                     <input class="form-control" name="account_number" value="{{ isset($user) ? $user->account_number : '' }}" required>
                  </div>
                  <button type="submit" class="btn btn-primary">{{$id !== null ? 'Update' : 'Add' }} Details</button>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   @endif
   </div>
</x-app-layout>