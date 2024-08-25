<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="col-xl-12 col-lg-12">
                {!! Form::model($model, ['route' => ['dyes-chemical-usages.update', $model->id],'method' => 'PUT','class' => 'form-horizontal','files' => true]) !!}

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-line">
                                {!!  Form::label('reference_no', 'Reference No', ['class' => 'col-form-label']) !!}
                                <span class="text-danger">*</span>
                                {!! Form::text('reference_no', isset($sku)?$sku:request()->old('reference_no'), [
                                    'id' => 'reference_no',
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Reference No'
                                ]) !!}
                                {!! $errors->first('reference_no') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-line">
                                {!!  Form::label('date', 'Date', ['class' => 'col-form-label']) !!}
                                <span class="text-danger">*</span>
                                {!! Form::date('date', old('date'), [
                                    'id' => 'date',
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Requisition Date'
                                ]) !!}
                                {!! $errors->first('date') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-line">
                                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}
                                {!! Form::Select('status',array('pending'=>'Pending','approved'=>'Approved','halt'=>'Halt'),Request::old('status'),['id'=>'status', 'class'=>'form-control select2']) !!}
                                {!! $errors->first('status') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-line">
                                {!!  Form::label('usages_file', 'File', array('class' => 'col-form-label')) !!}
                                <br>
                                <input type="file" name="usages_file"
                                       id="usages_file" class="form-control" width="100%">

                                {!! $errors->first('usages_file') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                {!!  Form::label('remarks', 'Remarks', ['class' => 'col-form-label']) !!}
                                {!! Form::textarea('remarks', request()->old('remarks'), [
                                    'id' => 'remarks',
                                    'class' => 'form-control',
                                    'rows'=>'5',
                                    'placeholder' => 'Enter Remarks'
                                ]) !!}
                                {!! $errors->first('remarks') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-2">
                        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                        &nbsp;
                    </div>
                </div>


                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

