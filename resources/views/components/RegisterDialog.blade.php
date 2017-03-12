<div class="modal fade " id="registerModal" role="dialog">
  <div class="modal-dialog modal-lg login-modal-dialog ">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="loginmodal-container modal-10-container">
        <div class="login-dialog">
          <img src="{{asset("images/logo-64.png")}}" alt="">
          <h2 class="title">@lang('labels.welcome')</h2>
          <p>
            @lang('labels.intro')
          </p>
          <div>
            <a class="login-btn facebook" href="{{route('redirect', 'facebook')}}">@lang('labels.useFacebookConnect')<i class="fa fa-facebook"></i></a>
            <a class="login-btn twitter" href="{{route('redirect', 'twitter')}}">@lang('labels.useTwitterConnect')<i class="fa fa-twitter"></i></a>
            <a class="login-btn email" href="{{url('register')}}">@lang('labels.useEmailRegister')<i class="fa fa-email"></i></a>
          </div>
          <hr/>
          <div class="toRegister">
            <a href="{{route('login')}}" class="redirect-link">@lang('labels.alreadyHaveAccount')</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>