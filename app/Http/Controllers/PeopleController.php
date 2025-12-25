<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PeopleController extends Controller
{
    public function index()
{
    $people = [
        ['username' => 'Chimox'],
        ['username' => "M' 💋"],
        ['username' => 'Ibtissam'],
        ['username' => 'Chaimaa'],
        ['username' => 'lamsoulamss'],
        ['username' => 'Lina'],
        ['username' => 'wafaeelqasy'],
        ['username' => 'A.'],
        ['username' => 'Boutayna Ennassef'],
        ['username' => "kenz'"],
        ['username' => 'Miriame'],
        ['username' => 'lunala'],
        ['username' => 'Mommy liftsss'],
        ['username' => 'Octop. us112'],
        ['username' => 'Iyad'],
        ['username' => 'O≤Ǝoɿ'],
        ['username' => 'samrimos'],
        ['username' => 'سلمى'],
        ['username' => 'oumey.golf'],
        ['username' => 'franckette'],
        ['username' => 'imenflower7'],
        ['username' => 'Yass'],
        ['username' => 'Pocahontas'],
        ['username' => 'Sami'],
        ['username' => 'Rim'],
        ['username' => 'samiritta'],
        ['username' => 'KAOUTAR'],
        ['username' => 'BMZ'],
        ['username' => 'ariesoteric'],
        ['username' => 'Unknown08'],
        ['username' => 'Azeddine'],
        ['username' => 'OUMA'],
        ['username' => 'Nouamane Lahlou'],
        ['username' => 'Imane'],
        ['username' => 'Salma Guennouni437'],
        ['username' => '🐝 user'],
        ['username' => 'Marouane'],
        ['username' => 'yassine'],
        ['username' => 'nouri'],
        ['username' => 'High_Saou'],
        ['username' => 'حبيبة'],
        ['username' => 'Osbola'],
        ['username' => 'nore'],
        ['username' => 'Oumaima Metioui'],
        ['username' => 'yaya'],
        ['username' => 'salma <3'],
        ['username' => 'Nisrine_O'],
    ];

    $prices = [469, 479, 478, 938, 379, 529, 1000];

    // Load saved orders from database
    $orders = Order::all()->keyBy('username');

    return view('people.index', compact('people', 'prices', 'orders'));
}


    public function store(Request $request)
    {
        $prices          = $request->input('price', []);
        $jerseys         = $request->input('jerseys', []);
        $livraisons      = $request->input('livraison', []);
        $dates_order     = $request->input('date_of_order', []);
        $dates_delivered = $request->input('date_of_order_delivered', []);
        $statuses        = $request->input('status', []);

        foreach ($prices as $username => $price) {
            $jersey         = $jerseys[$username] ?? null;
            $livraison      = $livraisons[$username] ?? null;
            $date_order     = $dates_order[$username] ?? null;
            $date_delivered = $dates_delivered[$username] ?? null;
            $status         = $statuses[$username] ?? null;

            if (!$price && !$jersey && !$livraison && !$date_order && !$date_delivered && !$status) {
                continue;
            }

            Order::updateOrCreate(
                ['username' => $username],
                [
                    'price'                    => $price ?: null,
                    'jerseys'                  => $jersey ?: null,
                    'livraison'                => $livraison ?: null,
                    'date_of_order'            => $date_order ?: null,
                    'date_of_order_delivered'  => $date_delivered ?: null,
                    'status'                   => $status ?: null,
                ]
            );
        }

        return redirect()->route('people.index')->with('success', 'Saved!');
    }
}
