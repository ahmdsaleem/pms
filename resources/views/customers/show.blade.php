@extends('layouts.layout')

@section('pageTitle')

    Customer Timeline

@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap-table/bootstrap-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('css/separate/vendor/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/pages/activity.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/vendor/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/separate/vendor/bootstrap-daterangepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

    <section class="activity-line">
        @foreach($transactions as $transaction)
        <article class="activity-line-item box-typical">


            <header class="activity-line-item-header">
                <div class="activity-line-item-user">

                    <div class="activity-line-item-user-name">{{ $customer->name }}</div>
                    <div class="activity-line-item-user-status">{{ $project->name }}</div>
                </div>
            </header>
            @foreach($transaction as $single_transaction)
            <div class="activity-line-date">
                {{ Carbon\Carbon::parse($single_transaction->time)->toFormattedDateString() }}
            </div>

            <div class="activity-line-action-list">
                <section class="activity-line-action">
                    <div class="time">{{ Carbon\Carbon::parse($single_transaction->time)->format('g:i A') }}</div>
                    <div class="cont">
                        <div class="cont-in">
                            <p>{{ config('platforms.jvzoo.customer.'.$single_transaction->type) }}</p>

                            <ul class="meta">
                                <li>Transaction id: {{ $single_transaction->transaction_id }}</li>
                                <li>Amount Transfered: ${{ $single_transaction->amount_transfered }}</li>
                                <li>Payment Method: {{ config('platforms.jvzoo.customer.'.$single_transaction->payment_method)}}</li>
                            </ul>
                        </div>
                    </div>
                </section>

            </div><!--.activity-line-action-list-->
            @endforeach
        </article><!--.activity-line-item-->
        @endforeach
    </section>


@endsection


@section('scripts')

    <script src="{{ asset('js/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/lib/tether/tether.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/lib/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('js/lib/table-edit/jquery.tabledit.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script src="{{ asset('js/lib/html5-form-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/lib/select2/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('js/lib/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/customers/crud.js') }}"></script>

@endsection