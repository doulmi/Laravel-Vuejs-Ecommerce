@extends('app')

@section('content')
  <div class="container">
    <div class="profile-container">
      <div class="row">
        <div class="profile-header">
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img :src="user.avatar" class="media-object avatar-rect" alt="">
              </a>
              <input type="file" name="avatar" id="avatar" class="inputfile" @change="uploadAvatar">
              <label for="avatar" class="btn" :disabled="onUploadAvatar" v-html="uploadAvatarText"></label>
            </div>
            <div class="media-body">
              <h4 class="media-heading">{{Auth::user()->email}}</h4>
              <span>注册于: {{Auth::user()->created_at->diffForHumans()}}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 info-panel">
          <h3>个人信息</h3>
          <div>
            <label for="name" class="field">昵称</label>
            <br/>
            <input id="name" type="text" name="name" placeholder="" v-model="user.name">
          </div>

          <div>
            <label for="name" class="field">QQ</label>
            <br/>
            <input id="name" type="text" name="name" placeholder="" v-model="user.QQ">
          </div>

          <div>
            <label for="name" class="field">微信</label>
            <br/>
            <input id="name" type="text" name="name" placeholder="" v-model="user.wechat">
          </div>

          <button class="loginmodal-submit top10" @click.stop.prevent="modifyInfo" :disabled="onModifyInfo"
                  v-html="mofidyInfoBtnText"></button>
          </button>

        </div>
        <div class="col-md-4 pwd-panel">
          <h3>修改密码</h3>
          <div>
            <label for="oldPwd" class="field">当前密码</label>
            <br/>
            <input id="oldPwd" type="password" name="oldPwd" placeholder="******" v-model="oldPwd">
          </div>

          <div>
            <label for="password" class="field">新密码</label>
            <br/>
            <input id="password" type="password" name="password" placeholder="******" v-model="newPwd">
          </div>

          <div>
            <label for="password_confirmed" class="field">确认密码</label>
            <br/>
            <input id="password_confirmed" type="password" name="password_confirmed" placeholder="******"
                   v-model="newPwdConfirmed">
          </div>

          <button class="loginmodal-submit top10" @click.stop.prevent="modifyPwd" :disabled="onModifyPwd"
                  v-html="modifyPwdBtnText"></button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js'></script>
  <script src="{{elixir('js/app.js')}}"></script>
@endsection