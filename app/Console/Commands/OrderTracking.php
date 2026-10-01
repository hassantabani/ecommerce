<?php

namespace App\Console\Commands;

use App\Models\book;
use App\Models\Order;
use Illuminate\Console\Command;

class OrderTracking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:tracking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $token = $this->getToken();
        $orders = Order::where('status','!=','deliver')->get();
        $curl = curl_init();
        foreach($orders as $o){
            $data = [
                'tracking_no' => $o->tracking_id
                    ];
                
                
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://dev.digidokaan.pk/api/v1/digidokaan/get-order-tracking',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => $data,
                      CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer {$token}"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
                    $response = json_decode($response);

                    if($response->code == '200'){
                        $o->order_tracking = $response->status;
                        
                        if($response->status == 'Delivered'){
                            $book = book::where('order_id',$o->id)->where('user_id',$o->user_id)->first();
                            if($book){
                                $book->price = $o->user_profit;
                            }else{
                                book::create([
                                    'price' => $o->user_profit,
                                    'order_id' => $o->id,
                                    'user_id' => $o->user_id
                                ]);
                            }
                            $o->status = 'deliver';
                        }else if($response->status == 'Returned'){
                            $book = book::where('order_id',$o->id)->where('user_id',$o->user_id)->first();
                            if($book){
                                $book->price = '-'.$o->shipping_cost;
                            }else{
                                book::create([
                                    'price' => '-'.$o->shipping_cost,
                                    'order_id' => $o->id,
                                    'user_id' => $o->user_id
                                ]);
                            }
                        }
                        $o->update();
                    }
                    sleep(10);
        }
       
    }

    public function getToken()
    {
    $phone = '923123456789';
    $password = '12345678';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://dev.digidokaan.pk/api/v1/digidokaan/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('phone' => $phone, 'password' => $password),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $token = $response->token;
        return $token;
    }
}
