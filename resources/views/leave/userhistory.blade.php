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
                                <h3 class="mb-0">{{ __('Staff Leave Applications') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('leave.getUser') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive" >
                        <table class="table align-items-center table-flush" id="example">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Start Date') }}</th>
                                    <th scope="col">{{ __('End Date') }}</th>
                                    <th scope="col">{{ __('Days') }}</th>
                                    <th scope="col">{{ __('Leave Type') }}</th>
                                    <th scope="col">{{ __('Year') }}</th>
                                    <th scope="col">{{ __('Duty Reliever') }}</th>
                                    <th scope="col">{{ __('Approval') }}</th>                                    
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($leaves as $leave)
                                    
                                    <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{ $leave->start_date }}</td>
                                            <td>  
                                                @include('leave.resume')
                                            </td>
                                            <td>{{ $leave->days }}</td>
                                            <td>
                                                @foreach ($leaveTypes as $key => $value)
                                                    @if ($key == $leave->leave_type)
                                                        {{ $value }}
                                                    @endif
                                                @endforeach                                           
                                            </td>
                                            <td>{{ $leave->year}}</td>
                                            <td>
                                                @foreach ($users as $user)
                                                    @if ($user->id == $leave->duty_reliever)
                                                        {{ $user->name }}
                                                    @endif
                                                @endforeach                       
                                            </td>
                                            <td>
                                                @foreach ($users as $user)
                                                    @if ($user->id == $leave->approval_id)
                                                        {{ $user->name }}
                                                    @endif
                                                @endforeach                                         
                                            </td>
                                            
                                        </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                           {{ $leaves->links() }}  
                        </nav>
                    </div> 
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection