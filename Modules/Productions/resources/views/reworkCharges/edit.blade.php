{!! Form::model($lcCharge, ['route' => ['rework.charges.update', $lcCharge->id],'method' => 'PUT','class' => 'form-horizontal','files' => false]) !!}

<div class="row">
    <input type="hidden" name="finished_goods_doc_id" value="{{$lcCharge->finished_goods_doc_id}}">

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('charge_id', 'Charge Name', ['class' => 'col-form-label']) !!}
                <span class="text-danger">*</span>

                <select name="charge_id"
                        id="charge_id"
                        style="width: 100%"
                        class="form-control subcategory select2bs4">
                    @foreach($charges as $data)
                        <option
                            value="{{$data->id}}" {{$lcCharge->charge_id===$data->id?'selected':''}}>{{$data->charge_name}}
                        </option>
                    @endforeach
                </select>

                {!! $errors->first('charge_id') !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('amount', 'Amount', ['class' => 'col-form-label']) !!}
                <span class="text-danger">*</span>
                <input type="number" name="amount"
                       id="amount"
                       class="form-control mask-money"
                       required
                       step="any"
                       value="{{$lcCharge->amount}}"
                >
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('charge_id', 'Charge Name', ['class' => 'col-form-label']) !!}
                <span class="text-danger">*</span>

                <select class="form-control select2bs4 currency"
                        id="currency_id" name="currency_id">
                    @foreach($currenciesModel as $data)
                        <option
                            value="{{$data->id}}" {{$lcCharge->currency_id===$data->id?'selected':''}}>{{$data->short_code}}
                            ({{$data->symbol}})
                        </option>
                    @endforeach
                </select>

                {!! $errors->first('currency_id') !!}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <div class="form-line">
                {!!  Form::label('currency_convert_rate', 'Currency Convert Rate (1 USD= ?)', ['class' => 'col-form-label']) !!}
                <span class="text-danger">*</span>
                <input type="number" name="currency_convert_rate"
                       id="currency_convert_rate"
                       class="form-control mask-money"
                       required
                       step="any"
                       value="{{$lcCharge->currency_convert_rate}}"
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
<script type="text/javascript">

    $(".select2bs4").each(function () {
        $(this).select2({
            theme: "bootstrap4",
            dropdownParent: $(this).parent()
        });
    });
</script>
