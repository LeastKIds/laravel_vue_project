<template>
  <div>
    <div class="ma-3 blue-grey lighten-5 rounded-lg" >
      <div class="ma-4" >
        <v-card-title>글쓰기</v-card-title>
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
  name: "CreateBoard",
  data () {
    return {
      title : '',
      content : '',
      imgFile : [],
    }
  },
  methods: {
    postSave() {
        const data = new FormData();
        data.append('title', this.title);
        data.append('content', this.content);
        data.append('imgFile', this.imgFile);

        this.$store.dispatch('postSave', data)
          .then(response => {
            console.log(response);
            alert('저장 성공');
          }).catch(err => {
            console.log(err);
        })
    }
  }
}
</script>

<style scoped>

</style>