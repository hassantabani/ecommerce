<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\PaymentDetails;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Helpers\AuthHelper;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('users.title')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets', 'headerAction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        return view('users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request['password'] = bcrypt($request->password);

        $request['username'] = $request->username ?? stristr($request->email, "@", true) . rand(100,1000);

        $user = User::create($request->all());

        storeMediaFile($user,$request->profile_image, 'profile_image');

        $user->assignRole('user');

        // Save user Profile data...
        $user->userProfile()->create($request->userProfile);

        return redirect()->route('users.index')->withSuccess(__('message.msg_added',['name' => __('users.store')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $profileImage = getSingleMedia($data, 'profile_image');

        return view('users.profile', compact('data', 'profileImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::with('userProfile','roles')->findOrFail($id);

        $data['user_type'] = $data->roles->pluck('id')[0] ?? null;

        $roles = Role::where('status',1)->get()->pluck('title', 'id');

        $user =PaymentDetails::where('user_id',$id)->first();

        $profileImage = getSingleMedia($data, 'profile_image');

        return view('users.form', compact('data','id', 'roles', 'profileImage','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // dd($request->all());
        $user = User::with('userProfile')->findOrFail($id);

        $role = Role::find($request->user_role);
        if(env('IS_DEMO')) {
            if($role->name === 'admin'&& $user->user_type === 'admin') {
                return redirect()->back()->with('error', 'Permission denied');
            }
        }
        $user->assignRole($role->name);

        $request['password'] = $request->password != '' ? bcrypt($request->password) : $user->password;

        // User user data...
        $user->fill($request->all())->update();

        // Save user image...
        if (isset($request->profile_image) && $request->profile_image != null) {
            $user->clearMediaCollection('profile_image');
            $user->addMediaFromRequest('profile_image')->toMediaCollection('profile_image');
        }

        // user profile data....
        $user->userProfile->fill($request->userProfile)->update();

        if(auth()->check()){
            return redirect()->route('users.index')->withSuccess(__('message.msg_updated',['name' => __('message.user')]));
        }
        return redirect()->back()->withSuccess(__('message.msg_updated',['name' => 'My Profile']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $status = 'errors';
        $message= __('global-message.delete_form', ['form' => __('users.title')]);

        if($user!='') {
            $user->delete();
            $status = 'success';
            $message= __('global-message.delete_form', ['form' => __('users.title')]);
        }

        if(request()->ajax()) {
            return response()->json(['status' => true, 'message' => $message, 'datatable_reload' => 'dataTable_wrapper']);
        }

        return redirect()->back()->with($status,$message);

    }

    public function add_payment_method(Request $request){
        $user_id = auth()->user()->id;
        $payment_details = PaymentDetails::where('user_id',$user_id)->first();
        if($payment_details){
            $payment_details->payment_type = $request->payment_type;
            $payment_details->account_name = $request->account_name;
            $payment_details->account_number = $request->account_number;
            $payment_details->update();
         }else{
            PaymentDetails::create([
                'payment_type' => $request->payment_type,
                'account_name' => $request->account_name,
                'user_id'=>$user_id,
                'account_number' => $request->account_number,
            ]);
         }

         return redirect()->back()->with('success','Payment Method updated');
    }

    public function make_withdraw(){
        $totalBookProfit = book::where('user_id', auth()->user()->id)->get()
    ->sum(function ($book) {
        $price = (float) str_replace(',', '', $book->price); // Remove commas if any
        return $price;
    });
        return view('dashboards.make_withdraw',compact('totalBookProfit'));
    }


    public function store_make_withdraw(Request $request){
        $user_id = auth()->user()->id;
        $totalBookProfit = book::where('user_id', $user_id)->get()
    ->sum(function ($book) {
        $price = (float) str_replace(',', '', $book->price); // Remove commas if any
        return $price;
    });

    $allpayment = PaymentRequest::where('user_id',$user_id)->where('status','paid')->sum('amount');
    $total = (float)$totalBookProfit - (float)$allpayment;

    if($total > $request->amount){
        $check = PaymentRequest::where('user_id',$user_id)->where('status','unpaid')->get();
        if($check->count() == 0){
            $payment = PaymentRequest::create([
                'user_id' => $user_id,
                'status' => 'unpaid',
                'amount' => $request->amount,
            ]);
            return redirect()->back()->with('success','Request Sucessfully Submitted');
        }else{
            return redirect()->back()->with('error','Previous Request Not Paid');
        }
    }else{
        return redirect()->back()->with('error','Amount should be equal or less than from your profit');
    }
       
    }


    public function get_all_request(){
        $user = auth()->user();
        if($user->user_type == 'admin'){
            $withdraws = PaymentRequest::all();
        }else{
            $withdraws = PaymentRequest::where('user_id',$user->id)->get();
        }
      return view('dashboards.all_withdraw',compact('withdraws'));
    }


    public function view_withdraw ($id){
        $withdraw = PaymentRequest::find($id);
        if($withdraw){
            $withdraw->user = User::find($withdraw->user_id);
            $withdraw->payment_details = PaymentDetails::where('user_id',$withdraw->user_id)->first();
        }
        return view('dashboards.withdraw_view',compact('withdraw'));
    }


    public function withdraw_status_update(Request $request, $id){
        $withdraw = PaymentRequest::find($id);
        if($withdraw){
            $withdraw->status = $request->status;
            $withdraw->transaction_id = $request->transaction_id;

            if($request->payment_slip){
                $filename = rand('0000000','9999999').'.'.$request->payment_slip->extension();
                $upload = $request->payment_slip->storeAs('payment_slip',$filename,'public');
                $withdraw->payment_slip = 'storage/'.$upload;
            }
            $withdraw->update();
            return redirect()->back()->with('success','Updated Successfully');
        }else{
            return redirect()->back()->with('error','request not found');
        }
    }
}
