@extends('layouts.app', ['title' => __('System Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Leave Application Form')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">                                   
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Modify Leave Form') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('leave.index')}}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="{{route('leave.approveleave',  $leave->id)}}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            
                            {{-- <h6 class="heading-small text-muted mb-4">{{ __('Department') }}</h6> --}}
                            <div class="pl-lg-4">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-start_date">{{ __('Start Date') }}</label>
                                            <input type="date" name="start_date"  class="form-control form-control-alternative{{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ old('start_date') ?? $leave->start_date}}" disabled>
                                            @if ($errors->has('start_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('days') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-days">{{ __('Number of Days') }}</label>
                                            <input type="number" name="days" id="input-days" class="form-control form-control-alternative{{ $errors->has('days') ? ' is-invalid' : '' }}" max="30" min="1" value="{{ old('days') ?? $leave->days}}" disabled >
        
                                            @if ($errors->has('days'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('days') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('year') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-year">{{ __('Leave Year') }}</label>
                                            <select name="year" id="year" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" disabled>
                                              
                                                @for ($i = 2006; $i < 2050; $i++)
                                                    
                                                    <option value="{{$i}}" {{ $leave->year == $i ? 'selected' : ''}}>{{ $i}}</option>
                                                   
                                                @endfor
                                            </select>
        
                                            @if ($errors->has('year'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>    
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('leave_type') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-leave_type">{{ __('Leave Type') }}</label>
                                            <select name="leave_type" id="" class="form-control{{ $errors->has('leave_type') ? ' is-invalid' : '' }}" disabled>
                                                
                                                @foreach ($leaveTypes as $key => $value)
                                                
                                                    <option value="{{$key}}"{{ $leave->leave_type == $key ? 'selected' : ''}}>{{$value}}</option>
                                                       
                                                @endforeach

                                            </select>
        
                                            @if ($errors->has('leave_type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('leave_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('duty_reliever') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-duty_reliever">{{ __('Duty Reliever') }}</label>
                                            <select name="duty_reliever" id="" class="form-control{{ $errors->has('duty_reliever') ? ' is-invalid' : '' }}" disabled>
                                              
                                                @foreach ($users as $user)
                                                    
                                                        <option value="{{$user->id}}" {{ $leave->duty_reliever == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                                              
                                                @endforeach    
                                            </select>
        
                                            @if ($errors->has('duty_reliever'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('duty_reliever') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('approval_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-approval_id">{{ __('Approval ID') }}</label>
                                            <select name="approval_id" id="" class="form-control{{ $errors->has('approval_id') ? ' is-invalid' : '' }}" disabled>
                                                
                                                @foreach ($users as $user)
                                                    
                                                        <option value="{{$user->id}}" {{ $leave->approval_id == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                                                   
                                                    
                                                @endforeach    
                                            </select>
        
                                            @if ($errors->has('approval_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('approval_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div> 
                                    
      {{--                               <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
                                    <input type="hidden" name="oldday" id="olday" value="{{ $leave->days}}"> --}}
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="status" class="custom-control-input" id="customRadio5" type="radio" value="1">
                                                <label class="custom-control-label" for="customRadio5">Reject</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-radio mb-3">
                                                <input name="status" class="custom-control-input" id="customRadio6" checked="" type="radio" value="2">
                                                <label class="custom-control-label" for="customRadio6">Approve</label>
                                            </div> 
                                        </div>
                                    </div>


                                    {{-- <input type="hidden" name="status" id="status" value="{{0}}">  --}}   
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Submit') }}</button>
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