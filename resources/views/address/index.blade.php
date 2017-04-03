@extends('app')

@section('content')
  <div class="container">
    <h1>@lang('labels.address.selectAddress')</h1>
    <div>@lang('labels.address.selectAddressH2')</div>
    <div class="row">
      @foreach($address as $adr)
        <div class="col-md-4">
          {{$adr->name}}
          {{$adr->address}}
          {{$adr->city}}, {{$adr->postcode}}
          {{$adr->country}}
          {{$adr->tel}}

          <a href="">@lang('labels.address.sendToThisAddress')</a>
          <div class="col-md-6">@lang('labels.modify')</div>
          <div class="col-md-6">@lang('labels.delete')</div>
        </div>
      @endforeach
    </div>

    <div class="container">
      <div class="profile-container">
        <form action="{{route('address.store')}}" method="post">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-6 info-panel">
              <h3>@lang('labels.addAddress')</h3>
              <div>
                <label for="name" class="field">@lang('labels.address.names')</label>
                <br/>
                <input id="name" type="text" name="name" placeholder="@lang('labels.address.placeholder.names')"
                       value="{{old('name')}}">

                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>

              <div>
                <label for="address" class="field">@lang('labels.address.address')</label>
                <br/>
                <input id="address" type="text" name="address" placeholder="@lang('labels.address.placeholder.address')"
                       value="{{old('address')}}">
                @if ($errors->has('address'))
                  <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                  </span>
                @endif
              </div>

              <div>
                <label for="address2" class="field">@lang('labels.address.address2')</label>
                <br/>
                <input id="address2" type="text" name="address2" placeholder="@lang('labels.address.placeholder.address2')"
                       value="{{old('address2')}}">
                @if ($errors->has('address2'))
                  <span class="help-block">
                    <strong>{{ $errors->first('address2') }}</strong>
                  </span>
                @endif
              </div>

              <div>
                <label for="city" class="field">@lang('labels.address.city')</label>
                <br/>
                <input id="city" type="text" name="city" placeholder="@lang('labels.address.placeholder.city')"
                       value="{{old('city')}}">
                @if ($errors->has('city'))
                  <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                  </span>
                @endif
              </div>

              <div>
                <label for="postcode" class="field">@lang('labels.address.postcode')</label>
                <br/>
                <input id="postcode" type="text" name="postcode" placeholder="@lang('labels.address.placeholder.postcode')"
                       value="{{old('postcode')}}">
                @if ($errors->has('postcode'))
                  <span class="help-block">
                    <strong>{{ $errors->first('postcode') }}</strong>
                  </span>
                @endif
              </div>

              <div>
                <label for="country" class="field">@lang('labels.address.country')</label>
                <br/>
                <input id="country" type="text" name="country" placeholder="@lang('labels.address.placeholder.country')"
                       value="{{old('country')}}">
                @if ($errors->has('country'))
                  <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                  </span>
                @endif
              </div>

              <div>
                <label for="tel" class="field">@lang('labels.address.tel')</label>
                <br/>
                <input id="tel" type="text" name="tel" placeholder="@lang('labels.address.placeholder.tel')"
                       value="{{old('tel')}}">

                @if ($errors->has('tel'))
                  <span class="help-block">
                    <strong>{{ $errors->first('tel') }}</strong>
                  </span>
                @endif
              </div>

              <button class="loginmodal-submit top10" @click.stop.prevent="modifyInfo" :disabled="onModifyInfo"
                      v-html="mofidyInfoBtnText"></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
