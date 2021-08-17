<template>
  <div class="home">
    <div class="ma-3 blue-grey lighten-5 rounded-lg" >
      <div class="ma-4" >
        <v-card-title>게시판</v-card-title>

        <v-container>
          <v-layout row>
            <v-col
                cols="5"
                sm="3"
                md="3"
            >
              <v-text-field
                  label="검색"
                  v-model="word"
              ></v-text-field>

              </v-col>
            <v-col>
              <v-btn
              elevation="2"
              @click="getPosts"
              >
                검색
              </v-btn>
            </v-col>
            <v-col
                cols="5"
                sm="3"
                md="3">
              <v-btn
                  class="mb-2"
                  color="primary"
                  style="display: inline;"
                  @click="createBoard"
              >
                글 쓰기
              </v-btn>
            </v-col>
          </v-layout>

        </v-container>

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
            class="mb-3"
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
        { text: '날짜', value: 'day'},

      ],
      posts : [],
      currentPage : 1,
      lastPage : 0,
      word : '',
      search : false,


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
    if(this.$store.state.post.word !='')
      this.word=this.$store.state.post.word;

    this.getPosts();



  },
  methods: {
    createBoard() {
      this.$router.push('/board/create');
    },
    readPosts(value) {
      if(this.word !='')
        this.$store.commit('saveSearch',this.word);

      const url = '/board/show/' + value.id;
      this.$router.push(url);
    },
    getPosts(value) {
      console.log('--------------------');
      console.log(value);
      console.log('--------------------');
      this.$store.commit('savePage',this.currentPage);
      if(this.word === '') {
        this.$store.dispatch('postIndex', this.currentPage)
            .then(response => {
              console.log(response);
              this.currentPage = response.current_page;
              this.lastPage = response.last_page;

              return this.posts = response.data;
            }).catch(err => {
          console.log(err);
        });
      } else {
        const payload = {'word' : this.word, 'page' : value};
        this.$store.dispatch('postSearch', payload)
            .then(response => {
              this.currentPage = response.data.current_page;
              this.lastPage = response.data.last_page;
              this.posts = response.data.data;
              console.log(this.currentPage);
              console.log(this.lastPage);
              this.search=true;
            }).catch(err => {
          console.log(err);
        })
      }


    },

  },

}
</script>

<style scoped>
  .home {
    float: left;

  }
</style>