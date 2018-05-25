<?php
/**
 * Created by PhpStorm.
 * User: stude
 * Date: 23.05.2018
 * Time: 0:49
 */

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    protected function query()
    {
        $products = DB::table('products')
            ->select('products.id',
                'products.name as product_name',
                'products.price as price',
                'vendors.name as vendors_name'
            )
            ->leftJoin('vendors', 'products.vendor_id', '=', 'vendors.id');

        return $products;
    }

    public function show()
    {
        $products = self::query()->orderBy('products.id', 'ASC')->paginate(25);

        return view('product')->with('products', $products);
    }

    public function sort($param)
    {
        if (isset($param)) {
            switch ($param) {
                case 0:
                    $products = self::query()->orderBy('products.name', 'ASC')->paginate(25);
                    break;
                case 1:
                    $products = self::query()->orderBy('products.price', 'ASC')->paginate(25);
                    break;
                default:
                    $products = self::query()->orderBy('products.id', 'ASC')->paginate(25);
            }
        } else {
            return redirect('/product');
        }

        return view('product')->with('products', $products);
    }

    public function edit()
    {
//        $product = Product::find($_POST['id']);
//        $product->price = $_POST['price'];
//        $product->save();

        DB::table('products')
            ->where('id', $_POST['id'])
            ->update(['price' => $_POST['price']]);

        var_dump("!!!!!");
        var_dump($_POST['id']);
        var_dump($_POST['price']);

        var_dump("!!!!!");
    }
}