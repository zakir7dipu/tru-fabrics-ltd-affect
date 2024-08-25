<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('title', 'Payment Term Name', ['class' => 'col-form-label']) !!} <span
                    class="text-danger">*</span>
                {!! Form::text('title', request()->old('title'), [
                    'id' => 'title',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter term'
                ]) !!}
                {!! $errors->first('title') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('percentage', 'Payment Percentage', ['class' => 'col-form-label']) !!} <span
                    class="text-danger">*</span>
                {!! Form::number('percentage', request()->old('percentage'), [
                    'id' => 'percentage',
                    'class' => 'form-control',
                    'required' => true,
                    'step'=>'any',
                    'placeholder' => 'Enter percentage. Ex: 100'
                ]) !!}
                {!! $errors->first('percentage') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('days', 'Payment Terms Days', ['class' => 'col-form-label']) !!} <span
                    class="text-danger">*</span>
                {!! Form::number('days', request()->old('days'), [
                    'id' => 'days',
                    'class' => 'form-control',
                    'required' => true,
                    'placeholder' => 'Enter percentage. Ex: 90'
                ]) !!}
                {!! $errors->first('days') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('type', 'Type', array('class' => 'col-form-label')) !!}
                {!! Form::Select('type',array('paid'=>'Paid','due'=>'Due'),Request::old('status'),['id'=>'type', 'class'=>'form-control select2']) !!}
                {!! $errors->first('type') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Request::old('status'),['id'=>'status', 'class'=>'form-control select2']) !!}
                {!! $errors->first('status') !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('remarks', 'Remarks', ['class' => 'col-form-label']) !!}
                {!! Form::textarea('remarks', request()->old('remarks'), [
                    'id' => 'remarks',
                    'rows' => '3',
                    'class' => 'form-control',
                    'placeholder' => 'Enter remarks'
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
