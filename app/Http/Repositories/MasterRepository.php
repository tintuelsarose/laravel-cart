<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use App\Models\CartDetails;
use App\Models\Category;
use App\Models\Images;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductBalance;
use App\Models\Payment;
use App\Models\User;
use App\Models\ShippingDetails;

class MasterRepository
{
    public function getActiveCategories()
    {
        return Category::paginate(50);
    }

    public function storeCategory($data)
    {
        return Category::create($data);
    }

    public function getCategory($id)
    {
        return Category::where('status', 1)->find($id);
    }

    public function updateCategory($data, $idCategory)
    {
        return Category::where('id', $idCategory)->update($data);
    }

    public function deleteCategory($id)
    {
        return Category::where('id', $id)->delete();
    }

    public function getActiveProducts($limit)
    {
        return Product::join('categories', 'products.id_category', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->paginate($limit);
    }

    public function getCategoriesNames()
    {
        return Category::pluck('name', 'id');
    }

    public function storeProduct($data)
    {
        return Product::create($data);
    }

    public function getProduct($id)
    {
        return Product::where('status', 1)->find($id);
    }
    public function updateProduct($data, $idProduct)
    {
        return Product::where('id', $idProduct)->update($data);
    }

    public function deleteProduct($id)
    {
        return Product::where('id', $id)->delete();
    }
    public function getProductDetails($id)
    {
        return Product::join('categories', 'products.id_category', 'categories.id')
            ->select('products.*', 'categories.name as category_name', 'categories.desc as category_desc')
            ->where('products.id', $id)
            ->first();   
    }
    public function getActiveProductsForCrat($limit)
    {
        return Product::join('categories', 'products.id_category', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.status', 1)
            ->paginate($limit);
    }
    public function addToCart($data)
    {
        return CartDetails::create($data);
    }
    public function getCart()
    {
        return CartDetails::where('status', 1)->pluck('id');
    }
    public function addShippindData($data)
    {
        return ShippingDetails::insert($data);
    }
    public function getCartDetails()
    {
        return CartDetails::join('products', 'products.id', 'cart_details.id_product')
            ->leftJoin('shipping_details', 'cart_details.id', 'shipping_details.id_cart')
            ->where('cart_details.status', 1)
            ->select('products.*',
                'cart_details.id as id_cart',
                'cart_details.status as cart_status',
                'cart_details.qty as qty',
                'shipping_details.id as id_shipping',
                'products.qty as balance_qty'
            )
            ->get();
    }
    public function addOrderdData($data)
    {
        return Order::insert($data);
    }
    public function updateCartDetails($data, $id)
    {
        return CartDetails::where('id', $id)->update($data);
    }
    public function updateQty($data, $id)
    {
        return Product::where('id', $id)->update($data);
    }
}
