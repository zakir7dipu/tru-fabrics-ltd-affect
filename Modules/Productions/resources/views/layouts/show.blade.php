@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', [
                'item' => ['/' => languageValue(websiteSettings()->name), 'active' => 'Productions'],
                'pTitle' => $title,
            ])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <div class="text-xl-end mt-xl-0 mt-2">
                                            <a href="{{route('productions.index')}}" class="btn btn-info mb-2 me-2"
                                               data-toggle="tooltip" title="Productions List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Productions Lists')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="card card-body">
                        <div class="col-lg-12">
                            <div class="invoice-details mt25 row">
                                <div class="well col-6">
                                    <ul class="list-styled mb0">
                                        <li><strong>{{__('Pre Cost Reference No') }}
                                                :</strong> {{$workOrder->reference_no}}
                                        </li>

                                        <li><strong>{{__('Work Order No')}}
                                                :</strong>{{$workOrder->work_order_no}}
                                        </li>


                                        <li><strong>{{__('Delivery Date')}}
                                                :</strong> {{date('d M Y',strtotime($workOrder->delivery_date))}}
                                        </li>
                                        <li><strong>{{__('Account Holder Name')}}
                                                :</strong> {{ucfirst($workOrder->account_holder)}}</li>
                                        <li><strong>{{__('Fabric Composition')}}
                                                :</strong> {{ucfirst($workOrder->fabric_composition)}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-styled mb0 pull-right">
                                        <li><strong>{{__('Customer')}}
                                                :</strong>{{isset($workOrder->customer->name)?$workOrder->customer->name:''}}
                                        </li>
                                        <li><strong>{{__('Buyer Name')}}
                                                :</strong> {{$workOrder->garments_name}}
                                        </li>
                                        <li><strong>{{__('Lab Dep Approval')}}
                                                :</strong> {{ucfirst($workOrder->lab_dep_approval)}}</li>
                                        <li><strong>{{__('Shrinkage')}}:</strong> {{ucfirst($workOrder->shrinkage)}}
                                        </li>
                                        <li><strong>{{__('Process')}}:</strong> {{ucfirst($workOrder->process->name)}}
                                        </li>
                                        <li><strong>{{__('Finish Type')}}:</strong> {{ucfirst($workOrder->finish_type)}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr class="text-center">
                                    <th width="5%">SL</th>
                                    <th width="15%">Product Category</th>
                                    <th width="30%">Product Detail</th>
                                    <th width="5%">UOM</th>
                                    <th width="15%">Unit Price</th>
                                    <th width="15%">Qty</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($workOrder->workOrderItems as $key=>$item)
                                    <td class="text-center">{{$key+1}}</td>
                                    <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                                    <td>{{isset($item->product->name)?$item->product->name:''}}
                                        ( {{isset($item->product->sku)?$item->product->sku:''}}
                                        ) {{ getProductAttributesFaster($item->product) }}</td>
                                    <td>{{ isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:'' }}</td>
                                    <td class="text-right">{{systemMoneyFormat($item->reporting_amount)}}</td>
                                    <td class="text-center">{{$item->qty}}</td>
                                    <td class="text-right">{{systemMoneyFormat($item->qty*$item->reporting_amount)}}</td>
                                    <tr>
                                        <td colspan="9">
                                            @foreach($item->requisitions as $requisition)
                                                <div class="card card-body">
                                                    <div class="table-responsive">
                                                        <div class="panel panel-info">
                                                            <div class="col-lg-12">
                                                                <div class="invoice-details mt25 row">
                                                                    <div class="well col-12">
                                                                        <ul class="list-styled mb0">
                                                                            <li><strong>{{__('Reference No') }}
                                                                                    : </strong>
                                                                                <a
                                                                                    href="javascript:void(0)"
                                                                                    onclick="return showDetails({{$requisition->id}})"
                                                                                    class="btn btn-link btn-sm ">{{$requisition->reference_no}}
                                                                                </a>
                                                                            </li>

                                                                            <li><strong>{{__('Requisition Date')}}
                                                                                    : </strong>{{date('d M Y',strtotime($requisition->requisition_date))}}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <table class="table table-bordered table-hover">
                                                            <thead>
                                                            <tr class="text-center">
                                                                <th>SL</th>
                                                                <th>Product Category</th>
                                                                <th>Product Detail</th>
                                                                <th>UOM</th>
                                                                <th>Qty</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($requisition->requisitionItems as $key=>$item)
                                                                <tr>
                                                                    <td class="text-center">{{$key+1}}</td>
                                                                    <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                                                                    <td>{{isset($item->product->name)?$item->product->name:''}}
                                                                        ( {{isset($item->product->sku)?$item->product->sku:''}}
                                                                        ) {{ getProductAttributesFaster($item->product) }}</td>
                                                                    <td>{{ isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:'' }}</td>
                                                                    <td class="text-center">{{$item->qty}}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="4" class="text-right">Total</td>
                                                                <td class="text-center">{{$requisition->requisitionItems->sum('qty')}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                            <div>
                                <strong> Terms & Conditions: </strong>
                                {!! $workOrder->terms_condition !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-xl" id="showUserDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title " id="myLargeModalLabel">{{ translate('Delivery Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>

                <div class="modal-body" id="dataBody">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function showDetails(id) {
            $('#dataBody').empty().load('{{ url('admin/productions/requisition-details') }}/' + id);
            $('#showUserDetailsModal').modal('show');
        }
    </script>
@endsection
