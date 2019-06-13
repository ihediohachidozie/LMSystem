@csrf
<div class="form-group{{ $errors->has('publicholiday') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-name">{{ __('Public Holiday') }}</label>
    <input type="text" name="publicholiday" id="input-name" class="form-control form-control-alternative{{ $errors->has('publicholiday') ? ' is-invalid' : '' }}" placeholder="{{ __('Public Holiday') }}" value="{{ old('publicholiday') ?? $publicholiday->publicholiday}}" autofocus>

    @if ($errors->has('publicholiday'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('publicholiday') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-name">{{ __('Date') }}</label>
    <input type="date" name="date" id="input-name" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{ old('date') ?? $publicholiday->date}}">

    @if ($errors->has('date'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('date') }}</strong>
        </span>
    @endif
</div>