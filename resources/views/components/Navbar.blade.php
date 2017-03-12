<div>
  @include('components.RegisterDialog')
  @include('components.LoginDialog')
  <nav class="navbar navbar-default navbar-guest navbar-fixed-top" id='navbar' role="navigation">
    <div class="center-logo">
      <img id='logo' src="{{asset('images/logo-32x32.png')}}" data-toggle="tooltip"
           data-placement="bottom" title="@lang('labels.index')">
      <img id='goTop' class="goTop"
           src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAALRJREFUSA3tkF0KwjAQhPvSXw%2FoQXqBnkgQBEEEjxa%2Fga4skb7UNC9uYNhtdpkvnaaJEwlEApFA7QRSSiepKhfghF6rpipwYCN6Ijvqx0PhAAb0MKKruhsOgWPco7uD5a1mfVE4hh26ZaSFb8kf7XRF4Bi16Ord6RczV5%2FNtNvafHfFZM6MP1AzZZ7DZ5vtrno9uqzwL6gZO7h2f%2F9jGcsInQ2yVbVTDLoFiftIIBKIBP4vgTf4yBMix6CaBQAAAABJRU5ErkJggg%3D%3D"
           data-toggle="tooltip" data-placement="bottom" title="@lang('labels.goTop')">
    </div>

    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" id="navbar-toggle" data-toggle="collapse"
                data-target="#navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        {{--<a class="navbar-brand tooltips-bottom " href="{{route('index')}}" data-tooltips="@lang('labels.index')">--}}
        {{--          <img class="logo-text" src="{{asset('images/logo-text.png')}}" alt="Sousoutake">--}}
        {{--</a>--}}
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="hidden-xs">
            <a href="{{route('index')}}" class="NavbarIconText">
              <img class="NavbarIcon"
                   src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAATtJREFUSA1jYBgFdAoBZjLtYQTqcwViKSB%2BRKYZJGtjA%2BrYCMT%2FoXgekCbXA0CtxAFOoLIdQAyzFEavBoqxEmcE6aq4gVr2ATHMMnR6G1AO5DCqAj6gaUeBGN0ydP5BoBqQWqoAIaApp4EY3RJc%2FDNAtcKU2iwKNOAiCZbCHHMVqAeU4skCkkBd14AYZhip9F2gXkVSbZYFarhNgaUwRz4FmqFJrOWCQIUg18I0U0q%2FAJolQozlfVS0FObomcRY%2FJIGFmMUq6AyFx2AXEkLgGIXE5k2OAD1gQwCYUcgJhmguAKqmxgfo%2BsjWQ%2B5PibZh%2BgaRi1GDxGa8UeDGhS0bwiELzZ5bGLIxnxB5oDY2Bpp94DiTkDMBVKABkAWZADxdTTx30A%2BqBb6DsQgS5DxayC%2FFojPAfEoGEEhAAAgoKfddcxKHQAAAABJRU5ErkJggg%3D%3D"
                   alt="">
              <span class="NavbarText">@lang('labels.index')</span>
            </a>
          <li>
            <a href='{{route('shop')}}' class="NavbarIconText">
              <img class="NavbarIcon"
                   src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAArtJREFUSA3tlTloVFEUhp%2B7ERFEjRthcEkqUbGJiiiYQhQ7BW3EQrCxsRFBsEtQC20srAQbQRELEYkI6YxooyBoo2EmwR0RJLiv3z%2Fzzst5l7fMjHZ64Jt7zj3Lfe%2FeM%2FdF0b8mk9p44Qo5y2BxnPuSsQqjsf1XBy1yAh7DrxzkOwlL4Y9lBhX64QPkLRjOfyT2FMyCtmQBWcMQFm7Wvk9uV6srd5LwNGPREeYGoA96oBu2wHF4COFDvWJO%2FdCUTCfqNvgi49iHYCrkiRp1L7wBn%2FsAuwNKRQ3iE8ewV5dmTQRUUB%2BBr3F6wp2t6Uw%2BuSS96ars0MJZLf4abPHP6IXnfdYFK%2BkglMl8AvbBBTgMJrtRbGGNZ8wRjjqj52DBT9DzznQFvmMwDD%2FAcobQvaizzVfzDq%2Bvc0EK1v83S%2FRWfjErrHEgSDiK7f2Zx7YnCNJfJhS9qS36HV34whuDhE2Bf5f5J5vCaHevTWnbQ9HDKUfNshK6Y50hegt3pTjRPe6lYoY%2Fw2k2GY%2FfAlvmznhOna%2Bi6gvpM2EQfoKXKd5A1%2B7UxS8cPp12YCSO06Du7Y3tuYxqPol0ydXGkPpdlLIaf7H6lN9qXRReNngDfTv4%2BC5sIbkJ1%2Bta%2Bmd92ky9SOLSVfkerFnuJZ6Gct75FKOv0A3YD37nMBO5g2b13qGHW58EXnaBStiReKLoCLq%2BuedAZ90BRbINpy2q8WJRsM7QB9ew9XlsVdQPVbBaarq1ZUWuuAQlarvmlSU5v2L9FqvGJefPVdXNajR7Wo3q7s1QJopRrM%2BtYev73pSsIWocfAHpt%2BAA9MDsGOmaky%2BMV41WPqmEN84kfPOwcJH9jBq6%2F9uShWRdg6IFsnyD5Cxpa8UgSZe9in2BrIU09xW03VuhVHTXtiJzCO6D5aAmVP4LqMIQ6AL6L5k78BsRYQVr1tXnqgAAAABJRU5ErkJggg%3D%3D"
                   alt="">
              <span class="NavbarText">@lang('labels.shop')</span>
            </a>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())

            <li class="nav-btn">
              <a href="#" class="icon-link">
                <img
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAF1QAABdUBACpHLgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAH2SURBVEiJrdU9aBRBFMDx35wHIRYRkSgSIgh+QEAFNZVNFMVSwUqwsLVMYWEpVmIvWAQFQUQQi2ApWEQbTRBJLEylIoKiCIoiuctY7ByZ7G1uc5oHj51l3rz/vI+ZCTFGVRJCmMAxHEk6iDnMJp2OMS5VLs4lxrhKMYyHiDU6hwPl9V3+Ss7P4nPmZBlvcQ9TeIWlbP4PriDUAjCOVrb4LoYrIhzEtRLoUk8ABrCQjH/hTG3oRV3epzU/sLsX4Hq2m8k65xnkREpjxNOqVHUMvyWjGTTWC0hrb2ab21eeb4QQ9mBraqqpGONybeutllvZ+HB5spGK25GXfTqHeUXdKOrSBTiUxi286dd7jLGN1+n3YBXgYxo3saNfQJLR9P1SBXiR/XeFWCchhBGMpN+FKkDndMKpfgE4nY3nu2ZTqz1RtFkL43206HZFWiI+YPNa52C/ohNiCnNoHc6beGTlDJyvu4smM+N3ONnD+Ziidh37Z2vZhs57EEJo4AHOZRl8jOeK8/Fb0QTjyWYgs/uKiRhjdQ1Ku7uI79nuemkexSfs7fkeZJBR3MGilcuso21M42iyvVpK7a5aQAm2BccVj9EYBipsbmSQRexcN+Afb9V5bNtoQMDtDDKLoQ0DJMgm3M8gl5tdbfUfEmNshxAu4KfiCpn5C2weDFtm9ILBAAAAAElFTkSuQmCC"
                  alt="">
              </a>
            </li>

            <li class="dropdown profile-btn ">
              <a href="#" class="avatar" data-toggle="dropdown" role="button" aria-haspopup="true"
                 aria-expanded="true">
                <img class='avatar avatar-small hover-overlay' src="{{Auth::user()->avatar}}"/>
              </a>

              <ul class="dropdown-menu" role="menu">
                @if(Auth::user()->isAdmin)
                  <li>
                    <a href="{{route('admin.index')}}">
                      @lang('labels.adminPanel')
                    </a>
                  </li>
                @endif
                <li>
                  <a href="{{route('profile', Auth::id())}}">
                    <div class="Text-Black">{{ title_case(Auth::user()->name) }}</div>
                    @lang('labels.profile')
                  </a>
                </li>

                <li>
                  <a href="{{route('likes', Auth::id())}}">
                    @lang('labels.likes')
                  </a>
                </li>

                <li>
                  <a href="{{route('collections', Auth::id())}}">
                    @lang('labels.collections')
                  </a>
                </li>

                <li>
                  <a href="{{route('logout')}}">
                    @lang('labels.logout')
                  </a>
                </li>
              </ul>
            </li>
          @else
            <li>
              <a class="login-btn" href="{{url('login')}}">@lang('labels.login')</a>
            </li>
            <li>
              <a class="register-btn pointer" data-toggle="modal" type="button"
                 data-target="#registerModal">@lang('labels.register')</a>
            </li>
          @endif
          <li>
            <a class="panier-btn pointer">0</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
