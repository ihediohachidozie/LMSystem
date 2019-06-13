@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@csrf

<div class="row align-items-center">
    <div class="col-md-4">
        <div class="form-group{{ $errors->has('start_date') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-start_date">{{ __('Start Date') }}</label>
            <input type="date" name="start_date"  class="form-control form-control-alternative{{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ old('start_date') ?? $leave->start_date}}">
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
            <input type="number" name="days" id="input-days" class="form-control form-control-alternative{{ $errors->has('days') ? ' is-invalid' : '' }}" max="30" min="1" value="{{ old('days') ?? $leave->days}}">

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
            <select name="year" id="year" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}">
                <option value="">Choose..</option>
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
            <select name="leave_type" id="" class="form-control{{ $errors->has('leave_type') ? ' is-invalid' : '' }}"> 
                <option value="">Choose..</option>
                @foreach ($leaveTypes as $key => $value)
                    <option value="{{$key}}" {{ $leave->leave_type != null ? $key == $leave->leave_type ? 'selected' : '' : ''}}>{{$value}}</option>                      
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
            <select name="duty_reliever" id="" class="form-control{{ $errors->has('duty_reliever') ? ' is-invalid' : '' }}">
               <option value="">Choose...</option>
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
            <select name="approval_id" id="" class="form-control{{ $errors->has('approval_id') ? ' is-invalid' : '' }}">
                <option value="">Choose..</option>
                @foreach ($approvals as $approval)
                    <option value="{{$approval->id}}" {{ $leave->approval_id == $approval->id ? 'selected' : ''}}>{{ $approval->name }}</option>
                @endforeach    
            </select>

            @if ($errors->has('approval_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('approval_id') }}</strong>
                </span>
            @endif
        </div>

    </div> 
    <input type="hidden" name="status" id="status" value="{{$leave->stautus == null ? 0 : $leave->stautus }}"> 
    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->id() }}">
</div>