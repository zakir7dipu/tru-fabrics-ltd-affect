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
        <td style="width: 10%">
            <strong>Expiry Date</strong>
        </td>
        <td style="width: 10%">
            <strong>Aging (Days)</strong>
        </td>
        <td style="width: 10%">
            <strong>Existing Life (Days)</strong>
        </td>
    </tr>
    @if($inventories)
        @foreach($inventories as $value)
            @php

                $receivedDate = new DateTime($value->grnItem->goodReceivedNote->received_date);
                $toDate = new DateTime(date('Y-m-d'));
                $interval = $receivedDate->diff($toDate);
                $days = $interval->format('%a');

                //Existing date
                $expiryDate = new DateTime($value->grnItem->expire_date);
                $existingInterval = $receivedDate->diff($expiryDate);
                $existingDays = $existingInterval->format('%a');

                $landingCost = getGrnItemUnitPrice($value->grnItem, $value->grnItem->goodReceivedNote);
                $unitPrice = request()->has('cost_type')? (request()->get('cost_type')=='with_landing_cost'? $landingCost['unit_price'] : $value->grnItem->unit_price): $value->grnItem->unit_price;

                $delivery_qty = $deliveries->where('stock_inventory_id', $value->id)->sum('issued_qty');
                $balance_qty = $value->qty-$delivery_qty;

                $subTotal = $unitPrice*$balance_qty;
            @endphp
{{--            @if($balance_qty>0)--}}
                <tr>
                    <td>{{date('M jS, y', strtotime($value->grnItem->goodReceivedNote->received_date))}}</td>
                    <td>{{$value->product->name}}  {{getProductAttributesFaster($value->product)}}</td>
                    <td class="text-center">{{number_format($balance_qty)}}</td>
                    <td>{{$value->product->productUnit->unit_name}}</td>
                    <td class="text-center">{{$value->grnItem->uom_type}}</td>
                    <td class="text-center">{{isset($value->grnItem->uom_qty)? ($value->grnItem->uom_qty>0?$value->grnItem->uom_qty:''):''}}</td>
                    <td class="text-right">{{systemMoneyFormat($unitPrice,'$')}}</td>
                    <td class="text-right">{{systemMoneyFormat($subTotal, '$')}}</td>
                    <td>{{$value->mrr_no}}</td>
                    <td>{{$value->grnItem->goodReceivedNote->proformaInvoice->supplier->name}}</td>
                    <td class="text-center">{{$value->grnItem->expire_date?date('M jS, y', strtotime($value->grnItem->expire_date)):''}}</td>
                    <td class="text-center">{{$days}}</td>
                    <td class="text-center">{{$existingDays}}</td>
                </tr>
{{--            @endif--}}
        @endforeach
    @endif
</table>
