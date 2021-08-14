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
            :items-per-page="10"
            class="elevation-1 mb-5"
            @click:row="readPosts"
        ></v-data-table>

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
      desserts: [
        {
          content: 'Frozen Yogurt',
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
          iron: '1%',
        }
      ],
      posts : [],

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

    this.$store.dispatch('postIndex')
      .then(response => {
        // console.log('home');
        // console.log(response);
        this.posts = response;
        console.log(this.posts);
      }).catch(err => {
        console.log(err);
    })
  },
  methods: {
    createBoard() {
      this.$router.push('/board/create');
    },
    readPosts(value) {
      console.log(value.id);
      const url = '/board/show/' + value.id;
      this.$router.push(url);
    }
  }
}
</script>

<style scoped>
  .home {
    float: left;

  }
</style>