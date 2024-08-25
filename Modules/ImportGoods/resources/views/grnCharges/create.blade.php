{!! Form::open(array('route' => 'grns.charges.store','method'=>'POST',
                                       'class'=>'','files'=>false,'id'=>'ProductsForm')) !!}

<div class="row">
    <input type="hidden" name="grn_id" value="{{$grn_id}}">
    <div class="col-md-12 style-scroll mt-2">
        <table class="table table-striped table-bordered miw-500 dac_table"
               cellspacing="0"
               width="100%" id="dataTable">
            <thead>
            <tr class="text-center">
                <th width="30%">Charges</th>
                <th width="15%">Amount</th>
                <th width="10%">Currency</th>
                <th width="15%">C.Rate (1 USD=?)</th>
                <th width="5%" class="text-center">#</th>
            </tr>
            </thead>
            <tbody class="field_wrapper">
            <tr>
                <td>
                    <div class="input-group input-group-md mb-3 d-">
                        <select name="charge_id[]"
                                id="charge_id_1"
                                style="width: 100%"
                                class="form-control subcategory select2bs4">
                        </select>
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-md mb-3 d-">
                        <input type="number" name="amount[]"
                               id="amount_1"
                               class="form-control mask-money"
                               required
                               data-input="recommended"
                               step="any"
                        >
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-md mb-3 d-">
                        <select class="form-control select2bs4 currency"
                                id="currency_id_1" name="currency_id[]">
                            @foreach($currenciesModel as $data)
                                <option
                                    value="{{$data->id}}">{{$data->short_code}}
                                    ({{$data->symbol}})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div class="input-group input-group-md mb-3 d-">
                        <input type="number" name="currency_convert_rate[]"
                               id="currency_convert_rate_1"
                               step="any"
                               class="form-control mask-money"
                               required>
                    </div>
                </td>
                <td>
                    <a href="javascript:void(0);" id="remove_1"
                       class="remove_button btn btn-sm btn-danger"
                       title="Remove"
                       style="color:#fff;">
                        <i class="mdi mdi-trash-can"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <a href="javascript:void(0);"
           class="add_button btn btn-sm btn-success pull-right"
           style="margin-right:17px;" title="Add More Product">
            <i class="mdi mdi-plus"></i>
        </a>
    </div>
    <div class="col-md-12 mt-2">
        {!! Form::submit('Save Changes', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        &nbsp;
    </div>
</div>
{!! Form::close() !!}

<script type="text/javascript">

    "use strict";
    $(".select2bs4").each(function () {
        $(this).select2({
            theme: "bootstrap4",
            dropdownParent: $(this).parent()
        });
    });

    $(document).ready(function () {

        var addButton = $('.add_button');
        var x = 1;
        var wrapper = $('.field_wrapper');

        getCharges();

        var currencies = '';
        $.each(<?php echo json_encode($currenciesModel); ?>, function (key, value) {
            currencies += '<option value="' + (value.id) + '">' + value.short_code + ' (' + (value.symbol) + ')</option>';
        });

        $(addButton).click(function () {


            x++;

            var fieldHTML = '<tr>\n' +
                '                                            <td>\n' +
                '\n' +
                '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                '                                                    <select name="charge_id[]" style="width: 100%" id="charge_id_' + x + '" class="form-control select2bs4 subcategory" required></select>\n' +
                '                                                </div>\n' +
                '\n' +
                '                                            </td>\n' +
                '                                            <td>\n' +
                '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                '                                                    <input type="number" name="amount[]" step="2" id="amount_' + x + '" class="form-control mask-money" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required>\n' +
                '                                                </div>\n' +
                '                                            </td>\n' +
                '                                                <td><div class="input-group input-group-md mb-3 d-">'
                +
                '                                                    <select name="currency_id[]" id="currency_id_' + x + '" data-increment="' + x + '" class="form-control select2 currency" required>' + (currencies) + '</select>\n' +
                '</div>\n' +
                '                                            </td>\n' +
                '\n' +
                '                                            <td>\n' +
                '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                '                                                    <input type="text" name="currency_convert_rate[]" id="currency_convert_rate_' + x + '" class="form-control mask-money" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required data-quantity="">' +
                '\n' +
                '                                                </div>\n' +
                '                                            </td>\n' +
                '\n' +
                '                                            <td>\n' +
                '                                                <a href="javascript:void(0);" id="remove_' + x + '" class="remove_button btn btn-sm btn-danger" title="Remove" style="color:#fff;">\n' +
                '                                                    <i class="mdi mdi-trash-can"></i>\n' +
                '                                                    \n' +
                '                                                </a>\n' +
                '                                            </td>\n' +
                '\n' +
                '                                        </tr>';

            $(wrapper).append(fieldHTML);
            $('#charge_id_' + x, wrapper).select2({
                dropdownParent: $(this).parent()
            });

            generateCharges($('#charge_id_' + x, wrapper))
            // $('.mask-money').maskMoney(
            //     {
            //         thousands: '', decimal: '.', allowZero: true, allowEmpty: true
            //     });

        });

        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            if (x > 1) {
                x--;
                var incrementNumber = $(this).attr('id').split("_")[1];
                $(this).parent('td').parent('tr').remove();
            }
        });

    });


    function getCharges() {
        $.each($('.subcategory'), function (index, val) {
            generateCharges($(this));
        });
    }

    function generateCharges(element) {

        var charges = <?php echo json_encode($charges); ?>;

        var chargeElement = '<option value="">Select Charge</option>';
        $.each(charges, function (index, val) {
            chargeElement += '<option value="' + (val.id) + '">' + val.charge_name + ' (' + (val.charge_code) + ')</option>';
        });

        element.html(chargeElement).change();
    }

</script>

