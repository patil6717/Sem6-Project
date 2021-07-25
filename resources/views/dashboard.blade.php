@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card card-chart">
                <div class="card-header text-center">
                   Total Bus 
                </div>
                <div class="card-body text-center">
                    <p><h1>{{$bus}}</h1></p>
                </div>
            </div>
        </div>
       <div class="col-4">
            <div class="card card-chart">
                <div class="card-header text-center">
                    Total Station
                </div>
                <div class="card-body text-center">
                    <p><h1>{{$station}}</h1></p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-chart">
                <div class="card-header text-center">
                   Total Schedule 
                </div>
                <div class="card-body text-center">
                    <p><h1>{{$shedule}}</h1></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card card-chart">
                <div class="card-header text-center">
                    Total Route
                </div>
                <div class="card-body text-center">
                    <p><h1>{{$route}}</h1></p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card card-chart">
                <div class="card-header text-center">
                    Total Bus On Trip
                </div>
                <div class="card-body text-center">
                    <p><h1>{{$busontoday}}</h1></p>
                </div>
            </div>
        </div>
         <div class="col-4">
            <div class="card card-chart">
                <div class="card-header text-center">
                   Total Bus In Maintanance 
                </div>
                <div class="card-body text-center">
                    <p><h1>{{$busonmain}}</h1></p>
                </div>
            </div>
        </div>
       
    </div>
    <div class="row">
       
        <div class="col-4">
            <div class="card card-chart">
                <div class="card-header text-center">
                   Total Driver
                </div>
                <div class="card-body text-center">
                    <p><h1>{{$driver}}</h1></p>
                </div>
            </div>
        </div>
       
    </div>
@endsection

@push('js')
    <script src="{{ asset('white') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush
