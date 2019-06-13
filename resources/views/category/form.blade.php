@csrf
                            
{{--    <h6 class="heading-small text-muted mb-4">{{ __('Department') }}</h6> 
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif   --}}
       <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
           <label class="form-control-label" for="input-name">{{ __('Category') }}</label>
           <input type="text" name="category" id="input-name" class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}" placeholder="{{ __('Category') }}" value="{{ old('category') ?? $category->category}}" required autofocus>

           @if ($errors->has('category'))
               <span class="invalid-feedback" role="alert">
                   <strong>{{ $errors->first('category') }}</strong>
               </span>
           @endif
       </div>

       <div class="form-group{{ $errors->has('days') ? ' has-danger' : '' }}">
           <label class="form-control-label" for="input-name">{{ __('Days Approved') }}</label>
           <input type="number" name="days" max="30" min="1" id="input-name" class="form-control form-control-alternative{{ $errors->has('days') ? ' is-invalid' : '' }}" placeholder="{{ __('Days') }}" value="{{ old('days') ?? $category->days}}" required>

           @if ($errors->has('days'))
               <span class="invalid-feedback" role="alert">
                   <strong>{{ $errors->first('days') }}</strong>
               </span>
           @endif
       </div>     