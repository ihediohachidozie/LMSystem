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
                                <h3 class="mb-0">{{ __('Leave Approval Requests') }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Start Date') }}</th>
                                    <th scope="col">{{ __('Days') }}</th>
                                    <th scope="col">{{ __('Leave Type') }}</th>
                                    <th scope="col">{{ __('Year') }}</th>
                                    <th scope="col">{{ __('Duty Reliever') }}</th>
                                    <th scope="col">{{ __('Approval') }}</th>
                                    <th scope="col">{{ __('Status') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaves as $leave)
                                    @if ($leave->approval_id == auth()->user()->id and $leave->status == 'Pending')
                                        <tr>
                                            <td>
                                                <a href="{{ route('leave.show', ['leave' =>$leave ]) }}" > {{ $leave->start_date }} </a>
                                                 {{--  @if ($leave->status == 'Pending')
                                                    <a href="{{ route('leave.show', ['leave' =>$leave ]) }}" > {{ $leave->start_date }} </a>
                                                    @else                                 
                                                    {{ $leave->start_date }} 
                                                    
                                                    @endif
                                                --}}
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
                                            <td>{{ $leave->status }}</td>
                                        </tr>
                                    @else
                                        
                                    @endif
 
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