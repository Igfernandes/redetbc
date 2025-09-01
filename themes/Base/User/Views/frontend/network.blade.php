@extends('layouts.user')
@section('content')
<h2 class="title-bar">
    {{__("network")}}

</h2>
@include('admin.message')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="py-1 text-center">
                <div>
                    <ul class="pb-2" style="list-style: none; display: flex; justify-content: center;">
                        <li class="mx-2">direct commissions <strong>10%</strong></li>
                        <li class="mx-2">indirect commissions <strong>5%</strong></li>
                    </ul>
                </div>
                <div>
                    <p>
                        To earn the full amount of the indirect commission, you must have at least <strong>30%</strong> of the direct balance
                        Or you will receive the same amount as the direct one.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="bg-info p-2 text-center text-white">
                <div class="py-1">
                    <span style="font-size: 2rem;">380</span>
                </div>
                <div>
                    <p>{{__("Direct Members")}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="bg-success p-2 text-center text-white">
                <div class="py-1">
                    <span style="font-size: 2rem;">{{format_money_main(4200)}}</span>
                </div>
                <div>
                    <p> {{__("Direct Sale balance")}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="bg-info  p-2 text-center text-white">
                <div class="py-1">
                    <span style="font-size: 2rem;">{{840}}</span>
                </div>
                <div>
                    <p> {{__("Indirect Members")}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="bg-success  p-2 text-center text-white">
                <div class="py-1">
                    <span style="font-size: 2rem;">{{format_money_main(9800)}}</span>
                </div>
                <div>
                    <p>{{__("Indirect Sale balance")}} </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-5">
            <form action="">
                <div class="form-group">
                    <label for="copy">
                        {{__("Copy the indication link")}}
                    </label>
                    @php

                    $link = url('/?key=' .$user->id);
                    @endphp

                    <div class="d-flex" style="align-items: center;">
                        <input type="text" class="form-control me-2" id="copy-link-input" readonly value="{{ $link }}">
                        <button class="btn btn-info col-12 col-md-2" type="button" id="copy-link-button">
                            {{ __("Copy Link") }}
                        </button>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const copyButton = document.getElementById('copy-link-button');
                            const copyInput = document.getElementById('copy-link-input');

                            copyButton.addEventListener('click', function() {
                                copyInput.select();
                                copyInput.setSelectionRange(0, 99999); // Para dispositivos móveis
                                document.execCommand('copy');

                                // Feedback (opcional)
                                copyButton.innerText = 'Copied!';
                                setTimeout(() => {
                                    copyButton.innerText = '{{ __("Copy Link") }}';
                                }, 2000);
                            });
                        });
                    </script>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection