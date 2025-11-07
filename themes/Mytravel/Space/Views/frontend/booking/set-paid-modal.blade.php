<div class="modal fade" id="modal-paid-{{$booking->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__("ID da reserva")}}: #{{$booking->id}}</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="booking-review">
                    <div class="booking-review-content">
                        <div class="review-section total-review">
                            <ul class="review-list">
                                <li class="final-total d-block border-0">
                                    <div class="d-flex justify-content-between">
                                        <div class="label">{{__("Total:")}}</div>
                                        <div class="val">{{format_money($booking->total)}}</div>
                                    </div>
                                    @if($booking->status !='draft')
                                        <div class="d-flex justify-content-between">
                                            <div class="label">{{__("Pago:")}}</div>
                                            <div class="val">{{format_money($booking->paid)}}</div>
                                        </div>
                                        @if($booking->paid < $booking->total )
                                            <div class="d-flex justify-content-between">
                                                <div class="label">{{__("Permanecer:")}}</div>
                                                <div class="val">{{currency_symbol()}}<input class="text-right" type="number" min="0" max="{{$booking->total}}" id="set_paid_input" value="{{($booking->total - $booking->paid)}}" />
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="btn btn btn-primary" id="set_paid_btn" data-id="{{$booking->id}}">{{__("Salvar")}}</span>
                <span class="btn btn-secondary" data-dismiss="modal">{{__("Fechar")}}</span>
            </div>
        </div>
    </div>
</div>
