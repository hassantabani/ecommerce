<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /*
     * Dashboard Pages Routs
     */
    public function index(Request $request)
    {
        $assets = ['chart', 'animation'];
        $user = auth()->user()->user_type;
        if($user == 'admin'){
            $orders = Order::select(
                'status',
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_price) as total_sales'),
                DB::raw('SUM(user_profit) as total_user_profit'),
                DB::raw('SUM(total_purchase) as total_purchase')
            )
            ->groupBy('status')
            ->get()
            ->keyBy('status');
            
            // Totals regardless of status
            $totalOrders = Order::count();
            $totalSales = Order::sum('total_price');
            $totalUserProfit = Order::sum('user_profit');
            $totalProfit = Order::sum('total_purchase'); // assuming this is what you meant
            
            // Helper to fetch safely from grouped data
            $get = fn($status, $key) => $orders[$status][$key] ?? 0;
            
            $totalpendingorders = $get('pending', 'total_orders');
            $totalinprocessorders = $get('inprocess', 'total_orders');
            $totaldeliverorders = $get('deliver', 'total_orders');
            $totalrejectorders = $get('reject', 'total_orders');
            
            $totalpendingsales = $get('pending', 'total_sales');
            $totalinprocesssales = $get('inprocess', 'total_sales');
            $totaldeliversales = $get('deliver', 'total_sales');
            $totalrejectsales = $get('reject', 'total_sales');
            
            $totalpendingUserProfit = $get('pending', 'total_user_profit');
            $totalinprocessUserProfit = $get('inprocess', 'total_user_profit');
            $totaldeliverUserProfit = $get('deliver', 'total_user_profit');
            $totalrejectUserProfit = $get('reject', 'total_user_profit');
            
            $totalpendingProfit = $get('pending', 'total_purchase');
            $totalinprocessProfit = $get('inprocess', 'total_purchase');
            $totaldeliverProfit = $get('deliver', 'total_purchase');
            $totalrejectProfit = $get('reject', 'total_purchase');

            $dateWiseSales = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
    ->groupBy(DB::raw('DATE(created_at)'))
    ->orderBy('date', 'ASC')
    ->get();

$salesDates = $dateWiseSales->pluck('date');
$salesAmounts = $dateWiseSales->pluck('total');


$totalproduct = Products::count();
$topUsers = Order::select('user_id', DB::raw('COUNT(*) as total_orders'),  DB::raw('SUM(total_price) as total_sales'))
    ->groupBy('user_id')
    ->orderByDesc('total_orders')
    ->with('user') // optional, if you want to eager-load user details
    ->limit(2)
    ->get();
            

    $categorySales = [];

$orders = Order::all();

foreach ($orders as $order) {
    $cartItems = json_decode($order->cart_items);

    foreach ($cartItems as $item) {
        $product = Products::find($item->product_id);

        if ($product && $product->category) {
            $categoryId = $product->category;
            $categorySales[$categoryId] = ($categorySales[$categoryId] ?? 0) + 1;
        }
    }
}

// Sort the sales in descending order
arsort($categorySales);

// Get top 5 category IDs
$topCategoryIds = array_slice(array_keys($categorySales), 0, 5);

// Get category models
$topCategories = Category::whereIn('id', $topCategoryIds)->get()->keyBy('id');


            return view('dashboards.dashboard', compact(
                'assets',
                'totalOrders', 'totalpendingorders', 'totalinprocessorders', 'totaldeliverorders', 'totalrejectorders',
                'totalSales', 'totalpendingsales', 'totalinprocesssales', 'totaldeliversales', 'totalrejectsales',
                'totalUserProfit', 'totalpendingUserProfit', 'totalinprocessUserProfit', 'totaldeliverUserProfit', 'totalrejectUserProfit',
                'totalProfit', 'totalpendingProfit', 'totalinprocessProfit', 'totaldeliverProfit', 'totalrejectProfit', 'salesDates', 'salesAmounts',
                'totalproduct','topUsers','topCategories','categorySales','topCategoryIds'
            ));
        }else if($user == 'user'){

            $orders = Order::select(
                'status',
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_price) as total_sales'),
                DB::raw('SUM(user_profit) as total_user_profit'),
                DB::raw('SUM(total_purchase) as total_purchase')
            )
            ->where('user_id',auth()->user()->id)
            ->groupBy('status')
            ->get()
            ->keyBy('status');
            
            // Totals regardless of status
            $totalOrders = Order::where('user_id',auth()->user()->id)->count();
            $totalSales = Order::where('user_id',auth()->user()->id)->sum('total_price');
            $totalUserProfit = Order::where('user_id',auth()->user()->id)->sum('user_profit');
            
            // Helper to fetch safely from grouped data
            $get = fn($status, $key) => $orders[$status][$key] ?? 0;
            
            $totalpendingorders = $get('pending', 'total_orders');
            $totalinprocessorders = $get('inprocess', 'total_orders');
            $totaldeliverorders = $get('deliver', 'total_orders');
            $totalrejectorders = $get('reject', 'total_orders');
            
            $totalpendingsales = $get('pending', 'total_sales');
            $totalinprocesssales = $get('inprocess', 'total_sales');
            $totaldeliversales = $get('deliver', 'total_sales');
            $totalrejectsales = $get('reject', 'total_sales');
            
            $totalpendingUserProfit = $get('pending', 'total_user_profit');
            $totalinprocessUserProfit = $get('inprocess', 'total_user_profit');
            $totaldeliverUserProfit = $get('deliver', 'total_user_profit');
            $totalrejectUserProfit = $get('reject', 'total_user_profit');
         
            $dateWiseSales = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')->where('user_id',auth()->user()->id)
    ->groupBy(DB::raw('DATE(created_at)'))
    ->orderBy('date', 'ASC')
    ->get();

