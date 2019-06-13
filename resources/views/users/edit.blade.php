@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Edit User')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.update', $user) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required autofocus>
        
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Username') }}</label>
                                            <input type="text" name="username" id="input-name" class="form-control form-control-alternative{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ __('Userame') }}" value="{{ old('username', $user->username) }}" required >
        
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                            <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}" required>
        
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('staff_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-staff_id">{{ __('Staff_id') }}</label>
                                            <input type="text" name="staff_id" id="input-staff_id" class="form-control form-control-alternative{{ $errors->has('staff_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Staff_id') }}" value="{{ old('staff_id', $user->staff_id) }}" required>
                                            
                                            @if ($errors->has('staff_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('staff_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                            <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="">
                                            
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                                            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-department">{{ __('Department') }}</label>
                                            <select name="department_id" id="department_id" class="form-control">
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}" {{ $department->id == $user->department_id ? 'selected' : ''}}>{{ $department->department }}</option>
                                                @endforeach 

                                            </select>       
                                    
                                        @if ($errors->has('department_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('department') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">

                                </div>
                                <hr>
{{--                                 <h3>Activate User</h3>
                                <hr> --}}
                                
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            
                                            <label class="form-control-label" for="input-department">{{ __('Staff Category') }}</label>
                                            <select name="category_id" id="" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
                                                <option value="">Choose..</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id}}" {{ $category->id == $user->category_id ? 'selected' : '' }}>{{ $category->category}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('category_id') ? 'category is required!' : ''}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        
                                        <div class="custom-control custom-checkbox">      
                                            <input type="checkbox" class="custom-control-input" id="permission" name="permission" {{ $user->permission ? 'checked' : 'unchecked'}}>                                         
                                            <label class="custom-control-label" for="permission">Approve Leave</label>
                                        </div>
                                    </div>   
       
                                </div>                         
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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