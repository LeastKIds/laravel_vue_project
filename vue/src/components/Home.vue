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
            prev-icon="mdi-menu-left"
            next-icon="mdi-menu-right"
            :total-visible="7"
            @input="getPosts"
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
          text: '제목',
          align: 'start',
          sortable: false,
          value: 'title',
        },
        { text: '작성자', value: 'name' },
        { text: '날짜', value: 'created_at' },

      ],
      posts : [],
      currentPage : 1,
      lastPage : 0,

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

    if(this.$store.state.post.savePage != 1)
      this.currentPage = this.$store.state.post.savePage;

    this.getPosts();



  },
  methods: {
    createBoard() {
      this.$router.push('/board/create');
    },
    readPosts(value) {
      const url = '/board/show/' + value.id;
      this.$router.push(url);
    },
    getPosts(page) {
      console.log(page);
      this.$store.commit('savePage',page);
      this.$store.dispatch('postIndex', page)
          .then(response => {
            console.log(response);
            this.currentPage = response.current_page;
            this.lastPage = response.last_page;

            return this.posts = response.data;
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