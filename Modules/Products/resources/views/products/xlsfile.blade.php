<!-- Supplier Upload Modal Start-->
<div class="modal fade bd-example-modal-md" id="productUploadModal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title " id="myLargeModalLabel">{{translate('Upload Category Bulk Data')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" id="dataBody">
                <form id="brandForm" enctype="multipart/form-data" action="{{route('products.import-excel')}}"
                      method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {!!  Form::label('download', 'Download Sample File', ['class' => 'col-form-label']) !!}
                                            <span class="text-danger">*</span>
                                            <a href="{{URL::to('excel/products-sample.xlsx')}}" download
                                               class="btn btn-link"><i
                                                    class="mdi mdi-download"></i>{{__('Click Here To Download Format File')}}
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {!!  Form::label('import_file', 'Select the Excel Files', array('class' => 'col-form-label')) !!}
                                            <span class="text-danger">*</span>
                                            <br>
                                            <input type="file" name="import_file" class="form-control" required
                                                   id="excelFile"
                                                   placeholder="Browse Excel file"
                                                   accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">

                                            {!! $errors->first('supplier_file') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    {!! Form::submit('Upload', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                                    &nbsp
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" aria-hidden="true"
                            class="btn btn-danger rounded pull-left"
                            data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Supplier Upload Modal End -->
