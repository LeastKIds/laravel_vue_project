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
            :items="desserts"
            :items-per-page="10"
            class="elevation-1 mb-5"
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
        },
        {
          content: 'Ice cream sandwich',
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
          iron: '1%',
        },
        {
          content: 'Eclair',
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
          iron: '7%',
        },
        {
          content: 'Cupcake',
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
          iron: '8%',
        },
        {
          content: 'Gingerbread',
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9,
          iron: '16%',
        },
        {
          content: 'Jelly bean',
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0,
          iron: '0%',
        },
        {
          content: 'Lollipop',
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0,
          iron: '2%',
        },
        {
          content: 'Honeycomb',
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5,
          iron: '45%',
        },
        {
          content: 'Donut',
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9,
          iron: '22%',
        },
        {
          content: 'KitKat',
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7,
          iron: '6%',
        },
      ],
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
  },
  methods: {
    createBoard() {
      this.$router.push('/board/create');
    }
  }
}
</script>

<style scoped>
  .home {
    float: left;

  }
</style>