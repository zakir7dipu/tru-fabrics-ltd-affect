<table class="table table-bordered">
    <tr style="text-align: center">
        <td style="width: 10%">
            <strong>Date</strong>
        </td>

        <td style="width: 60%">
            <strong>Product Name</strong>
        </td>
        <td style="width: 10%">
            <strong>Work Order No</strong>
        </td>

        <td style="width: 20%">
            <strong>Quantity Ready for Inspection</strong>
        </td>
    </tr>
    @if($finishedGoodItems)
        @foreach($finishedGoodItems as $fgItem)
            @php
                $qcQty =  $fgItem->finishedGoodQualityControl->where('is_wip', 'no')->sum('qty');
                $isInspection = $fgItem->qty - ($qcQty > 0 ? $qcQty : 0);
            @endphp
            @if($isInspection >0)
                <tr>
                    <td>{{date('M jS, y', strtotime($fgItem->finishedGoods->received_date))}}</td>
                    <td class="text-left">{{$fgItem->workOrderItem->product->name}}  {{getProductAttributesFaster($fgItem->workOrderItem->product)}}</td>
                    <td class="text-center">{{$fgItem->finishedGoods->workOrder->work_order_no}}</td>

                    <td class="text-center">{{number_format($isInspection)}}</td>
                </tr>
            @endif
        @endforeach
    @endif
</table>
