{!! Form::model($lcCharge, ['route' => ['pi.charges.update', $lcCharge->id],'method' => 'PUT','class' => 'form-horizontal','files' => false]) !!}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('pi_no', 'PI No', ['class' => 'col-form-label']) !!}
                <br>
                <span class="text-danger">*</span>
                <span>{{$lcCharge->proformaInvoice->pi_no}}</span>
                <input type="hidden" name="proforma_invoice_id" value="{{$lcCharge->proforma_invoice_id}}">
                {!! $errors->first('pi_no') !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('charge_id', 'Charge Name', ['class' => 'col-form-label']) !!}
                <span class="text-danger">*</span>
                <br>
                <span>{{$lcCharge->charge->charge_name}}</span>
                <input type="hidden" name="charge_id" value="{{$lcCharge->charge_id}}">
                {!! $errors->first('pi_no') !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('amount', 'Amount', ['class' => 'col-form-label']) !!}
                <span class="text-danger">*</span>
                <input type="text" name="amount"
                       id="amount"
                       class="form-control mask-money"
                       required
                       value="{{$lcCharge->amount}}"
                >
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-2">
        {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        &nbsp;
    </div>
</div>

{!! Form::close() !!}
