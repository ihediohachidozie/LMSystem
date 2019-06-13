@extends('layouts.app', ['title' => __('System Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit Public Holiday')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                               {{--  <h3 class="mb-0">{{ __('Department') }}</h3> --}}
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('publicholiday.index')}}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            <form method="post" action="{{route('publicholiday.update', ['publicholiday' => $publicholiday])}}" autocomplete="off">        
                                {{--    <h6 class="heading-small text-muted mb-4">{{ __('Department') }}</h6> --}}
                                <div class="pl-lg-4">
                                    @include('publicholiday.form')
    
                                    @method('PATCH')
    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection