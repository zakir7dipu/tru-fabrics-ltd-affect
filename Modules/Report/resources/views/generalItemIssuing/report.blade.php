<table class="table table-bordered">
    <tr>
        <td style="width: 10%">
            <strong>Issue Date</strong>
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
        <td style="width: 10%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 10%">
            <strong>Amount</strong>
        </td>

        <td style="width: 10%">
            <strong>Requisition No</strong>
        </td>
        <td style="width: 10%">
            <strong>MRR No</strong>
        </td>
    </tr>
    @if($requisitionDeliveries)
        @foreach($requisitionDeliveries as $value)
            @php
                $landingCost = getGrnItemUnitPrice($value->stockInventory->grnItem, $value->stockInventory->grnItem->goodReceivedNote);

                $unitPrice = request()->has('cost_type')? (request()->get('cost_type')=='with_landing_cost'? $landingCost['unit_price'] : $value->stockInventory->grnItem->unit_price): $value->stockInventory->grnItem->unit_price;

                $subTotal = $unitPrice*$value->issued_qty;

            @endphp

            <tr>
                <td>{{date('M jS, y', strtotime($value->requisitionDelivery->delivery_date))}}</td>
                <td>{{$value->stockInventory->product->name}} {{getProductAttributesFaster($value->stockInventory->product)}}</td>
                <td class="text-center">{{number_format($value->issued_qty)}}</td>
                <td>{{$value->stockInventory->product->productUnit->unit_name}}</td>
                <td class="text-right">{{systemMoneyFormat($unitPrice,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($subTotal, '$')}}</td>

                <td>{{$value->requisitionDelivery->requisition->reference_no}}</td>
                <td>{{$value->stockInventory->mrr_no}}</td>
            </tr>
        @endforeach
    @endif
</table>