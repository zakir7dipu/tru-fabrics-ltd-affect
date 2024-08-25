<table class="table table-bordered">

    <tr style="text-align: center">
        <td style="width: 8%">
            <strong>Delivery Date</strong>
        </td>
        <td style="width: 8%">
            <strong>Work Order No</strong>
        </td>
        <td style="width: 5%">
            <strong>Delivery Challan</strong>
        </td>
        <td style="width: 5%">
            <strong>Reference No</strong>
        </td>
        <td style="width: 5%">
            <strong>Total Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>Documents Submission Status</strong>
        </td>
        <td style="width: 5%">
            <strong>Documents Submission Due age (Days)</strong>
        </td>

    </tr>
    @if($finishedGoodDeliveries)
        @foreach($finishedGoodDeliveries as $delivery)
            @php
                $datetime1 = new DateTime($delivery->delivered_date);
                   $datetime2 = new DateTime(date('Y-m-d'));
                   $interval = $datetime1->diff($datetime2);
                   $days = $interval->format('%a');
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($delivery->delivered_date))}}</td>
                <td class="text-left">{{$delivery->workOrder->work_order_no}}</td>
                <td class="text-left">{{ucfirst($delivery->challan_no)}}</td>
                <td class="text-left">{{$delivery->reference_no}}</td>
                <td class="text-center">{{$delivery->finishedGoodDeliveryItems->sum('delivery_qty')}}</td>
                <td class="text-left">Due</td>
                <td class="text-center">{{$days}}</td>
            </tr>
        @endforeach
    @endif
</table>
