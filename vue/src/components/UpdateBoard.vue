<template>
  <div>
    <div class="ma-3 blue-grey lighten-5 rounded-lg" >
      <div class="ma-4" >
        <v-card-title>수정하기</v-card-title>
        <v-text-field
            label="제목"
            placeholder="반드시 제목이 있어야 합니다."
            outlined
            v-model="title"
        ></v-text-field>

        <v-textarea
            outlined
            name="input-7-4"
            label="내용"
            v-model="content"
            placeholder="반드시 내용이 있어야 합니다."
        ></v-textarea>

        <v-file-input
            :label="fileLabel"
            filled
            prepend-icon="mdi-camera"
            v-model="imgFile"
        ></v-file-input>
        <v-col class="text-right">
          <v-btn
              color="primary"
              dark
              class="mr-3 mb-5"
              @click="postSave"
          >
            저장
          </v-btn>
        </v-col>


      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: "UpdateBoard",
  data () {
    return {
      title : '',
      content : '',
      imgFile : [],
      fileLabel : '',

    }
  },
  methods: {
    postSave() {

      if(this.title==='' || this.content === '')
      {
        alert('제목이랑 내용은 꼭 필요합니다.');
        return;
      }

      const data = new FormData();
      data.append('title', this.title);
      data.append('content', this.content);
      data.append('imgFile', this.imgFile);
      data.append('postId',this.$route.params.id)

      this.$store.dispatch('postUpdate', data )
          .then(response => {
            console.log(response);
            const url = '/board/show/' + this.$route.params.id;
            this.$router.push(url).catch(()=>{});
          }).catch(err => {
        console.log(err);
      })
    }
  },
  mounted() {
    this.$store.dispatch("postShow",this.$route.params.id)
        .then(response => {
          console.log(response);
          // console.log(response.content);
          this.content = response.content;
          this.title = response.title;
          this.postUserId = response.user_id;
          if(response.img == null)
            this.fileLabel='File input';
          else
            this.fileLabel=response.img;
        }).catch(err => {
      console.log(err);
    })
  }
}
</script>

<style scoped>

</style>