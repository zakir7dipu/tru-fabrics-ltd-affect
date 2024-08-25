<div class="row">

    <input type="hidden" name="code" value="{{isset($vendor->id)? $vendor->code: $code}}">
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('name', 'Name', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('name', request()->old('name'), [
                    'id' => 'name',
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter name'
                ]) !!}
                {!! $errors->first('name') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('phone', 'Phone', ['class' => 'col-form-label']) !!} <span class="text-danger">*</span>
                {!! Form::text('phone', request()->old('phone'), [
                    'id' => 'phone',
                    'class' => 'form-control',
                    'required' => true,
                    'placeholder' => 'Enter phone no.'
                ]) !!}
                {!! $errors->first('phone') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('email', 'Email', ['class' => 'col-form-label']) !!}
                {!! Form::email('email', request()->old('email'), [
                    'id' => 'email',
                    'class' => 'form-control',
                    'placeholder' => 'Enter email'
                ]) !!}
                {!! $errors->first('email') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('mobile_no', 'Mobile No', ['class' => 'col-form-label']) !!}
                {!! Form::text('mobile_no', request()->old('mobile_no'), [
                    'id' => 'mobile_no',
                    'class' => 'form-control',
                    'placeholder' => 'Enter mobile no'
                ]) !!}
                {!! $errors->first('mobile_no') !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('trade', 'Trade License No', ['class' => 'col-form-label']) !!}
                {!! Form::text('trade', request()->old('trade'), [
                    'id' => 'trade',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Trade license no if any.'
                ]) !!}
                {!! $errors->first('trade') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('tin', 'Tin No', ['class' => 'col-form-label']) !!}
                {!! Form::text('tin', request()->old('tin'), [
                    'id' => 'tin',
                    'class' => 'form-control',
                    'placeholder' => 'Enter Tin'
                ]) !!}
                {!! $errors->first('tin') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('website', 'Website', ['class' => 'col-form-label']) !!}
                {!! Form::text('website', request()->old('website'), [
                    'id' => 'website',
                    'class' => 'form-control',
                    'placeholder' => 'Enter website'
                ]) !!}
                {!! $errors->first('website') !!}
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('address', 'Address', ['class' => 'col-form-label']) !!}
                {!! Form::textarea('address', request()->old('address'), [
                    'rows' => '3',
                    'id' => 'address',
                    'class' => 'form-control',
                    'placeholder' => 'Enter address'
                ]) !!}
                {!! $errors->first('address') !!}
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
                {!!  Form::label('agreement', 'Agreement', ['class' => 'col-form-label']) !!}
                {!! Form::textarea('agreement', request()->old('agreement'), [
                    'id' => 'agreement',
                    'rows' => '3',
                    'class' => 'form-control',
                    'placeholder' => 'Enter agreements'
                ]) !!}
                {!! $errors->first('agreement') !!}
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('term_conditions', 'Term Conditions', ['class' => 'col-form-label']) !!}
                {!! Form::textarea('term_conditions', request()->old('term_conditions'), [
                    'id' => 'term_conditions',
                    'rows' => '3',
                    'class' => 'form-control',
                    'placeholder' => 'Enter terms & conditions'
                ]) !!}
                {!! $errors->first('term_conditions') !!}
            </div>
        </div>
    </div>


    <div class="col-md-12 mt-2">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        &nbsp;
    </div>
</div>
