<template>
  <v-container class="sidebar blue-grey darken-2">
    <v-layout column align-center>
      <v-flex>
        <template>
          <v-card
              class="mx-auto"
              max-width="344"
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
        </template>
      </v-flex>
      <v-flex class="mt-5">
        <template>
          <v-card
              class="mx-auto"
              max-width="344"
          >
            <v-img
                :src="require(`@/assets/img/logo/logo.png`)"
                :to="{ path: '/'}"
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
      value => value.length>=8 || '8자 이상'
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
          // this.$router.go();
          console.log(response);
        }).catch( () => {
          alert('로그인 오류');
      })

    }
  }
}
</script>

<style scoped>
  .sidebar {
    height : 100%;
  }
</style>