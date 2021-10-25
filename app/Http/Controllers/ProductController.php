<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class ProductController extends Controller
{
    function index()
    {

        return view('products.index');
    }

    function geterateInvoices()
    {
        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'phone' => '8017079372',
            ],
        ]);

        $item = (new InvoiceItem())
            ->title('Mobile 1')
            ->pricePerUnit(10000)
            ->taxByPercent(18);
        $item2 = (new InvoiceItem())
            ->title('Mobile 2')
            ->pricePerUnit(12000)
            ->taxByPercent(18);


        $invoice = Invoice::make()
            ->template('samir-2')
            ->buyer($customer)
            // ->discountByPercent(10)
            // ->taxRate(18)
            // ->shipping(1.99)
            ->addItem($item)
            ->addItem($item2)
            ->addItem($item2)
            ->logo(public_path('images/logo.png'))
            ->notes('This is an auto generated invoice.');

        return $invoice->stream();
    }
}
