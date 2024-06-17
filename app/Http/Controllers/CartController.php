<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\MasterRepository;
use DB;

class CartController extends Controller
{
    protected $masterRepository;

    public function __construct(
        MasterRepository $masterRepository
    ) {
        $this->masterRepository = $masterRepository;
    }

    public function index()
    {
        $data = $this->masterRepository->getActiveProductsForCrat(5);

        return view('cart.cart-home', compact('data'));
    }

    public function productView($id)
    {
        $data = $this->masterRepository->getProductDetails($id);

        return view('cart.product-view', compact('data'));
    }

    public function addToCart(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;
        $data = $this->masterRepository->getProduct((int)$id);

        if (!$data) {

            abort(404);
        }

        $cartData = [
            'id_product' => $id,
            'qty' => $request->qty,
            'status' => 1
        ];

        DB::beginTransaction();

        try {

            $this->masterRepository->addToCart($cartData);

            DB::commit();
            $cart = \Session::get('cart');

            if (!$cart) {

                $cart = [
                    $id => [
                        "name" => $data->name,
                        "quantity" => $qty,
                        "price" => $data->price,
                        "photo" => $data->image
                    ]
                ];
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
    
            if (isset($cart[$id])) {
              
                $cart[$id]['quantity'] += $qty;
    
                session()->put('cart', $cart);
    
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
            
            $cart[$id] = [
                "name" => $data->name,
                "quantity" => $qty,
                "price" => $data->price,
                "photo" => $data->image
            ];
    
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
           
        } catch (\Exception $e) {
            DB::rollback();

            \Session::flash('message', "Something Went Wrong");
            return redirect()->back()->with('success', 'Something Went Wrong');
        }
    }

    public function showCart()
    {
        $data = \Session::get('cart');

        return view('cart.cart-view', compact('data'));
    }

    public function placeOrder()
    {
        $data = \Session::get('cart');

        return view('cart.cart-order-place', compact('data'));
    }

    public function addShippingData(Request $request)
    {
        $cartIds = $this->masterRepository->getCart();
        
        foreach ($cartIds as $id) {
            $data[] = [
                'id_cart' => $id,
                'name' => $request->name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'district' => $request->district,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
            ];
        }

        DB::beginTransaction();
        try {
            $this->masterRepository->addShippindData($data);

            DB::commit();
            return redirect()->to("/payment-view");
        } catch (\Exception $e) {
                DB::rollback();
    
                \Session::flash('message', "Something Went Wrong");
                return redirect()->back()->with('success', 'Something Went Wrong');
        }
    }

    public function paymentView()
    {
        $data = \Session::get('cart');

        return view('cart.payment', compact('data'));
    }

    public function payment()
    {
        $data = \Session::get('cart');
        $order = [];
        $cartDetails = $this->masterRepository->getCartDetails();
        foreach ($cartDetails as $cart) {
            $order[$cart->id] = [
                'id_user' => 0,
                'id_product' => $cart->id,
                'id_shipping' => $cart->id_shipping,
                'qty_purchased' => $cart->qty,
                'status' => 1
            ];
        }
        DB::beginTransaction();
        try {
            $this->masterRepository->addOrderdData($order);
            foreach ($cartDetails as $cart) {
                $cartData = [
                    'status' => 0
                ];
                $product = [
                    'qty' => $cart->balance_qty - $cart->qty
                ];

                $this->masterRepository->updateCartDetails($cartData, $cart->id_cart);
                $this->masterRepository->updateQty($product, $cart->id);
            }
            session()->forget('cart');

            DB::commit();
            return redirect()->to("/cart/index");
        } catch (\Exception $e) {
                DB::rollback();
    
                \Session::flash('message', "Something Went Wrong");
                return redirect()->back()->with('success', 'Something Went Wrong');
        }

    }
}
