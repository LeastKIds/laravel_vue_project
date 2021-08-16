<template>
  <div class="home">
    <div class="ma-3 blue-grey lighten-5 rounded-lg" >
      <div class="ma-4" >
        <v-card-title>게시판</v-card-title>
        <v-btn
            class="mb-2"
            color="primary"
            style="display: inline;"
            @click="createBoard"
        >
          글 쓰기
        </v-btn>
        <v-data-table
            :headers="headers"
            :items="posts"
            class="elevation-1 mb-5"
            @click:row="readPosts"
            hide-default-footer
            disable-pagination
        ></v-data-table>

        <v-pagination
            v-model="currentPage"
            :length="lastPage"
            @input="getPosts"
            :total-visible="8"

        ></v-pagination>

      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: "Home",
  data () {
    return {
      id : '',
      name : '',
      headers: [
        {
          text: '내용',
          align: 'start',
          sortable: false,
          value: 'content',
        },
        { text: '작성자', value: 'name' },
        { text: '날짜', value: 'created_at' },

      ],
      posts : [],
      currentPage : 1,
      lastPage : Number,
    }

  },
  mounted() {
    this.$store.dispatch('loginCheck')
        .then(response => {
          // console.log(response);
          this.id=response.user.id;
          this.name = response.user.name;
        }).catch(err => {
      console.log(err);
    });
    this.getPosts();



  },
  methods: {
    createBoard() {
      this.$router.push('/board/create');
    },
    readPosts(value) {
      console.log(this.page);
      // console.log(value);
      this.$store.commit('savePage',this.page);
      const url = '/board/show/' + value.id;
      this.$router.push(url);
    },
    getPosts() {
      this.$store.dispatch('postIndex', this.currentPage)
          .then(response => {
            // console.log('home');
            console.log(response);
            this.currentPage = response.currentPage;
            this.lastPage = response.last_page;
            // this.currentPage = 1;
            // this.lastPage = 9;
            this.posts = response.data;
            // console.log(this.posts);
          }).catch(err => {
        console.log(err);
      });
    }
  }
}
</script>

<style scoped>
  .home {
    float: left;

  }
</style>