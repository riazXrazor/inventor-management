<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function index(Request $request)
    {

        $ProductCategory = ProductCategory::all();

        if ($request->isMethod('post') && $request->has('generate_new')) {
            session()->flush();
            return redirect('/');
        }

        if ($request->isMethod('post') && $request->has('set_customer')) {
            $this->setCustomerDetails($request);
            return redirect('/');
        }

        if ($request->isMethod('post') && $request->has('add_item')) {
            $this->pushInvoiceItem($request);
            return redirect('/');
        }

        if ($request->isMethod('post') && $request->has('remove_item')) {
            $this->removeInvoiceItem($request);
            return redirect('/');
        }


        return view('home', [
            'ProductCategory' => $ProductCategory
        ]);
    }

    function geterateInvoices(Request $request)
    {


        $customer = new Buyer([
            'name'          => session()->get('customer.name'),
            'custom_fields' => [
                'phone' => session()->get('customer.phone'),
            ],
        ]);

        $invoice = Invoice::make()
            ->template('samir-2')
            ->buyer($customer);
        $items = [];
        foreach (session()->get('customer.items') as  $item) {

            $invoiceitem = (new InvoiceItem())
                ->title($item['name'])
                ->pricePerUnit($item['price'])
                ->quantity($item['qty'])
                ->taxByPercent($item['tax']);

            if ($item['discount_type'] == 'percent') {
                $invoiceitem = $invoiceitem->discountByPercent($item['discount']);
            } else {
                $invoiceitem = $invoiceitem->discount($item['discount']);
            }

            $items[] = $invoiceitem;
        }

        $invoice = $invoice->addItems($items)->logo(public_path('images/logo.png'))
            ->notes('This is an auto generated invoice.');

        return $invoice->download();
    }

    private function setCustomerDetails($request)
    {
        session()->put('customer.name', $request->name);
        session()->put('customer.phone', $request->phone);
    }

    private function pushInvoiceItem($request)
    {
        if ($request->qty <= 0) return;
        $product = Product::with('category')->find($request->product_id);
        $product->qty = $request->qty;
        $product->tax = $request->tax;
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        session()->push('customer.items', $product->toArray());
    }

    private function removeInvoiceItem($request)
    {
        $items = session()->get('customer.items');

        $items = collect($items)->filter(function ($item) use ($request) {
            return $item['id'] != $request->remove_item;
        })->toArray();



        session()->put('customer.items', $items);
    }
}
