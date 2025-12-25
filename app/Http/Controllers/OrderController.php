<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        
        // Calculate statistics
        $todayOrders = $orders->filter(function($order) {
            return $order->created_at->isToday();
        })->count();
        
        $yesterdayOrders = $orders->filter(function($order) {
            return $order->created_at->isYesterday();
        })->count();
        
        $todayChange = $yesterdayOrders > 0 
            ? round((($todayOrders - $yesterdayOrders) / $yesterdayOrders) * 100) 
            : 0;
        
        $pendingOrders = $orders->whereIn('status', ['not_started', 'preparing'])->count();
        $completedOrders = $orders->where('status', 'delivered')->count();
        $cancelledOrders = $orders->where('status', 'cancelled')->count();
        
        $completedThisWeek = $orders->filter(function($order) {
            return $order->status == 'delivered' 
                && $order->updated_at >= now()->startOfWeek() 
                && $order->updated_at <= now()->endOfWeek();
        })->count();
        
        $completedLastWeek = $orders->filter(function($order) {
            return $order->status == 'delivered' 
                && $order->updated_at >= now()->subWeek()->startOfWeek() 
                && $order->updated_at <= now()->subWeek()->endOfWeek();
        })->count();
        
        $weekChange = $completedLastWeek > 0 
            ? round((($completedThisWeek - $completedLastWeek) / $completedLastWeek) * 100) 
            : 0;
        
        // Recent orders (last 24 hours)
        $recentOrders = $orders->filter(function($order) {
            return $order->created_at >= now()->subDay();
        })->sortByDesc('created_at')->take(10);
        
        return view('orders.index', compact(
            'todayOrders', 
            'todayChange',
            'pendingOrders', 
            'completedOrders', 
            'completedThisWeek',
            'weekChange',
            'cancelledOrders', 
            'recentOrders'
        ));
    }
}
