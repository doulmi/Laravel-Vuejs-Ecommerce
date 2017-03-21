<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-sm-7">
        <div class="object">
          @lang('labels.object')
        </div>

        <div class="copyright">
          Copyright © {{date('Y')}} Sousoutake All Rights Reserved.<br/>
        </div>

        <div class="contact">
          <span class="contact-icon fa fa-facebook"></span>
          <span class="contact-icon fa fa-pinterest"></span>
          <span class="contact-icon fa fa-twitter"></span>
          <span class="contact-icon fa fa-google"></span>
        </div>
      </div>

      <div class="col-md-5 download col-sm-5">
        <span class="text">@lang('labels.language'):</span>
        <a href="{{route('lang.switch', 'fr')}}" title="@lang('labels.changeToFrench')" class="lang-link {{App::getLocale() == 'fr' ? 'active' : ''}}">
          Français
        </a>
        <a href="{{route('lang.switch', 'en')}}" title="@lang('labels.changeToEnglish')" class="lang-link {{App::getLocale() == 'en' ? 'active' : ''}}">
          English
        </a>
      </div>
    </div>
  </div>
</div>
