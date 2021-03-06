@extends('app')

@section('content')
  <div class="container">
    <div class="login-modal" id="login-modaregisterl">
      <div class="modal-dialog modal-lg login-modal-dialog ">
        <div class="modal-content paper">
          <div class="loginmodal-container">
            <div class="login-dialog">
              <h2 class="title">@lang('labels.welcome')</h2>
              <div>
                <a class="login-btn facebook" href="{{route('redirect', 'facebook')}}">@lang('labels.useFacebookConnect')<i class="fa fa-facebook"></i></a>
                <a class="login-btn twitter" href="{{route('redirect', 'twitter')}}">@lang('labels.useTwitterConnect')<i class="fa fa-twitter"></i></a>
              </div>
              <hr class="hr"/>
              <div class="text-or">@lang('labels.useEmailConnect')</div>
              <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" id="login-form">
                {{ csrf_field() }}

                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       autofocus placeholder="@lang('validation.attributes.email')">
                @if ($errors->has('email'))
                  <div class="error">{{$errors->first('email')}}</div>
                @endif

                <input type="password" name="password" placeholder="@lang('validation.attributes.password')" required>
                @if ($errors->has('password'))
                  <div class="error">{{$errors->first('password')}}</div>
                @endif

                <button type="submit" class="loginmodal-submit" @click.stop.prevent="loginAction" :disabled="onLogin"
                        v-html="loginBtnText">@lang('labels.login')</button>

                <div class="login-help text-right">
                  <a href="#" @click.stop.prevent="forgetPwdModal">@lang('labels.forgetPwd')</a>
                </div>
                <hr/>
                <div class="toRegister">
                  <a href="{{route('register')}}" class="redirect-link">@lang('labels.needAccount')</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.min.js"></script>
  <script>
    new Vue({
      el: '#app',
      data: {
        onLogin : false,
      },

      computed: {
        loginBtnText: function() {
          return this.onLogin? '<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHdpZHRoPScxOHB4JyBoZWlnaHQ9JzE4cHgnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiBjbGFzcz0idWlsLXJpbmciPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSJub25lIiBjbGFzcz0iYmsiPjwvcmVjdD48Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiByPSI0MCIgc3Ryb2tlLWRhc2hhcnJheT0iMTYzLjM2MjgxNzk4NjY2OTI2IDg3Ljk2NDU5NDMwMDUxNDIiIHN0cm9rZT0iI2ZmZmZmZiIgZmlsbD0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIyMCI+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJyb3RhdGUiIHZhbHVlcz0iMCA1MCA1MDsxODAgNTAgNTA7MzYwIDUwIDUwOyIga2V5VGltZXM9IjA7MC41OzEiIGR1cj0iMXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiBiZWdpbj0iMHMiPjwvYW5pbWF0ZVRyYW5zZm9ybT48L2NpcmNsZT48L3N2Zz4=">' : "@lang('labels.login')";
        },
      },

      methods: {
        loginAction: function() {
          this.onLogin = true;
          $('#login-form').submit();
        }
      }
    })
  </script>
@endsection

