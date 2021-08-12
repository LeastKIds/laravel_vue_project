<template>
    <div class="register">
      <v-card
          class="mx-auto"
          max-width="700"
          style="width : 500px;"
      >
      <v-form @submit.prevent="registerButton">
        <v-col>
          <v-text-field
              label="아이디"
              :rules="rules"
              hide-details="auto"
              v-model="email"
              width="100px"
          ></v-text-field>
          <v-text-field
              v-model="password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              name="input-10-1"
              label="비밀번호"
              hint="정확하게 입력"
              counter
              :rules="rules"
              @click:append="show1 = !show1"

          ></v-text-field>
          <v-text-field
              v-model="password_confirmation"
              :append-icon="show5 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show5 ? 'text' : 'password'"
              name="input-10-1"
              label="비밀번호를 다시 입력하세요"
              hint="정확하게 입력"
              counter
              :rules="passwordRules"
              @click:append="show5 = !show5"
          ></v-text-field>
          <v-text-field
              label="이름"
              :rules="rules"
              hide-details="auto"
              v-model="name"
              width="100px"
          ></v-text-field>
        </v-col>
        <v-btn
            class="registerBtn"
            color="warning"
            style="display: inline"
            type="submit"

        >
          회원가입
        </v-btn>

        <v-alert
            type="warning"
            dismissible
            v-if="message"
            class="mt-5 mb-5"
        >{{message}}</v-alert>

      </v-form>
      </v-card>

    </div>
</template>



<script>
import axios from 'axios';

export default {
  name: "Register",
  data () {
    return {
      email : '',
      name : '',
      password : '',
      password_confirmation : '',
      message : '',
      check1:false,
      check2:false,
      check3:false,

      rules:
        {
          rulesName = value => (!!value, this.check1=true ) || '비어있어요',
        }

      passwordRules: [
          value => this.password == value || '비밀번호가 틀려요!!'
      ],
      show1: false,
      show2: true,
      show3: false,
      show4: false,
      show5: false,

    }
  },
  methods: {
    registerButton() {
      console.log(this.check1);
      const data = {
        'email' : this.email,
        'name' : this.name,
        'password' : this.password
      };


      axios.post('/api/register', data)
          .then(response => {
            console.log(response.status);
            console.log(response);
            alert('register successful');
            // this.$router.push('/');

          })
          .catch(error => {
            console.log(error);
            console.log('register failed');
            this.message='회원가입 실패';
          });

    }
  },
  mounted() {
    this.$store.dispatch('loginCheck')
      .then(response => {
        console.log(response);
        const login = response['login'];
        // console.log(login);
        if(login === 0 ) {
          alert('로그인 안 했음');
        }else if (login ===1) {
          alert('로그인 했음');
        }
      }).catch(err => {
        console.log(err);
    });
  }
}
</script>

<style scoped>
  .register {
    margin-top : 15%;
    margin-left : -8%;
  }
  .registerBtn {
    margin-left : 40%;
    margin-bottom : 20px;
    margin-top : 10px;
  }
</style>