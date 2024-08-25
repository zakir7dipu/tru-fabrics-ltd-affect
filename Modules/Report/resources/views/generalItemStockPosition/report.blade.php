<table class="table table-bordered">
    <tr>
        <td style="width: 10%">
            <strong>Import Date</strong>
        </td>
        <td style="width: 20%">
            <strong>Construction</strong>
        </td>
        <td style="width: 10%">
            <strong>Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM</strong>
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
        <td style="width: 10%">
            <strong>Aging (Days)</strong>
        </td>
    </tr>
    @if($inventories)
        @foreach($inventories as $value)
            @php
                $landingCost = getGrnItemUnitPrice($value->grnItem, $value->grnItem->goodReceivedNote);
                 $unitPrice = request()->has('cost_type')? (request()->get('cost_type')=='with_landing_cost'? $landingCost['unit_price'] : $value->grnItem->unit_price): $value->grnItem->unit_price;

                $datetime1 = new DateTime($value->grnItem->goodReceivedNote->received_date);
                $datetime2 = new DateTime(date('Y-m-d'));
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');

                $delivery_qty = $deliveries->where('stock_inventory_id', $value->id)->sum('issued_qty');
                $balance_qty = $value->qty-$delivery_qty;
                $subTotal = $unitPrice*$balance_qty;
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($value->grnItem->goodReceivedNote->received_date))}}</td>
                <td>{{$value->product->name}}  {{getProductAttributesFaster($value->product)}}</td>
                <td class="text-center">{{number_format($balance_qty)}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-right">{{systemMoneyFormat($unitPrice,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($subTotal, '$')}}</td>
                <td>{{$value->mrr_no}}</td>
                <td>{{$value->grnItem->goodReceivedNote->proformaInvoice->supplier->name}}</td>
                <td class="text-center">{{$days}}</td>
            </tr>
        @endforeach
    @endif
</table>
