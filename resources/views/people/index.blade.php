@extends('layouts.app')

@section('title', 'People')

@section('content')
    <div class="content-header">
        <div>
            <div class="content-title">People</div>
            <div class="content-subtitle">
                For each client choose price, number of jerseys and status.
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Inbox / Clients</span>
            <span class="chip">{{ count($people) }} people</span>
        </div>

        <form method="POST" action="{{ route('people.store') }}">
            @csrf

            <table>
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Price</th>
                    <th>Jerseys</th>
                    <th>livraison</th>
                    <th>date of order</th>
                    <th>date of order delivered</th>
                    <th>status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($people as $person)
                    <tr>
                        <td>{{ $person['username'] }}</td>

                        {{-- price select --}}
                        <td>
                            <select name="price[{{ $person['username'] }}]">
                                <option value="">Select price…</option>
                                @foreach ($prices as $price)
                                    <option value="{{ $price }}" 
                                        {{ isset($orders[$person['username']]) && $orders[$person['username']]->price == $price ? 'selected' : '' }}>
                                        {{ $price }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        {{-- jerseys count select --}}
                        <td>
                            <select name="jerseys[{{ $person['username'] }}]">
                                <option value="">Select…</option>
                                @php $savedJerseys = $orders[$person['username']]->jerseys ?? null; @endphp
                                <option value="1" {{ $savedJerseys == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $savedJerseys == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $savedJerseys == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $savedJerseys == 4 ? 'selected' : '' }}>4</option>
                            </select>
                        </td>

                        {{-- livraison --}}
                        <td>
                            <select name="livraison[{{ $person['username'] }}]">
                                <option value="">livraison…</option>
                                @php $savedLivraison = $orders[$person['username']]->livraison ?? null; @endphp
                                <option value="cash plus" {{ $savedLivraison == 'cash plus' ? 'selected' : '' }}>cash plus</option>
                                <option value="live cash" {{ $savedLivraison == 'live cash' ? 'selected' : '' }}>live cash</option>
                            </select>
                        </td>

                        {{-- date of order --}}
                        <td>
                            <input 
                                type="date" 
                                name="date_of_order[{{ $person['username'] }}]"
                                value="{{ $orders[$person['username']]->date_of_order ?? '' }}"
                            />
                        </td>

                        {{-- date delivered --}}
                        <td>
                            <input 
                                type="date" 
                                name="date_of_order_delivered[{{ $person['username'] }}]"
                                value="{{ $orders[$person['username']]->date_of_order_delivered ?? '' }}"
                            />
                        </td>

                        {{-- status --}}
                        <td>
                            <select name="status[{{ $person['username'] }}]">
                                <option value="">Select status…</option>
                                @php $savedStatus = $orders[$person['username']]->status ?? null; @endphp
                                <option value="not_started" {{ $savedStatus == 'not_started' ? 'selected' : '' }}>Not started</option>
                                <option value="preparing" {{ $savedStatus == 'preparing' ? 'selected' : '' }}>Being prepared</option>
                                <option value="shipped" {{ $savedStatus == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $savedStatus == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $savedStatus == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div style="margin-top:16px;">
                <button class="btn-primary" type="submit">
                    Save to Database
                </button>
            </div>
        </form>
    </div>
@endsection
