<template>
    <div class="register">
      <v-card
          class="mx-auto"
          max-width="700"
          style="width : 500px;"
      >
      <v-form @submit.prevent="registerButton" ref="form" v-model="valid" lazy-validation>
        <v-col>
          <v-text-field
              label="이메일"
              :rules="rulesEmail"
              hide-details="auto"
              v-model="email"
              width="100px"
              required
          ></v-text-field>
          <v-text-field
              v-model="password"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show1 ? 'text' : 'password'"
              name="input-10-1"
              label="비밀번호"
              hint="정확하게 입력"
              counter
              :rules="rulesPassword"
              @click:append="show1 = !show1"
              required

          ></v-text-field>
          <v-text-field
              v-model="password_confirmation"
              :append-icon="show5 ? 'mdi-eye' : 'mdi-eye-off'"
              :type="show5 ? 'text' : 'password'"
              name="input-10-1"
              label="비밀번호를 다시 입력하세요"
              hint="정확하게 입력"
              counter
              :rules="rulesConfirmation"
              @click:append="show5 = !show5"
              required
          ></v-text-field>
          <v-text-field
              label="이름"
              :rules="rulesName"
              hide-details="auto"
              v-model="name"
              width="100px"
              required
          ></v-text-field>
        </v-col>
        <v-btn
            class="registerBtn"
            color="warning"
            style="display: inline"
            type="submit"
            :disabled="!valid"
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
      checkName:false,
      checkEmail1:false,
      checkEmail2:false,
      checkPassword:false,

      rulesName: [
        value => !!value || '비어있어요',
      ],
      rulesPassword: [
        value => !!value || '비어있어요',
        value => value.length>=8 || '8자 이상'

      ],
      rulesEmail: [
          value => !!value|| '비어있어요',
          value => /.+@.+/.test(value)|| '이메일이 아니잖어'
      ],
      rulesConfirmation: [
        value => this.password == value || '비밀번호가 틀려요!!',
        value => (!!value) || '비어있어요'
      ],


      show1: false,
      show2: true,
      show3: false,
      show4: false,
      show5: false,
      valid : true,

    }
  },
  methods: {
    registerButton() {
      console.log(this.checkName);
      const data = {
        email : this.email,
        name : this.name,
        password : this.password
      };


      axios.post('http://3.36.124.105:8000/register', data)
          .then(response => {
            console.log(response.status);
            console.log(response);
            alert('로그인 성공');
            this.$router.push('/');

          })
          .catch(error => {
            console.log(error.response.data);
            const mEmail = error.response.data['email'];
            const mPassword = error.response.data['password'];
            const mName = error.response.data['name'];

            if(mEmail !=null)
              this.message = `[email] => ${mEmail}`;
            if(mPassword !=null)
              this.message = `${this.message} | [password] => ${mPassword}`;
            if(mName !=null)
              this.message = `${this.message} | [name] => ${mName}`;



            console.log('register failed');
            alert('회원가입 실패');
          });

    },
    validate() {
      this.$refs.form.validate();
    }
  },
  mounted() {
    this.$store.dispatch('loginCheck')
      .then(response => {
        console.log(response);
        const id=response.user.id;
        // console.log(login);
        if (id != null) {
          alert('로그인 했음');
          this.$router.push('/').catch(()=>{});
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