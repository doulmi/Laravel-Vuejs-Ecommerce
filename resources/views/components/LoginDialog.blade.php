<div class="modal fade modal-10" id="loginModal" role="dialog">
  <div class="modal-dialog modal-lg login-modal-dialog ">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="loginmodal-container modal-10-container">
        <div class="login-dialog">
          <img src="{{asset("images/logo-64.png")}}" alt="">
          <h3 class="title">@lang('labels.needAuthenticate')</h3>
          <div>
            <a class="login-btn facebook" href="{{route('redirect', 'facebook')}}">@lang('labels.useFacebookConnect')<i class="fa fa-facebook"></i></a>
            <a class="login-btn twitter" href="{{route('redirect', 'twitter')}}">@lang('labels.useTwitterConnect')<i class="fa fa-twitter"></i></a>
            <a class="login-btn email" href="{{url('login')}}">@lang('labels.useEmailConnect')<i class="fa fa-email"></i></a>
          </div>
          <hr/>
          <div class="toRegister">
            <a href="{{route('register')}}" class="redirect-link">@lang('labels.needAccount')</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>