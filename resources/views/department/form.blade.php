@csrf
<div class="form-group{{ $errors->has('department') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-name">{{ __('Department') }}</label>
    <input type="text" name="department" id="input-name" class="form-control form-control-alternative{{ $errors->has('department') ? ' is-invalid' : '' }}" placeholder="{{ __('Department') }}" value="{{ old('department') ?? $department->department}}" required autofocus>

    @if ($errors->has('department'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('department') }}</strong>
        </span>
    @endif
</div>