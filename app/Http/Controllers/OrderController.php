<?php
/**
 * Created by PhpStorm.
 * User: stude
 * Date: 21.05.2018
 * Time: 13:32
 */

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Partner;
use App\Product;
use App\Vendor;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class OrderController extends BaseController
{
    public function show()
    {
        $orders = DB::table('orders')
            ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
            ->leftJoin('partners', 'partners.id', '=', 'orders.partner_id')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->select('orders.id',
                'partners.name as partners_name',
                DB::raw('SUM(order_products.price) as price'),
                DB::raw('GROUP_CONCAT(DISTINCT products.name ORDER BY products.name ASC SEPARATOR \' / \') AS names'),
                DB::raw('CASE orders.status
			        WHEN 0 THEN "новый" 
			        WHEN 10 THEN "подтвержден"
			        WHEN 20 THEN "завершен"
			        ELSE "нет статуса"
		        END
		        AS status'))
            ->groupBy('orders.id')->paginate(15);

        return view('order')->with('orders', $orders);
    }

    public function showItem($id)
    {
        $orders = DB::table('orders')
            ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
            ->leftJoin('partners', 'partners.id', '=', 'orders.partner_id')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
            ->select('orders.id',
                'partners.name as partners_name',
                DB::raw('SUM(order_products.price) as price'),
                DB::raw('products.name AS names'),
                'orders.status as status_num',
                DB::raw('vendors.email as email_cli'))
            ->where('orders.id', '=', $id)
            ->groupBy('orders.id', 'products.name', 'vendors.email')->get();

        return view('edit')->with('orders', $orders);
    }

    public function edit(Request $request, $id)
    {
        $count = $request->input('count');

        $orders = DB::table('orders')
            ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
            ->leftJoin('partners', 'partners.id', '=', 'orders.partner_id')
            ->join('products', 'products.id', '=', 'order_products.product_id')
            ->join('vendors', 'vendors.id', '=', 'products.vendor_id')
            ->where('orders.id', '=', $id)
            ->select('orders.id as order_id',
                'order_products.id as order_products_id',
                'partners.id as partners_id',
                'products.id as products_id',
                'vendors.id as vendors_id')
            ->groupBy('orders.id', 'order_products.id', 'partners.id', 'products.id', 'vendors.id')->get();

        for ($i = 0; $i < $count; $i++) {
            $email_cli = $request->input('email_cli_' . $i);
            $names = $request->input('names_' . $i);
            $price = $request->input('price_' . $i);

            $vendor_email = Vendor::find($orders[$i]->vendors_id);
            $vendor_email->email = $email_cli;
            $vendor_email->save();

            $products_name = Product::find($orders[$i]->products_id);
            $products_name->name = $names;
            $products_name->save();

            $order_products_price = OrderProduct::find($orders[$i]->order_products_id);
            $order_products_price->price = $price;
            $order_products_price->save();
        }

        $status_num = $request->input('status_num');
        $order = Order::find($id);
        $order->status = $status_num;
        $order->save();

        $partners_name = $request->input('partners_name');
        $partners = Partner::find($orders[0]->partners_id);
        $partners->name = $partners_name;
        $partners->save();

        return redirect('/order');
    }
}