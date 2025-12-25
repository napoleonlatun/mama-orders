@extends('layouts.app')

@section('title', 'Orders overview')

@section('content')
    <div class="content-header">
        <div>
            <div class="content-title">Orders overview</div>
            <div class="content-subtitle">
                Monitor all of mama's orders in one place.
            </div>
        </div>
        <a href="{{ route('people.index') }}" class="btn-primary">+ New order</a>
    </div>

    {{-- Stats cards --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px;">
        <div class="panel" style="padding:20px;">
            <div style="color:#666; font-size:13px; margin-bottom:8px;">Today's orders</div>
            <div style="font-size:32px; font-weight:600; margin-bottom:4px;">{{ $todayOrders }}</div>
            <div style="color:{{ $todayChange >= 0 ? '#10b981' : '#ef4444' }}; font-size:13px;">
                {{ $todayChange >= 0 ? '+' : '' }}{{ $todayChange }}% vs yesterday
            </div>
        </div>

        <div class="panel" style="padding:20px;">
            <div style="color:#666; font-size:13px; margin-bottom:8px;">Pending</div>
            <div style="font-size:32px; font-weight:600; margin-bottom:4px;">{{ $pendingOrders }}</div>
            <div style="color:#f59e0b; font-size:13px;">Need confirmation</div>
        </div>

        <div class="panel" style="padding:20px;">
            <div style="color:#666; font-size:13px; margin-bottom:8px;">Completed</div>
            <div style="font-size:32px; font-weight:600; margin-bottom:4px;">{{ $completedOrders }}</div>
            <div style="color:{{ $weekChange >= 0 ? '#10b981' : '#ef4444' }}; font-size:13px;">
                {{ $weekChange >= 0 ? '+' : '' }}{{ $weekChange }}% this week
            </div>
        </div>

        <div class="panel" style="padding:20px;">
            <div style="color:#666; font-size:13px; margin-bottom:8px;">Cancelled</div>
            <div style="font-size:32px; font-weight:600; margin-bottom:4px;">{{ $cancelledOrders }}</div>
            <div style="color:#ef4444; font-size:13px;">No compensation calculated</div>
        </div>
    </div>

    {{-- Recent orders table --}}
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Recent orders</span>
            <span style="color:#666; font-size:13px;">Last 24 hours</span>
        </div>

        <table>
            <thead>
            <tr>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse($recentOrders as $order)
                <tr>
                    <td>{{ $order->username }}</td>
                    <td>{{ $order->jerseys ?? 0 }} jerseys</td>
                    <td>{{ $order->price ? number_format($order->price, 2) . ' MAD' : '-' }}</td>
                    <td>{{ $order->created_at->format('H:i') }}</td>
                    <td>
                        @if($order->status == 'delivered')
                            <span class="chip" style="background:#10b981; color:white;">Paid</span>
                        @elseif($order->status == 'shipped')
                            <span class="chip" style="background:#3b82f6; color:white;">Shipped</span>
                        @elseif($order->status == 'preparing')
                            <span class="chip" style="background:#f59e0b; color:white;">Preparing</span>
                        @elseif($order->status == 'cancelled')
                            <span class="chip" style="background:#ef4444; color:white;">Cancelled</span>
                        @else
                            <span class="chip" style="background:#6b7280; color:white;">Pending</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:40px; color:#666;">
                        No orders in the last 24 hours
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
