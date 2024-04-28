<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status','!=', 3)->get();
        return view('admin.product.order', compact('orders'));
    }

    public function check($id)
    {
        $data = [
            'status' => 2,
        ];
        Order::find($id)->update($data);
        return redirect('admin/order')->with('updated', 'Category Updated!');
    }

    public function confirm($id)
    {
        $orderItems = Order::where('id', $id)->get();

        foreach ($orderItems as $orderItem) {
            $productId = $orderItem->product_id;
            // Update product status here using the $productId
            // For example, assuming you have a Product model:
            $product = Product::find($productId);
            $product->update(['status' => 0]);
        }

        $data = [
            'status' => 3,
        ];
        Order::find($id)->update($data);
        return redirect('admin/order')->with('updated', 'Category Updated!');
    }
    
    public function cancel($id)
    {
        $data = [
            'status' => 4,
        ];
        Order::find($id)->update($data);
        return redirect('admin/order')->with('updated', 'Category Updated!');
    }
    
    
}
