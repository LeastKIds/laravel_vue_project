<template>
  <div>
    <div class="ma-3 blue-grey lighten-5 rounded-lg" >
      <v-card class="ma-3">

      <div class="ma-4" >
        <v-card-title>게시글</v-card-title>
        <v-text-field
            label="제목"
            outlined
            v-model="title"
            readonly
        ></v-text-field>

        <v-text-field
            label="이름"
            outlined
            v-model="name"
            readonly
        ></v-text-field>

        <v-textarea
            outlined
            name="input-7-4"
            label="내용"
            v-model="content"
            readonly
        ></v-textarea>

        <v-card>
          <v-img
              height="300"
              width="300"
              :src="imgFile"
          ></v-img>
        </v-card>



        <v-col class="text-right">
          <v-btn
              color="primary"
              dark
              class="mr-3 mb-5"
              v-if="user_id === postUserId"
              @click="postUpdate"
          >
            수정
          </v-btn>

            <v-btn
                color="warning"
                dark
                class="mr-3 mb-5"
                v-if="user_id === postUserId"
                @click="postDelete"
            >
              삭제
            </v-btn>
          <v-btn
              dark
              class="mr-3 mb-5 light-green lighten-1"
              @click="returnHome"
          >
            목록
          </v-btn>
        </v-col>


      </div>

      </v-card>

    </div>
  </div>
</template>

<script>
export default {
  name: "ShowBoard",
  data () {
    return {
      title : '',
      content : '',
      name : '',
      user_id : null,
      postUserId : '',
      imgFile : '',
    }
  },
  mounted() {
    // console.log(this.$route.params.id)
    this.$store.dispatch("postShow",this.$route.params.id)
      .then(response => {
        console.log(response);
        // console.log(response.content);
        this.content = response.content;
        this.title = response.title;
        this.name = response.name;
        this.postUserId = response.user_id;
        if(response.img === null)
          this.imgFile='https://ifh.cc/g/TQLD0n.jpg';
        else
          this.imgFile = 'http://localhost:8000/storage/img/' + response.img;

      }).catch(err => {
        console.log(err);
    })

    this.user_id = this.$store.state.user.user.id




  },
  methods: {
    postDelete() {
      this.$store.dispatch('postDelete', this.$route.params.id)
        .then(response => {
          console.log(response);
          alert('삭제 완료');
          this.$router.push('/').catch(()=>{});
        }).catch(err => {
          console.log(err);
      })
    },
    postUpdate() {
      const url = '/board/update/' + this.$route.params.id;
      this.$router.push(url);
    },
    returnHome() {
      this.$router.go(-1);
    }
  }
}
</script>

<style scoped>

</style>