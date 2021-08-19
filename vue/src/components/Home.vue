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
              @click="searchPosts"
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
      page : '',
      search : '',


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


    console.log('*******************');
    console.log(this.$route.query.search);
    console.log(this.$route.query.page);
    console.log('********************');



    if(this.$route.query.search ) {
      this.search = this.$route.query.search;
      this.word = this.search;
    }

    if(this.$route.query.page !='')
      this.page = this.$route.query.page;


    // this.$store.dispatch('postIndex', {search : this.search, page : this.page})
    //     .then(response => {
    //       console.log(response);
    //       this.currentPage = response.current_page;
    //       this.lastPage = response.last_page;
    //
    //       return this.posts = response.data;
    //     }).catch(err => {
    //   console.log(err);
    // });
    this.postFunction(this.page);

  },
  methods: {
    createBoard() {
      this.$router.push('/board/create');
    },
    readPosts(value) {
      const url = '/board/show/' + value.id;
      this.$router.push(url);
    },
    getPosts(value) {
      console.log('--------------------');
      console.log(value);
      console.log('--------------------');
      let url = '/';
      if(this.search != '') {
        url +='?search=' + this.word + '&page=' + value;
      } else {
        url +='?page=' + value;
      }
      this.$router.push(url).catch(()=>{});
      console.log(url);

      this.postFunction(value)

    },
    postFunction (value) {
      this.$store.dispatch('postIndex', {search : this.search, page : value})
          .then(response => {
            console.log(response);
            this.currentPage = response.current_page;
            this.lastPage = response.last_page;

            return this.posts = response.data;
          }).catch(err => {
        console.log(err);
      });
    },
    searchPosts() {
      this.search = this.word;
      this.getPosts(1);
    }

  },

}
</script>

<style scoped>
  .home {
    float: left;

  }
</style>