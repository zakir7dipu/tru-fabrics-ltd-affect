<table class="table table-bordered">
    <tr>
        <td style="width: 10%">
            <strong>Received Date</strong>
        </td>

        <td style="width: 10%">
            <strong>Purchase Mode</strong>
        </td>
        <td style="width: 10%">
            <strong>LC No/Bill No</strong>
        </td>
        <td style="width: 10%">
            <strong>LC/Bill/Challan Date</strong>
        </td>
        <td style="width: 10%">
            <strong>Construction</strong>
        </td>
        <td style="width: 5%">
            <strong>Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM Type</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM Qty</strong>
        </td>
        <td style="width: 10%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 10%">
            <strong>Amount</strong>
        </td>
        <td style="width: 10%">
            <strong>MRR No</strong>
        </td>
        <td style="width: 10%">
            <strong>Supplier Name</strong>
        </td>
    </tr>
    @if($inventories)
        @php
            $totalAmount = 0;
        @endphp
        @foreach($inventories as $value)
            @php
                $landingCost = getGrnItemUnitPrice($value->grnItem, $value->grnItem->goodReceivedNote);
                $unitPrice = request()->has('cost_type')? (request()->get('cost_type')=='with_landing_cost'? $landingCost['unit_price']
: $value->grnItem->unit_price): $value->grnItem->unit_price;

                $totalAmount += ($value->qty*$unitPrice);
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($value->grnItem->goodReceivedNote->received_date))}}</td>
                <td>{{$value->grnItem->goodReceivedNote->proformaInvoice->mode_of_purchase??$value->grnItem->goodReceivedNote->proformaInvoice->mode_of_purchase}}</td>
                <td>{{$value->grnItem->goodReceivedNote->proformaInvoice->lc_no??$value->grnItem->goodReceivedNote->proformaInvoice->lc_no}}</td>
                <td>{{$value->grnItem->goodReceivedNote->proformaInvoice->lc_date??$value->grnItem->goodReceivedNote->proformaInvoice->lc_date}}</td>
                <td>{{$value->product->name}}  {{getProductAttributesFaster($value->product)}}</td>
                <td class="text-center">{{$value->qty}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-center">{{$value->grnItem->uom_type}}</td>
                <td class="text-center">{{isset($value->grnItem->uom_qty)? ($value->grnItem->uom_qty>0?$value->grnItem->uom_qty:''):''}}</td>
                <td class="text-right">{{systemMoneyFormat($unitPrice,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($value->qty*$unitPrice, '$')}}</td>
                <td>{{$value->mrr_no}}</td>
                <td>{{$value->grnItem->goodReceivedNote->proformaInvoice->supplier->name}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="text-right">Total</td>
            <td class="text-center">{{number_format($inventories->sum('qty'))}}</td>
            <td class="text-center" colspan="3"></td>
            <td class="text-center">{{systemMoneyFormat($totalAmount,'$')}}</td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
        </tr>
    @endif
</table>
