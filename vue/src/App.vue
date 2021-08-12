<template>
  <v-app class="blue-grey lighten-1">
    <v-container style="height : 100%;" fluid class="vContainer mainPage">
      <Sidebar class="app"/>
      <v-main class="main blue-grey darken-1">
          <router-view class="router"/>
      </v-main>
    </v-container>

  </v-app>
</template>

<script>
import Sidebar from './components/Sidebar';

export default {
  name: 'App',
  data: () => ({

  }),
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Sidebar
  }

};
</script>
<style scoped>
  .app {
    float : left;
    width : 250px;
  }
  .vContainer {
    padding : 0;
  }
  .main {
    float : left;
    height : 100%;
    width : 100%;
    margin : auto;
  }
  .mainPage {
    display: flex;
    width : 100%;
    height : 100%;
  }
  .router {
    float : left;
    width : 100%;
    height : 100%;
  }
</style>
