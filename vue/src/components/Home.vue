<template>
  <div class="home">
    home
  </div>
</template>

<script>
export default {
  name: "Home",
  mounted() {
    this.$store.dispatch('loginCheck')
        .then(response => {
          console.log(response);
          const login = response['login'];
          // console.log(login);
          if (login ===1) {
            alert('로그인 했음');
            this.$router.push('/');
          }
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