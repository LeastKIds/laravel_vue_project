<template>
  <v-container class="sidebar blue-grey darken-2">
    <v-layout column align-center>
      <v-flex>
        <template>
          <v-card
              class="mx-auto"
              max-width="344"
              v-if="!id"
          >
            <v-img
                :src="require(`@/assets/img/logo/logo.png`)"
                @click="home"
            ></v-img>

            <v-col>
              <v-text-field
                  label="이메일"
                  :rules="rulesEmail"
                  hide-details="auto"
                  v-model="email"
                  width="100px"
              ></v-text-field>
              <v-text-field
                  v-model="password"
                  :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                  :rules="rulesPassword"
                  :type="show1 ? 'text' : 'password'"
                  name="input-10-1"
                  label="비밀번호"
                  hint="정확하게 입력"
                  counter
                  @click:append="show1 = !show1"
              ></v-text-field>
            </v-col>


            <v-btn
                  class="ml-8 mt-5 mb-5"
                  color="primary"
                  style="display: inline"
                  @click="login(email,password)"
              >
                로그인
              </v-btn>

              <v-btn
                  class="ma-2"
                  color="warning"
                  style="display: inline"
                  @click="register"
              >
                회원가입
              </v-btn>

              <v-alert
                  type="warning"
                  dismissible
                  v-if="message"
                  class="mt-10"
              >{{message}}</v-alert>



          </v-card>

          <v-card
              class="mx-auto"
              max-width="344"
              v-if="id"
          >
            <v-img
                :src="require(`@/assets/img/logo/logo.png`)"
                @click="home"
            ></v-img>



            <v-col>

              <center>
                <v-list-item-title class="text-h5 mb-1">
                  {{name}}
                </v-list-item-title>
              </center>

            <v-btn
                class="ml-2 mt-5 mb-5"
                color="primary"
                style="display: inline"
                @click="logout"
            >
              로그아웃
            </v-btn>

            <v-btn
                class="ml-3"
                color="warning"
                style="display: inline"
                @click="register"
            >
              내 게시글
            </v-btn>
            </v-col>



          </v-card>
        </template>
      </v-flex>

    </v-layout>
  </v-container>

</template>

<script>

export default {
  data: () => ({
    show: false,
    rulesPassword: [
      value => !!value || '비어있어요',
      value => (value !=null && value.length>=8) || '8자 이상'
    ],
    rulesEmail: [
      value => !!value|| '비어있어요',
      value => /.+@.+/.test(value)|| '이메일이 아니잖어'

    ],
    email : '',
    password : '',
    message : '',
    show1: false,
    show2: true,
    show3: false,
    show4: false,
    id : '',
    name : '',
  }),
  methods: {
    register() {
      this.$router.push('/register').catch(()=>{});
    },
    home() {
      this.$router.push('/').catch(()=>{});
    },
    login(email, password) {
      console.log(email, password);
      this.$store.dispatch('login', {email,password})
        .then( response => {
          // console.log(response);
          const data = response.data;
          this.id = data.user.id;
          this.name = data.user.name;
          this.email = null;
          this.password = null;
          this.$router.push('/').catch(()=>{});
        }).catch( () => {
          alert('로그인 오류');
      })

    },
    logout() {
      this.$store.dispatch('logout')
        .then(response => {
          this.id=null;
          this.name=null;

          console.log(response);
          alert('로그아웃 됨');
          this.$router.push('/');
        })
    }
  },
  mounted() {
    this.$store.dispatch('loginCheck')
        .then(response => {
          this.id=response.user.id;
          this.name=response.user.name;
        }).catch(err => {
      console.log(err);
    });
  }
}
</script>

<style scoped>
  .sidebar {
    height : 100%;
  }
</style>