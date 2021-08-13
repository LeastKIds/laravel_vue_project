<template>
  <div class="home">
    <div class="ma-3 blue-grey lighten-5">
      home
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
  }
}
</script>

<style scoped>
  .home {
    float: left;
  }
</style>