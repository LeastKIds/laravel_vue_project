<template>
  <div>
    <div class="ma-3 blue-grey lighten-5 rounded-lg" >
      <div class="ma-4" >
        <v-card-title>글쓰기</v-card-title>
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


        <v-col class="text-right">
          <v-btn
              color="primary"
              dark
              class="mr-3 mb-5"
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
  name: "ShowBoard",
  data () {
    return {
      title : '',
      content : '',
      name : '',
    }
  },
  mounted() {
    console.log(this.$route.params.id)
    this.$store.dispatch("postShow",this.$route.params.id)
      .then(response => {
        console.log(response);
        // console.log(response.content);
        this.content = response.content;
        this.title = response.title;
        this.name = response.name;
      }).catch(err => {
        console.log(err);
    })
  }
}
</script>

<style scoped>

</style>