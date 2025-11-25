@if(floatval($booking->deposit) and in_array($booking->status,['draft','unpaid']))
    <?php
    $oldDeposit = $booking->getMeta('old_deposit');
    $deposit = $booking->deposit;
    if (empty(floatval($deposit))){
        $deposit  = !empty($oldDeposit)?floatval($oldDeposit):0;
    }
    ;?>
    <hr>
    <div class="form-section">
        <h4 class="form-section-title">{{__("Como você quer pagar?")}}</h4>
        <div class="deposit_types gateways-table accordion ">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0"><label ><input type="radio" checked name="how_to_pay" value="deposit">
                                {{__("Pagar depósito")}}
                            </label></h4>
                        <span class="price"><strong>{{format_money($deposit)}}</strong></span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0"><label ><input type="radio"  name="how_to_pay" value="full">
                                {{__("Pagar integralmente")}}
                            </label></h4>
                        <span class="price"><strong>{{format_money($booking->total)}}</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif