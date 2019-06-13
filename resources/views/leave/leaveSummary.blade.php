@extends('layouts.app', ['title' => __('Leave Management')])

@section('content')
    @include('layouts.headers.card')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Leave Approved Summary') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('leave.create') }}" class="btn btn-sm btn-primary">{{ __('Apply') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">{{ __('Year') }}</th>
                                    <th scope="col">{{ __('Days Utilized') }}</th>
                                    <th scope="col">{{ __('Days Outstanding') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveSummaries as $key => $value)

                                <tr class="text-center">
                                    <td>{{$key}} </td>
                                    <td>{{$value}}</td>
                                    <td>{{$days - $value}}</td>
                                </tr>  
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection