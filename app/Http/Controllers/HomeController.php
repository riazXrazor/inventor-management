<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use LaravelDaily\Invoices\Invoice;
use App\Models\Invoice as ModelsInvoice;
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
            session()->forget('customer');
            return redirect('/');
        }

        if ($request->isMethod('post') && $request->has('set_customer')) {
            $this->setCustomerDetails($request);
            return redirect('/');
        }

        if ($request->isMethod('post') && $request->has('add_customer')) {
            if (!$errors = $request->validate([
                'name' => 'required|max:255',
                'phone' => 'required|digits:10|unique:customer,phone'
            ], [
                'phone.unique' => 'A customer with this Phone number already exists.'
            ])) {
                return redirect()->back()->withErrors($errors);
            }
            $this->addCustomerDetails($request);
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

        try {

            $customer = new Buyer([
                'name'          => session()->get('customer.name'),
                'custom_fields' => [
                    'phone' => session()->get('customer.phone'),
                ],
            ]);

            $invoiceCount = ModelsInvoice::count();

            $invoice = Invoice::make()
                ->template('samir-2')
                ->buyer($customer)
                ->series('ST')
                ->sequence($invoiceCount + 1)
                ->serialNumberFormat('{SERIES}-' . date('ymd') . '-{SEQUENCE}');
            $items = [];
            $productStocksToUpdate = [];
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
                $productStocksToUpdate[] = [$item['id'], $item['qty']];
            }

            $invoice = $invoice->addItems($items)->logo(public_path('images/logo.png'))
                ->notes('This is an auto generated invoice.');



            DB::beginTransaction();


            $invoiceSave =  new ModelsInvoice();
            $invoiceSave->customer_id = Customer::where('phone', session()->get('customer.phone'))->first()->id;
            $invoiceSave->invoice_data = json_encode(session()->get('customer'));
            $invoiceSave->invoice_no = $invoice->getSerialNumber();
            $invoiceSave->save();

            foreach ($productStocksToUpdate as $product) {
                Product::find($product[0])->decrement('stock', $product[1]);
            }

            DB::commit();

            return $invoice->filename($invoice->getSerialNumber())->download();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('errorMsg', $e->getMessage());
        }
    }

    function searchCustomer(Request $request)
    {
        if ($request->search) {
            return Customer::where('name', 'like', '%' . $request->search . '%')->orWhere('phone', 'like', '%' . $request->search . '%')->get();
        }

        return [];
    }


    function addCustomerDetails($request)
    {

        $c = new Customer();
        $c->name = $request->name;
        $c->phone = $request->phone;
        $c->save();
        session()->put('customer.name', $request->name);
        session()->put('customer.phone', $request->phone);
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
