@extends('layouts.user')
@section('content')
<section class="pricing-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('admin.message')
                @include('User::frontend.upgrade.list')
            </div>
        </div>
    </div>
</section>
@endsection