$salesDates = $dateWiseSales->pluck('date');
$salesAmounts = $dateWiseSales->pluck('total');


$totalproduct = Products::count();

            

    $categorySales = [];

$orders = Order::where('user_id',auth()->user()->id)->get();

foreach ($orders as $order) {
    $cartItems = json_decode($order->cart_items);

    foreach ($cartItems as $item) {
        $product = Products::find($item->product_id);

        if ($product && $product->category) {
            $categoryId = $product->category;
            $categorySales[$categoryId] = ($categorySales[$categoryId] ?? 0) + 1;
        }
    }
}

// Sort the sales in descending order
arsort($categorySales);

// Get top 5 category IDs
$topCategoryIds = array_slice(array_keys($categorySales), 0, 5);

// Get category models
$topCategories = Category::whereIn('id', $topCategoryIds)->get()->keyBy('id');

$totalBookProfit = Book::where('user_id', auth()->user()->id)->get()
    ->sum(function ($book) {
        $price = (float) str_replace(',', '', $book->price); // Remove commas if any
        return $price;
    });

            return view('dashboards.userDashboard', compact('assets','totalOrders', 'totalpendingorders', 'totalinprocessorders', 'totaldeliverorders', 'totalrejectorders',
                'totalSales', 'totalpendingsales', 'totalinprocesssales', 'totaldeliversales', 'totalrejectsales',
                'totalUserProfit', 'totalpendingUserProfit', 'totalinprocessUserProfit', 'totaldeliverUserProfit', 'totalrejectUserProfit',
               'salesDates', 'salesAmounts',
                'totalproduct','topCategories','categorySales','topCategoryIds','totalBookProfit'));
        }else{
            return view('dashboards.scanner', compact('assets'));
        }
        
    }

    /*
     * Menu Style Routs
     */
    public function horizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.horizontal',compact('assets'));
    }
    public function dualhorizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-horizontal',compact('assets'));
    }
    public function dualcompact(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-compact',compact('assets'));
    }
    public function boxed(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed',compact('assets'));
    }
    public function boxedfancy(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed-fancy',compact('assets'));
    }

    /*
     * Pages Routs
     */
    public function billing(Request $request)
    {
        return view('special-pages.billing');
    }

    public function calender(Request $request)
    {
        $assets = ['calender'];
        return view('special-pages.calender',compact('assets'));
    }

    public function kanban(Request $request)
    {
        return view('special-pages.kanban');
    }

    public function pricing(Request $request)
    {
        return view('special-pages.pricing');
    }

    public function rtlsupport(Request $request)
    {
        return view('special-pages.rtl-support');
    }

    public function timeline(Request $request)
    {
        return view('special-pages.timeline');
    }


    /*
     * Widget Routs
     */
    public function widgetbasic(Request $request)
    {
        return view('widget.widget-basic');
    }
    public function widgetchart(Request $request)
    {
        $assets = ['chart'];
        return view('widget.widget-chart', compact('assets'));
    }
    public function widgetcard(Request $request)
    {
        return view('widget.widget-card');
    }

    /*
     * Maps Routs
     */
    public function google(Request $request)
    {
        return view('maps.google');
    }
    public function vector(Request $request)
    {
        return view('maps.vector');
    }

    /*
     * Auth Routs
     */
    public function signin(Request $request)
    {
        return view('auth.login');
    }
    public function signup(Request $request)
    {
        return view('auth.register');
    }
    public function confirmmail(Request $request)
    {
        return view('auth.confirm-mail');
    }
    public function lockscreen(Request $request)
    {
        return view('auth.lockscreen');
    }
    public function recoverpw(Request $request)
    {
        return view('auth.recoverpw');
    }
    public function userprivacysetting(Request $request)
    {
        return view('auth.user-privacy-setting');
    }

    /*
     * Error Page Routs
     */

    public function error404(Request $request)
    {
        return view('errors.error404');
    }

    public function error500(Request $request)
    {
        return view('errors.error500');
    }
    public function maintenance(Request $request)
    {
        return view('errors.maintenance');
    }

    /*
     * uisheet Page Routs
     */
    public function uisheet(Request $request)
    {
        return view('uisheet');
    }

    /*
     * Form Page Routs
     */
    public function element(Request $request)
    {
        return view('forms.element');
    }

    public function wizard(Request $request)
    {
        return view('forms.wizard');
    }

    public function validation(Request $request)
    {
        return view('forms.validation');
    }

     /*
     * Table Page Routs
     */
    public function bootstraptable(Request $request)
    {
        return view('table.bootstraptable');
    }

    public function datatable(Request $request)
    {
        return view('table.datatable');
    }

    /*
     * Icons Page Routs
     */

    public function solid(Request $request)
    {
        return view('icons.solid');
    }

    public function outline(Request $request)
    {
        return view('icons.outline');
    }

    public function dualtone(Request $request)
    {
        return view('icons.dualtone');
    }

    public function colored(Request $request)
    {
        return view('icons.colored');
    }

    /*
     * Extra Page Routs
     */
    public function privacypolicy(Request $request)
    {
        return view('privacy-policy');
    }
    public function termsofuse(Request $request)
    {
        return view('terms-of-use');
    }
   
}
