<template>
  <v-app>
    <v-container style="height : 100%;" fluid class="vContainer">
      <Sidebar class="app"/>
      <v-main class="app" id="main">
        <router-view/>
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
  }
  .vContainer {
    padding : 0;
  }
  #main {
    margin-left : 10px;
  }
</style>
