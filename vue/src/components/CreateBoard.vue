<template>
  <div>
    <div class="ma-3 blue-grey lighten-5 rounded-lg" >
      <div class="ma-4" >
        <v-card-title>글쓰기</v-card-title>
        <v-form @submit.prevent="postSave" ref="form" v-model="valid" lazy-validation>
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
            label="File input"
            filled
            prepend-icon="mdi-camera"
            v-model="imgFile"
        ></v-file-input>
        <v-col class="text-right">
          <v-btn
              color="primary"
              dark
              class="mr-3 mb-5"
              type="submit"
              style="display: inline"
          >
            저장
          </v-btn>
        </v-col>
        </v-form>

      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: "CreateBoard",
  data () {
    return {
      title : '',
      content : '',
      imgFile : [],
      valid : true,
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

        this.$store.dispatch('postSave', data)
          .then(response => {
            console.log(response);
            alert('저장 성공');
            this.$router.push('/').catch(()=>{});
          }).catch(err => {
            console.log(err);
        })
    }
  }
}
</script>

<style scoped>

</style>