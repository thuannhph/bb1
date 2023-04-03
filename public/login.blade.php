@section('header')
  
  <div class="wrap login">
    <div class="page-login">
      <a href="language.html" class="btn-lang"><i class="far fa-globe"></i></a>
      <div class="container">
        <div class="form-second">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Please enter your username or mobile number">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Enter your Password">
            <button class="btn-eye"><i class="far fa-eye"></i></button>
          </div>
          <div class="form-group">
            <button class="btn-pri">Login</button>
          </div>
          <div class="form-group">
            <button class="btn-pri v2">Sign up</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script type="text/javascript" src="{{ asset('vendor/core/core/js-validation/js/js-validation.js')}}"></script>
  {!! JsValidator::formRequest(\Botble\Member\Http\Requests\LoginRequest::class); !!}
@endpush
