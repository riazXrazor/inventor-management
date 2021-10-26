<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple invoice html template</title>
</head>

<body>

    <style>
        @import "https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700";

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        total,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block
        }

        body {
            line-height: 1
        }

        ol,
        ul {
            list-style: none
        }

        blockquote,
        q {
            quotes: none
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none
        }

        table {
            border-collapse: collapse;
            border-spacing: 0
        }

        body {
            height: 840px;
            width: 592px;
            margin: auto;
            font-family: 'Open Sans', sans-serif;
            font-size: 12px
        }

        strong {
            font-weight: 700
        }

        #container {
            position: relative;
            padding: 4%
        }

        #header {
            height: 80px
        }

        #header>#reference {
            float: right;
            text-align: right
        }

        #header>#reference h3 {
            margin: 0
        }

        #header>#reference h4 {
            margin: 0;
            font-size: 85%;
            font-weight: 600
        }

        #header>#reference p {
            margin: 0;
            margin-top: 2%;
            font-size: 85%
        }

        #header>#logo {
            width: 50%;
            float: left
        }

        #fromto {
            height: 160px
        }

        #fromto #from,
        #fromto #to {

            min-height: 90px;
            /* margin-top: 30px; */
            font-size: 85%;
            padding: 1.5%;
            line-height: 120%
        }

        #fromto #from {



            /* margin-top: 30px; */
            font-size: 85%;
            padding: 1.5%
        }

        #fromto #to {}

        #items {
            margin-top: 10px
        }

        #items>p {
            font-weight: 700;
            text-align: right;
            margin-bottom: 1%;
            font-size: 65%
        }

        #items>table {
            width: 100%;
            font-size: 85%;
            border: solid grey 1px
        }

        #items>table th:first-child {
            text-align: left
        }

        #items>table th {
            font-weight: 400;
            padding: 1px 4px
        }

        #items>table td {
            padding: 1px 4px
        }

        /* #items>table th:nth-child(2),
        #items>table th:nth-child(4) {
            width: 30%
        }

        #items>table th:nth-child(3) {
            width: 60px
        }

        #items>table th:nth-child(5) {
            width: 80px
        } */

        #items>table tr td:not(:first-child) {
            text-align: right;
            padding-right: 1%
        }

        #items table td {
            border-right: solid grey 1px
        }

        #items table tr td {
            padding-top: 3px;
            padding-bottom: 3px;
            height: 10px
        }

        #items table tr:nth-child(1) {
            border: solid grey 1px
        }

        #items table tr th {
            border-right: solid grey 1px;
            padding: 3px
        }

        #items table tr:nth-child(2)>td {
            padding-top: 8px
        }

        #summary {
            height: 170px;
            margin-top: 30px
        }

        #summary #note {
            float: left
        }

        #summary #note h4 {
            font-size: 10px;
            font-weight: 600;
            font-style: italic;
            margin-bottom: 4px
        }

        #summary #note p {
            font-size: 10px;
            font-style: italic
        }

        #summary #total table {
            font-size: 85%;
            width: 100%;

        }

        #summary #total table td {
            padding: 3px 4px
        }

        #summary #total table tr td:last-child {
            text-align: right
        }

        /* #summary #total table tr:nth-child(3) {
            background: #efefef;
            font-weight: 600
        } */

        #footer {
            margin: auto;
            position: absolute;
            left: 4%;
            bottom: 4%;
            right: 4%;
            border-top: solid grey 1px
        }

        #footer p {
            margin-top: 1%;
            font-size: 65%;
            line-height: 140%;
            text-align: center
        }
    </style>


    <div id="container">
        <div id="header">


            <table style="width: 100%;">
                <tr>
                    <td>
                        <div id="logo">
                            <img src="{{ $invoice->getLogo() }}" width="100" alt="">
                        </div>
                    </td>
                    <td style="text-align: right;">
                        <div id="reference">
                            <h3><strong>Invoice</strong></h3>
                            <h4>Ref. : {{ $invoice->getSerialNumber() }}</h4>
                            <p>Date : {{ $invoice->getDate() }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div id="fromto">



            <table width="100%" border="0">
                <tr>
                    <td style=" background: #efefef;padding:3px">
                        <div id="from">
                            <p>
                                @if($invoice->seller->name)
                                <strong>{{ $invoice->seller->name }}</strong><br>
                                @endif
                                @if($invoice->seller->address)
                                {{ $invoice->seller->address }} <br>
                                @endif
                                @if($invoice->seller->phone)
                                Mobile: {{ $invoice->seller->phone }} <br>
                                @endif
                                @if($invoice->seller->custom_fields['email'])
                                Email: {{ $invoice->seller->custom_fields['email'] }} <br>
                                @endif
                            </p>
                        </div>
                    </td>
                    <td style=" border: solid grey 1px;padding:3px">
                        <div id="to">
                            <p>
                                <strong>{{ $invoice->buyer->name }}</strong><br>
                            </p>
                            @if($invoice->buyer->address)
                            <p class="buyer-address">
                                {{ __('invoices::invoice.address') }}: {{ $invoice->buyer->address }}
                            </p>
                            @endif

                            @if($invoice->buyer->code)
                            <p class="buyer-code">
                                {{ __('invoices::invoice.code') }}: {{ $invoice->buyer->code }}
                            </p>
                            @endif

                            @if($invoice->buyer->vat)
                            <p class="buyer-vat">
                                {{ __('invoices::invoice.vat') }}: {{ $invoice->buyer->vat }}
                            </p>
                            @endif

                            @if($invoice->buyer->phone)
                            <p class="buyer-phone">
                                {{ __('invoices::invoice.phone') }}: {{ $invoice->buyer->phone }}
                            </p>
                            @endif

                            @foreach($invoice->buyer->custom_fields as $key => $value)
                            <p class="buyer-custom-field">
                                {{ ucfirst($key) }}: {{ $value }}
                            </p>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div id="items">

            <table>
                <tr style="border-bottom: 1px solid grey;background-color:grey;color:#fff;padding: 3px;font-size: 120%">
                    <th scope="col" class="border-0 pl-0">{{ __('invoices::invoice.description') }}</th>
                    @if($invoice->hasItemUnits)
                    <th scope="col" width="10%" class="text-center border-0">{{ __('invoices::invoice.units') }}</th>
                    @endif
                    <th scope="col" width="10%" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</th>
                    <th scope="col" width="15%" class="text-right border-0">{{ __('invoices::invoice.price') }}</th>
                    @if($invoice->hasItemDiscount)
                    <th scope="col" width="15%" class="text-right border-0">{{ __('invoices::invoice.discount') }}</th>
                    @endif
                    @if($invoice->hasItemTax)
                    <th scope="col" width="15%" class="text-right border-0">{{ __('invoices::invoice.tax') }}</th>
                    @endif
                    <th scope="col" width="15%" class="text-right border-0 pr-0">{{ __('invoices::invoice.sub_total') }}</th>
                </tr>
       
                {{-- Items --}}
                @foreach($invoice->items as $item)
                <tr>
                    <td class="pl-0">{{ $item->title }}</td>
                    @if($invoice->hasItemUnits)
                    <td class="text-center">{{ $item->units }}</td>
                    @endif
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    @if($invoice->hasItemDiscount)
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->discount) }}
                    </td>
                    @endif
                    @if($invoice->hasItemTax)
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->tax) }}
                    </td>
                    @endif

                    <td class="text-right pr-0">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
                @endforeach

                @foreach(range(0,30 - count($invoice->items)) as $item)
                 <tr>
                    <td></td>
                    @if($invoice->hasItemUnits)
                    <td></td>
                    @endif
                    <td></td>
                    <td></td>
                    @if($invoice->hasItemDiscount)
                    <td></td>
                    @endif
                    @if($invoice->hasItemTax)
                    <td></td>
                    @endif
                    <td></td>
                 </tr>
                @endforeach

            </table>
        </div>

        <div id="summary">


            <table width="100%" border="0">
                <tr>
                    <td>
                        <div id="note">
                            @if($invoice->notes)
                            <p>
                                <h4>{{ trans('invoices::invoice.notes') }}</h4> 
                                <p>{!! $invoice->notes !!}</p>
                            </p>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div id="total">
                            <table border="1">
                                {{-- Summary --}}
                                @if($invoice->hasItemOrInvoiceDiscount())
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                    <td class="text-right pl-0">{{ __('invoices::invoice.total_discount') }}</td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->formatCurrency($invoice->total_discount) }}
                                    </td>
                                </tr>
                                @endif
                                @if($invoice->taxable_amount)
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                    <td class="text-right pl-0">{{ __('invoices::invoice.taxable_amount') }}</td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                                    </td>
                                </tr>
                                @endif
                                @if($invoice->tax_rate)
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                    <td class="text-right pl-0">{{ __('invoices::invoice.tax_rate') }}</td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->tax_rate }}%
                                    </td>
                                </tr>
                                @endif
                                @if($invoice->hasItemOrInvoiceTax())
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                    <td class="text-right pl-0">{{ __('invoices::invoice.total_taxes') }}</td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->formatCurrency($invoice->total_taxes) }}
                                    </td>
                                </tr>
                                @endif
                                @if($invoice->shipping_amount)
                                <tr>
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                    <td class="text-right pl-0">{{ __('invoices::invoice.shipping') }}</td>
                                    <td class="text-right pr-0">
                                        {{ $invoice->formatCurrency($invoice->shipping_amount) }}
                                    </td>
                                </tr>
                                @endif
                                <tr style=" background: #efefef;font-weight: 600; font-size: 110%">
                                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                                    <td class="text-right pl-0">{{ __('invoices::invoice.total_amount') }}</td>
                                    <td class="text-right pr-0 total-amount">
                                        {{ $invoice->formatCurrency($invoice->total_amount) }}
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div id="footer">
            <p>
                @if($invoice->seller->name)
                {{ $invoice->seller->name }},
                @endif
                @if($invoice->seller->address)
                {{ $invoice->seller->address }}
                @endif
                <br>
                @if($invoice->seller->phone)
                Mobile: {{ $invoice->seller->phone }},
                @endif
                @if($invoice->seller->custom_fields['email'])
                Email: {{ $invoice->seller->custom_fields['email'] }} 
                @endif
            </p>
        </div>
    </div>

    <script type="text/php">
        if (isset($pdf) && $PAGE_COUNT > 1) {
            $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width);
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>

</html>