@extends('app')

@section('content')
  <div class="container">
    <div class=" login-modal " id="login-modal">
      <div class="modal-dialog modal-lg login-modal-dialog ">
        <div class="modal-content">
          <div class="loginmodal-container">
            <div>
              <h2 class="title">@lang('labels.slug')</h2>
              <div>
                {{--<a class="login-btn pinterest" href="{{route('redirect', 'pinterest')}}">@lang('labels.useInterestConnect')<i class="fa fa-pinterest-p"></i></a>--}}
                <a class="login-btn facebook" href="{{route('redirect', 'facebook')}}">@lang('labels.useFacebookConnect')<i class="fa fa-facebook"></i></a>
                <a class="login-btn twitter" href="{{route('redirect', 'twitter')}}">@lang('labels.useTwitterConnect')<i class="fa fa-twitter"></i></a>
              </div>
              <hr class="hr"/>
              <div class="text-or">@lang('labels.useEmailRegister')</div>
              <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" id="register-form">
                {{ csrf_field() }}

                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       placeholder="@lang('validation.attributes.email')" autofocus>

                @if ($errors->has('email'))
                  <div class="error">{{$errors->first('email')}}</div>
                @endif

                <input id="password" type="password" name="password" value="{{ old('password') }}" required
                       placeholder="@lang('validation.attributes.password')">

                @if ($errors->has('password'))
                  <div class="error">{{$errors->first('password')}}</div>
                @endif

                <input id="password-confirm" type="password" name="password_confirmation" required
                       placeholder="@lang('validation.attributes.password_confirmation')">

                <button type="submit" class="loginmodal-submit" @click.stop.prevent="registerAction"
                        :disabled="onRegister" v-html="registerBtnText">@lang('labels.register')</button>
                <hr/>
                <div class="toRegister">
                  <a href="{{route('login')}}" class="redirect-link">@lang('labels.alreadyHaveAccount')</a>
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
        onRegister : false,
      },
      computed: {
        registerBtnText: function() {
          return this.onRegister ? '<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHdpZHRoPScxOHB4JyBoZWlnaHQ9JzE4cHgnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiBjbGFzcz0idWlsLXJpbmciPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSJub25lIiBjbGFzcz0iYmsiPjwvcmVjdD48Y2lyY2xlIGN4PSI1MCIgY3k9IjUwIiByPSI0MCIgc3Ryb2tlLWRhc2hhcnJheT0iMTYzLjM2MjgxNzk4NjY2OTI2IDg3Ljk2NDU5NDMwMDUxNDIiIHN0cm9rZT0iI2ZmZmZmZiIgZmlsbD0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIyMCI+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJyb3RhdGUiIHZhbHVlcz0iMCA1MCA1MDsxODAgNTAgNTA7MzYwIDUwIDUwOyIga2V5VGltZXM9IjA7MC41OzEiIGR1cj0iMXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiBiZWdpbj0iMHMiPjwvYW5pbWF0ZVRyYW5zZm9ybT48L2NpcmNsZT48L3N2Zz4=">' : "@lang('labels.register')";
        },
      },

      methods: {
        registerAction: function() {
          this.onRegister = true;
          $('#register-form').submit();
        }
      }
    })
  </script>
@endsection
