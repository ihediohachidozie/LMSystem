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
                                <h3 class="mb-0">{{ __('Leave Application Entries') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                               {{--  <a href="{{ route('leave.create') }}" class="btn btn-sm btn-primary">{{ __('Apply') }}</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col" colspan="2" class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
          
                            <tbody>
                                @foreach ($users as $user)
                                  {{--   @if (auth()->id() != 1) --}}
                                        <tr>
                                            <td>{{$user->name}}</td>                                   
                                            <td class="text-center"><a href="{{ route('leave.staffhistory',[$user->id]) }}" class="btn btn-primary btn-sm"> History</a></td>
                                            <td class="text-center"><a href="{{ route('leave.staffsummary',[$user->id]) }}" class="btn btn-primary btn-sm"> Summary</a></td>
                                        </tr>
                                   {{--  @endif    --}}                            
                                @endforeach  
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                           {{ $users->links() }}  
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection