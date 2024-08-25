<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserColumnVisibility;
use App\Models\User;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Modules\Commercial\app\Models\RequisitionDeliveryItems;
use Modules\Commercial\app\Models\WorkOrder;
use Modules\Commercial\app\Models\WorkOrderItems;
use Modules\IMS\app\Models\CostingChart;
use Modules\Productions\app\Models\DyesChemicalUsageItems;
use Modules\Productions\app\Models\FinishedGoodDocs;
use Modules\StoreInventory\app\Models\StockInventory;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return $this->deleteTables();

        $title = "Dashboard";

        //gray fabric stock position
        $grayFabricStock = $this->grayFabricStock('greyfabric');
        $dyesChemicalStock = $this->grayFabricStock('dyeschemical');
        $fgDeliveryStock = $this->fgDeliveryStock();

        $fgDeliveryRealizationValue = FinishedGoodDocs::where('status', 'completed')->get([
            'realized_value'
        ]);

        $completeWO = WorkOrder::whereHas('finishedGoodsDocs', function ($query) {
            return $query->where('status', 'completed');
        })->orderBy('id', 'desc')->get(['id', 'work_order_no']);


        $data = [
            'title' => 'Dashboard',
            'grayStock' => $grayFabricStock,
            'dyesChemicalStock' => $dyesChemicalStock,
            'fgDeliveryStock' => $fgDeliveryStock,
            'fgDeliveryRealization' => $fgDeliveryRealizationValue->sum('realized_value'),
            'workOrders' => $completeWO
        ];

        return view('admin::layouts.dashboard', $data);
    }

    public function grayFabricStock($type)
    {
        $inventories = StockInventory::with([
            'grnItem.goodReceivedNote.proformaInvoice',
            'product.category',
            'product.attributes.attributeOption.attribute',
            'warehouse',
            'requisitionDeliveryItems'
        ])
            ->whereHas('product', function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->orderby('id', 'asc')
            ->get();

        $deliveries = RequisitionDeliveryItems::with([
            'stockInventory.grnItem',
        ])
            ->whereIn('stock_inventory_id', $inventories->pluck('id')->toArray())
            ->get();

        $totalStock = 0;
        $totalStockValue = 0;

        foreach ($inventories as $value) {
            $landingCost = getGrnItemUnitPrice($value->grnItem, $value->grnItem->goodReceivedNote);

            $unitPrice = request()->has('cost_type') ? (request()->get('cost_type') == 'with_landing_cost' ? $landingCost['unit_price'] : $value->grnItem->unit_price) : $value->grnItem->unit_price;

            $delivery_qty = $deliveries->where('stock_inventory_id', $value->id)->sum('issued_qty');
            $balance_qty = $value->qty - $delivery_qty;
            $subTotal = $unitPrice * $balance_qty;

            $totalStock += $balance_qty;
            $totalStockValue += $subTotal;
        }

        return ['totalStock' => $totalStock, 'totalStockValue' => $totalStockValue];

    }

    public function fgDeliveryStock()
    {
        $workOrderItems = WorkOrderItems::whereHas('workOrder.finishedGoodsDocs', function ($query) {
            return $query->where('status', 'completed');
        })
            ->get([
                'qty',
                DB::raw('`qty`*`reporting_amount` as total')
            ]);

        return [
            'totalDelivery' => $workOrderItems->sum('qty'),
            'totalDeliveryValue' => $workOrderItems->sum('total')
        ];
    }

    public function deleteTables()
    {
        $tables = [
            'finished_good_item_quality_controls',
            'finished_good_items',
            'finished_goods',
            'finished_goods_delivery',
            'finished_goods_delivery_item_details',
            'finished_goods_delivery_items',
            'finished_goods_docs',
            'finished_goods_docs_delivery',
            'grn_charges',
            'grn_items',
            'grns',
            'lc_charges',
            'proforma_invoice_items',
            'proforma_invoices',
            'requisition_delivery',
            'requisition_delivery_items',
            'requisition_items',
            'requisitions',
            'stock_inventory',
            'work_order_charges',
            'work_order_items',
            'work_orders',
            'logs',
            'dyes_chemical_usages',
            'dyes_chemical_usages_items',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($tables as $table) {
            DB::table($table)->where('id', '!=', '')->delete();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return 'ok';
    }

    public function workOrderWiseProfitLoss($id)
    {
        try {

            $model = WorkOrder::with([
                'preCosting', 'customer',
                'process.processCostingCharts',
                'workOrderItems.requisitions.requisitionItems.storeInventories.grnItem.goodReceivedNote',
                'workOrderItems.requisitions.requisitionItems.requisitionDeliveryItems',
                'workOrderItems.product.attributes.attributeOption.attribute',
                'workOrderItems.product.productUnit',
                'workOrderCharges',
                'finishedGoodsDocs',
                'finishedGoodsDeliveries.finishedGoodDeliveryItems'
            ])
                ->where('id', $id)->first();

            if ($model) {
                $workOrderMonth = $model->wo_open_date;
                $itemGSMSet = [];
                $workOrderItemQty = 0;
                foreach ($model->workOrderItems as $key => $workOrderItem) {
                    foreach ($workOrderItem->product->attributes as $attr) {
                        if ($attr->attributeOption->attribute->name == 'GSM') {
                            array_push($itemGSMSet, $attr->attributeOption->name);
                        }
                    }

                    if ($workOrderItem->product->type == 'finishgoods') {
                        $workOrderItemQty += $workOrderItem->qty;
                    }
                }

                //find gsm range id
                $amount = 0;
                foreach ($itemGSMSet as $range) {
                    $costing = CostingChart::with([
                        'costingChartItems' => function ($query) use ($model, $range) {
                            return $query->where('process_id', $model->process_id)
                                ->whereHas('gsmRange', function ($query) use ($range) {
                                    return $query->where('min_value', '<=', $range)
                                        ->where('max_value', '>=', $range);
                                });
                        }
                    ])
                        ->whereHas('costingChartItems', function ($query) use ($model, $range) {
                            return $query->where('process_id', $model->process_id)
                                ->whereHas('gsmRange', function ($query) use ($range) {
                                    return $query->where('min_value', '<=', $range)
                                        ->where('max_value', '>=', $range);
                                });
                        })
                        ->where('date', '<=', $workOrderMonth)
                        ->orderBy('date', 'desc')
                        ->first();
                    $amount += isset($costing->costingChartItems[0]) ? $costing->costingChartItems->first()->amount : 0;
                }

                $totalOverHeadCost = $amount > 0 ? systemDoubleValue($amount / count($itemGSMSet), 2) : 0.00;
                //end overhead cost
                $workOrderId = $model->id;
                $deliveryItems = RequisitionDeliveryItems::with([
                    'stockInventory.grnItem.goodReceivedNote.charges',
                    'stockInventory.grnItem.goodReceivedNote.proformaInvoice.charges',
                    'stockInventory.grnItem.goodReceivedNote.proformaInvoice.proformaItemsItems',
                    'stockInventory.product.productUnit',
                    'stockInventory.product.attributes.attributeOption.attribute',
                    'requisitionItem.requisition.workOrderItem'
                ])->whereHas('requisitionDelivery.requisition.workOrderItem', function ($query) use ($workOrderId) {
                    return $query->where('work_order_id', $workOrderId);
                })->get();

                $grayUnitPriceDataSet = [];
                $dyesChemicalDataSet = [];

                $purchaseLandedTotalCost = [];
                $dyesChemicalTotalLandedCost = [];
                $dyesChemicalTotalCostDataSet = [];

                $issuedQty = 0;
                $issuedDyesChemicalQty = 0;


                if ($deliveryItems->count() > 0) {
                    foreach ($deliveryItems as $key => $item) {
                        //calculate gray cost per unit
                        if ($item->stockInventory->product->type == 'greyfabric') {
                            $thisGrayPrice = getGrnItemUnitPrice($item->stockInventory->grnItem,
                                $item->stockInventory->grnItem->goodReceivedNote);

                            $grayUnitPriceDataSet[] = $thisGrayPrice['base_unit_price'];

                            $purchaseLandedTotalCost[] = $thisGrayPrice['purchaseCharges'] * $item->issued_qty;

                            $issuedQty += $item->issued_qty;
                        }
                        //calculate requisition chemical
                        if ($item->stockInventory->product->type == 'dyeschemical') {
                            $thisGrayPrice = getGrnItemUnitPrice($item->stockInventory->grnItem,
                                $item->stockInventory->grnItem->goodReceivedNote);

                            $dyesChemicalDataSet[] = $thisGrayPrice['base_unit_price'];

                            $dyesChemicalTotalCostDataSet[] = $thisGrayPrice['base_unit_price'] * $item->issued_qty;

                            $dyesChemicalTotalLandedCost[] = $thisGrayPrice['purchaseCharges'] *
                                $item->issued_qty;

                            $issuedDyesChemicalQty += $item->issued_qty;
                        }
                    }
                }

                $bulkDyesChemical = DyesChemicalUsageItems::with([
                    'requisitionDeliveryItem.stockInventory.grnItem.goodReceivedNote.charges',
                    'requisitionDeliveryItem.stockInventory.grnItem.goodReceivedNote.proformaInvoice.charges',
                    'requisitionDeliveryItem.stockInventory.grnItem.goodReceivedNote.proformaInvoice.proformaItemsItems',
                    'requisitionDeliveryItem.stockInventory.product.productUnit',
                    'requisitionDeliveryItem.stockInventory.product.attributes.attributeOption.attribute',
                ])->whereHas('dyesChemicalUse.workOrderItem',
                    function ($query) use ($workOrderId) {
                        return $query->where('work_order_id', $workOrderId);
                    })->get();

                if ($bulkDyesChemical) {
                    foreach ($bulkDyesChemical as $bulkItem) {
                        $thisGrayPrice = getGrnItemUnitPrice
                        ($bulkItem->requisitionDeliveryItem->stockInventory->grnItem,
                            $bulkItem->requisitionDeliveryItem->stockInventory->grnItem->goodReceivedNote);

                        $dyesChemicalDataSet[] = $thisGrayPrice['base_unit_price'];

                        $dyesChemicalTotalCostDataSet[] = $thisGrayPrice['base_unit_price'] * $bulkItem->qty;

                        $dyesChemicalTotalLandedCost[] = $thisGrayPrice['purchaseCharges'] * $bulkItem->qty;

                        $issuedDyesChemicalQty += $bulkItem->qty;
                    }
                }

                //average Per unit
                $totalGrayUnitCost = array_sum(array_values($grayUnitPriceDataSet));
                $totalDyesChemicalUnitCost = array_sum(array_values($dyesChemicalDataSet));
                $totalDyesChemicalTotalCost = array_sum(array_values($dyesChemicalTotalCostDataSet));

                $totalLandedUnitCost = array_sum(array_values($purchaseLandedTotalCost));
                $totalDyesChemicalLandedUnitCost = array_sum(array_values($dyesChemicalTotalLandedCost));

                $grayUnitCost = $totalGrayUnitCost > 0 ? $totalGrayUnitCost / count(array_filter($grayUnitPriceDataSet)) : 0.00;

                $dyesChemicalCost = $totalDyesChemicalUnitCost > 0 ? $totalDyesChemicalUnitCost / count(array_filter($dyesChemicalDataSet)) : 0.00;

                //commercial cost per unit
                $sumOfCommercialCost = ($totalLandedUnitCost > 0 ? $totalLandedUnitCost : 0) +
                    ($totalDyesChemicalLandedUnitCost > 0 ? $totalDyesChemicalLandedUnitCost : 0);

                $commercialCosts = $sumOfCommercialCost > 0 ? $sumOfCommercialCost / $model->workOrderItems->sum('qty')
                    : 0;

                //other costs
                $totalOtherCharge = $model->finishedGoodsDocs->sum('discrepancies_charge') + $model->finishedGoodsDocs->sum
                    ('bank_charge_ait') + $model->finishedGoodsDocs->sum('freight_charge')
                    + $model->finishedGoodsDocs->sum('after_sales_charge');

                $postOtherCost = $totalOtherCharge > 0 ? $totalOtherCharge / $model->workOrderItems->sum('qty') : 0.00;

                $postActualCost = (($grayUnitCost * $issuedQty) / $model->workOrderItems->sum('qty')) + ($totalDyesChemicalTotalCost / $model->workOrderItems->sum('qty')) + $totalOverHeadCost + $commercialCosts + $postOtherCost;

                $postNetSalesPrice = $model->workOrderItems->sum('reporting_amount') / $model->workOrderItems->count();

                $profitLossOnPrice = $postNetSalesPrice - $postActualCost;
            }


            $data = [
                'model' => $model,
                'grayCost' => isset($grayUnitCost) ? $grayUnitCost : 0,
                'grayTotalCost' => isset($grayUnitCost) ? $grayUnitCost * $issuedQty : 0,
                'dyesChemicalCost' => isset($dyesChemicalCost) ? $dyesChemicalCost : 0,
                'dyesChemicalTotalCost' => isset($totalDyesChemicalTotalCost) ? $totalDyesChemicalTotalCost : 0,
                'postOverHeadCost' => isset($totalOverHeadCost) ? $totalOverHeadCost : 0,
                'postCommercialCost' => isset($commercialCosts) ? $commercialCosts : 0,
                'postTotalCommercialCost' => isset($sumOfCommercialCost) ? $sumOfCommercialCost : 0,
                'postOtherCost' => isset($postOtherCost) ? $postOtherCost : 0,
                'totalOtherCost' => isset($totalOtherCharge) ? $totalOtherCharge : 0,
                'postActualCost' => isset($postActualCost) ? $postActualCost : 0,
                'postNetSalesPrice' => isset($postNetSalesPrice) ? $postNetSalesPrice : 0,
                'profitLossOnPrice' => isset($profitLossOnPrice) ? $profitLossOnPrice : 0,
                'issuedQty' => isset($issuedQty) ? $issuedQty : 0,
                'issuedDyesChemicalQty' => isset($issuedDyesChemicalQty) ? $issuedDyesChemicalQty : 0,
            ];

            return view('admin::layouts.profitLoss', $data);

        } catch (\Exception $e) {
            return $e->getMessage();

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function myAccount()
    {
        $title = "My Accounts | Settings";
        $user = Auth::user();

        return view('admin::myAccount.index', compact('title', 'user'));
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['nullable', 'string', 'max:100', 'unique:users,email,' . $id],
            'username' => ['nullable', 'string', 'max:50', 'unique:users,username,' . $id],
        ]);

        $input = $request->except('_token');
        $user = User::findOrFail($id);

        if (!$user) {
            return $this->backWithError('This User is not registered yet.');
        }

        if (!empty($request->password)) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input['password'] = $user->password;
        }

        DB::beginTransaction();
        try {

            $avatarPath = '';
            if ($request->hasFile('avatar')) {
                $avatarPath = $this->fileUpload($request->file('avatar'), 'uploads/users');
                $input['avatar'] = $avatarPath;
                if (!empty($user) && file_exists($user->avatar)) {
                    unlink($user->avatar);
                }
            }
            $user = $user->update($input);

            DB::commit();
            return $this->redirectBackWithSuccess('User updated successfully', 'my.account');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    public function updateUserColumnVisibilities(Request $request)
    {
        UserColumnVisibility::updateOrCreate([
            'user_id' => auth()->user()->id,
            'url' => $request->url
        ], [
            'columns' => json_encode($request->columns)
        ]);
    }
}
