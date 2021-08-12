<template>

    <div class="register">
      <v-card
          class="mx-auto"
          max-width="700"
          style="width : 500px;"
      >
      <form onsubmit="registerButton">


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
              @click:append="show1 = !show1"

          ></v-text-field>
          <v-text-field
              v-model="password_confirmation"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              name="input-10-1"
              label="비밀번호를 다시 입력하세요"
              hint="정확하게 입력"
              counter
              @click:append="show1 = !show1"
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
            class="mt-10"
        >{{message}}</v-alert>


      </form>
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

      rules: [
        value => !!value || 'Required.',
      ],
      show1: false,
      show2: true,
      show3: false,
      show4: false,

    }
  },
  methods: {
    registerButton() {
      const data = {
        'userid' : this.r_email,
        'name' : this.r_name,
        'password' : this.r_pwd
      };


      axios.post('/api/users', data)
          .then(response => {
            console.log(response.status);
            alert('register successful');
            this.$router.push('/');

          })
          .catch(error => {
            console.log(error);
            console.log('register failed');
            this.message='register failed';
          });

    }
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