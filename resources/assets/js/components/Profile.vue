<template>
  <div class="container">
    <div v-if="isLoading">
      <LoadProgress />
    </div>

    <transition name="fade">
      <div v-if="error">
        <div class="error-panel hidden" id="error">
          似乎网络出了些问题，再试着加载一下吧
        </div>
      </div>
    </transition>

    <div class="profile-container" v-if="!isLoading">
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
              <h4 class="media-heading">{{user.email}}</h4>
              <span>注册于: {{user.created_at}}</span>
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
            <label for="qq" class="field">QQ</label>
            <br/>
            <input id="qq" type="text" name="name" placeholder="" v-model="user.QQ">
          </div>

          <div>
            <label for="wechat" class="field">微信</label>
            <br/>
            <input id="wechat" type="text" name="name" placeholder="" v-model="user.wechat">
          </div>

          <button class="loginmodal-submit top10" @click.stop.prevent="modifyInfo" :disabled="onModifyInfo" v-html="mofidyInfoBtnText"></button></button>

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
            <input id="password_confirmed" type="password" name="password_confirmed" placeholder="******" v-model="newPwdConfirmed">
          </div>

          <button class="loginmodal-submit top10" @click.stop.prevent="modifyPwd" :disabled="onModifyPwd" v-html="modifyPwdBtnText"></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import * as consts from '../utils/consts.js'
  import LoadProgress from '../components/LoadProgress.vue'
  // import NProgress from 'nprogress'
  import toastr from 'toastr'
  export default {
    data() {
      return {
        user: {},
        oldPwd: '',
        newPwd: '',
        newPwdConfirmed: '',
        onModifyInfo: false,
        onModifyPwd: false,
        onUploadAvatar: false,
        isLoading: true,
        error: false,
      }
    },
    components: {
      'LoadProgress': LoadProgress
    },
    mounted() {
      this.$nextTick(function () {
        // NProgress.set(0.4);
        this.$http.get('/api/user').then(response => {
          let user = response.body;
          if (!user.avatar.startsWith('https:')) {
            user.avatar = '../..' + user.avatar;
          }
          this.user = user;
          this.isLoading = false;
          // NProgress.done();
        }, response => {
          this.error = true;
          console.log("api error profile page mounted")
          // NProgress.done();
        });
      })
    },
    methods: {
    },
    computed: {
      mofidyInfoBtnText() {
        return this.onModifyInfo ? '<img src="' + consts.loading + '">' : '修改资料';
      },
      modifyPwdBtnText() {
        return this.onModifyPwd ? '<img src="' + consts.loading + '">' : '修改密码';
      },
      uploadAvatarText() {
        return this.onUploadAvatar ? '<img src="' + consts.loading + '">' : '上传';
      }
    },
    methods: {
      uploadAvatar(e) {
        this.onUploadAvatar = true;
        const avatar = e.target.files[0];
        let data = new FormData();
        data.append('avatar', avatar);
        this.$http.post('/api/user/avatar', data).then(response => {
          this.onUploadAvatar = false;
          this.$store.dispatch('setAvatar', response.body.avatar);
          this.user.avatar = response.body.avatar;
        }, errors => {
          this.onUploadAvatar = false;
          toastr.error(errors.body.message);
          console.log(response);
        });
      },
      modifyInfo() {
        this.onModifyInfo = true;
        const data = {
          name: this.user.name,
          QQ: this.user.QQ,
          wechat: this.user.wechat
        }
        this.$http.put('/api/user', data).then(response => {
          this.onModifyInfo = false;
          toastr.success('个人信息更新成功')
        }, errors => {
          this.onModifyInfo = false;
          toastr.error(errors.body.message);
        })
      },
      modifyPwd() {
        this.onModifyPwd = true;
        const data = {
          password: this.newPwd,
          oldPwd: this.oldPwd,
          password_confirmation: this.newPwdConfirmed,
        };
        this.$http.put('/api/user/modifyPwd', data).then(response => {
          this.onModifyPwd = false;
          this.newPwd = '';
          this.oldPwd = '';
          this.newPwdConfirmed = '';
          toastr.success('密码修改成功')
        }, errors => {
          this.onModifyPwd = false;
          toastr.error(errors.body.message);
        });
      }
    }
  }
</script>