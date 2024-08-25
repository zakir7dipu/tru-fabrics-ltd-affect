@php
    $workOrderItemSum= $model->workOrderItems->sum('reporting_amount')*$model->workOrderItems->sum('qty');
@endphp
@php
    $totalFGDeliveryQty = 0;
   $totalFGDeliveryValue = 0;
   $totalFGReturnUnitPrice=0;
   $totalFGReturnQty=0;

   foreach ($model->finishedGoodsDeliveries as $key=> $item) {
       if ($key==0){
           $totalFGReturnUnitPrice = $item->finishedGoodDeliveryItems[0]->unit_price;
       }

       $totalFGDeliveryQty += $item->finishedGoodDeliveryItems->sum('delivery_qty');

       $totalFGDeliveryValue += $item->finishedGoodDeliveryItems->sum('total');

       foreach ($item->finishedGoodDeliveryItems as $findFGreturnItem){
                   $totalFGReturnQty += $findFGreturnItem->returns->sum('quantity');
       }
   }

       $totalFGDeliveryQty = $totalFGDeliveryQty-$totalFGReturnQty;
       $totalFGDeliveryValue= $totalFGDeliveryValue - ($totalFGReturnQty*$totalFGReturnUnitPrice);
@endphp

<table class="table table-bordered">

    <tr style="text-align: center">
        <td style="text-align: left"><strong>WO Number:</strong></td>
        <td>{{$model->work_order_no}}</td>
        <td></td>
        <td style="text-align: left"><strong>Buyer</strong></td>
        <td>{{$model->garments_name}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>WO Date:</strong></td>
        <td>{{date('d M Y', strtotime($model->wo_open_date))}}</td>
        <td></td>
        <td style="text-align: left"><strong>Customer</strong></td>
        <td>{{$model->customer->name}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Account Holder</strong></td>
        <td>{{$model->account_holder}}</td>
        <td></td>
        <td style="text-align: left"><strong>WO Quantity</strong></td>
        <td>{{systemMoneyFormat($model->workOrderItems->sum('qty'),'',0)}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Composition</strong></td>
        <td>{{$model->fabric_composition}}</td>
        <td></td>
        <td style="text-align: left"><strong>Lab Dep Approval</strong></td>
        <td>{{$model->lab_dep_approval}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Construction</strong></td>
        <td>
            @foreach($model->workOrderItems as $key=> $item)
                {{ $key > 0 ? ', ':'' }} {{getSingleProductAttributesFaster($item->product,'Construction')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>Shrinkage</strong></td>
        <td>{{$model->shrinkage}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Color</strong></td>
        <td> @foreach($model->workOrderItems as $key=> $item)
                {{ $key > 0 ? ', ':'' }}  {{getSingleProductAttributesFaster($item->product,'Color')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>Process Type</strong></td>
        <td>{{$model->process->name}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Width</strong></td>
        <td>
            @foreach($model->workOrderItems as $key=> $item)
                {{ $key > 0 ? ', ':'' }} {{getSingleProductAttributesFaster($item->product,'Width')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>Finish Type</strong></td>
        <td>{{$model->finish_type}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Weave</strong></td>
        <td>
            @foreach($model->workOrderItems as $key=> $item)
                {{ $key > 0 ? ', ':'' }}  {{getSingleProductAttributesFaster($item->product,'Weave')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>Last Delivery Date</strong></td>
        <td>{{$model->finishedGoodsDeliveries->sortByDesc('delivered_date')->first()->delivered_date?date('M jS, y', strtotime($model->finishedGoodsDeliveries->sortByDesc('delivered_date')->first()->delivered_date)):''}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>GSM</strong></td>
        <td>
            @foreach($model->workOrderItems as $key=> $item)
                {{ $key > 0 ? ($key <= 1 ?' ':', '):'' }} {{getSingleProductAttributesFaster($item->product,'GSM')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>WO Value</strong></td>
        <td style="text-align: right">{{systemMoneyFormat($model->workOrderItems->sum('sub_total'), '$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Export LC Number</strong></td>
        <td>{{$model->finishedGoodsDocs[0]->export_lc_no}}</td>
        <td></td>
        <td style="text-align: left"><strong>Total Delivery Value</strong></td>
        <td style="text-align: right">{{systemMoneyFormat($totalFGDeliveryValue,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Bill ID Number</strong></td>
        <td>{{$model->finishedGoodsDocs[0]->bill_no}}</td>
        <td></td>
        <td style="text-align: left"><strong>Gross Realised Value</strong></td>
        <td style="text-align: right">{{systemMoneyFormat($model->finishedGoodsDocs[0]->realized_value,'$',2)}}</td>

    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Delivery Quantity</strong></td>
        <td>{{systemMoneyFormat($totalFGDeliveryQty,'',0)}}</td>
        <td></td>
        <td style="text-align: left"><strong>Net Realised Value</strong></td>
        <td style="text-align: right">{{systemMoneyFormat($model->finishedGoodsDocs[0]->short_realized_amount,'$',2)}}</td>
    </tr>

</table>

<table class="table table-bordered">

    @php
        $sumOfGrayCost = (isset($model->preCosting->grey_cost_fabric)?$model->preCosting->grey_cost_fabric:0)-($grayTotalCost/$model->workOrderItems->sum('qty'));
        $sumOfDyesCost = (isset($model->preCosting->dyes_chemical)?$model->preCosting->dyes_chemical:0)-($dyesChemicalTotalCost/$model->workOrderItems->sum('qty'));
        $sumOfOverHedCost = (isset($model->preCosting->overhead_cost)?$model->preCosting->overhead_cost:0)-$postOverHeadCost;
        $sumOfOtherCost = (isset($model->preCosting->allowance_cost)?$model->preCosting->allowance_cost:0)-$postOtherCost;
        $sumOfCommercialCost = (isset($model->preCosting->commercial_cost)?$model->preCosting->commercial_cost:0)-$postCommercialCost;
    @endphp
    <tr>
        <td colspan="2" style="text-align: center"><strong>Particulars</strong></td>
        <td style="text-align: center"><strong>Pre-Cost</strong></td>
        <td style="text-align: center"><strong>Post-Cost</strong></td>
        <td style="text-align: center"><strong>Difference</strong></td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Grey Cost</strong></td>
        <td class="text-center"></td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->grey_cost_fabric??0,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($grayTotalCost/$model->workOrderItems->sum('qty'),'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($sumOfGrayCost,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Dyes & Chemical</strong></td>
        <td class="text-center"></td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->dyes_chemical??0,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($dyesChemicalTotalCost/$model->workOrderItems->sum('qty'),'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($sumOfDyesCost,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Overhead Cost</strong></td>
        <td class="text-center"></td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->overhead_cost??0,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($postOverHeadCost,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($sumOfOverHedCost,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Allowance</strong></td>
        <td class="text-center">10%</td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->allowance_cost??0,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($postOtherCost,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($sumOfOtherCost,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Commercial Cost</strong></td>
        <td class="text-center">3%</td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->commercial_cost??0,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($postCommercialCost,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($sumOfCommercialCost,'$',2)}}</td>
    </tr>

    <tr style="text-align: center">
        <td class="text-left"><strong>Total Cost</strong></td>
        @php


            $prePandSonPersent = isset($model->preCosting->profit_loss_on_sales) && $model->preCosting->profit_loss_on_sales>0?$model->preCosting->profit_loss_on_sales/$model->preCosting->net_sales_price:0;


                $grandTotal = $sumOfGrayCost+$sumOfDyesCost+$sumOfOverHedCost+$sumOfCommercialCost+$sumOfOtherCost;

                $preCostGrandTotal = $model->preCosting->grey_cost_fabric+$model->preCosting->dyes_chemical+$model->preCosting->overhead_cost+$model->preCosting->allowance_cost+$model->preCosting->commercial_cost;

                $postGrandTotal = ($grayTotalCost/$model->workOrderItems->sum('qty'))+($dyesChemicalTotalCost/$model->workOrderItems->sum('qty'))+$postOverHeadCost+$postOtherCost+$postCommercialCost;

                $actualDiff = ($profitLossOnPrice < 0 ? (-1)*$profitLossOnPrice : $profitLossOnPrice);


                $postPandSonPersent = $profitLossOnPrice/$postNetSalesPrice;

        @endphp
        <td class="text-right"></td>
        <td class="text-right">{{systemMoneyFormat($preCostGrandTotal,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($postGrandTotal,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($grandTotal,'$',2)}}</td>
    </tr>

    <tr style="text-align: center">
        <td style="text-align: left"><strong>Sales Price </strong></td>
        <td class="text-right"></td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->net_sales_price,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($postNetSalesPrice,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->net_sales_price-$postNetSalesPrice,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Profit on Sale</strong></td>
        <td class="text-right"></td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->profit_loss_on_sales,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($profitLossOnPrice,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($model->preCosting->profit_loss_on_sales-$actualDiff,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Profit % on Sale</strong></td>
        <td class="text-right"></td>
        <td class="text-right">{{systemDoubleValue($prePandSonPersent*100,2)}}%</td>
        <td class="text-right">{{systemDoubleValue($postPandSonPersent*100,2)}}%</td>
        <td class="text-right">{{systemDoubleValue((($prePandSonPersent*100)<0? (-1)*($prePandSonPersent*100):($prePandSonPersent*100))-(($postPandSonPersent*100)<0? (-1)*($postPandSonPersent*100):($postPandSonPersent*100)),2)}}</td>
    </tr>
</table>

