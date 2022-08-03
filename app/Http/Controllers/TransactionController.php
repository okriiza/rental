<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $invoiceNumber = 'INV' . rand(100, 999) . rand(100, 999);
        $units = Unit::all();
        return view('pages.transaction.index', compact('invoiceNumber', 'units'));
    }

    public function getListTransaction()
    {
        $invoices = Invoice::with('invoiceDetail')->get();
        return view('pages.transaction.transactionList', compact('invoices'));
    }

    public function invoice($id)
    {
        $getDetailInvoice = Invoice::with(['invoiceDetail' => function ($query) use ($id) {
            $query->with('unit');
            $query->where('invoice_id', $id);
        }])
            ->findOrFail($id);
        return view('pages.transaction.invoice', compact('getDetailInvoice'));
    }


    public function addItemCart(Request $request)
    {
        $id = $request->units;
        $item = Unit::find($id);
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            $subtotal = $item->price_unit * $request->rental_time;
            $cart[$id] = [
                'id' => $id,
                'name_unit' => $item->name_unit,
                'rental_date' => $request->rental_date,
                'rental_time' => $request->rental_time,
                'price_unit' => $item->price_unit,
                'subtotal' => $subtotal,
            ];
        } else {
            $cart[$id]['rental_time']++;
            $cart[$id]['subtotal'] = $cart[$id]['price_unit'] * $cart[$id]['rental_time'];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item added to cart successfully');
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            return redirect()->back()->with('error', 'Unit Belum Ditambahkan');
        }
        $request->validate([
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'tenant' => 'required',
            'reff_spk' => 'required',
            'project' => 'required',
        ]);
        $total = 0;
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'tenant' => $request->tenant,
            'reff_spk' => $request->reff_spk,
            'project' => $request->project,
            'total' => 0,
        ]);

        $getSessionCart = session()->get('cart', []);
        foreach ($getSessionCart as $item) {
            $total += $item['subtotal'];
            $invoiceDetail = InvoiceDetail::create([
                'invoice_id' => $invoice->id,
                'unit_id' => $item['id'],
                'rental_date' => $item['rental_date'],
                'rental_time' => $item['rental_time'],
                'subtotal' => $item['subtotal'],
            ]);
        }
        $invoice->total = $total;
        $invoice->save();
        session()->forget('cart');
        return redirect()->route('transaction.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Item removed successfully');
        }
    }
}
