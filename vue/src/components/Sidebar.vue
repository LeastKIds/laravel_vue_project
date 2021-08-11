<template>
  <v-container class="sidebar blue-grey darken-2">
    <v-layout column align-center>
      <v-flex>
        <template>
          <v-card
              class="mx-auto"
              max-width="344"
          >
            <v-img
                :src="require(`@/assets/img/logo/logo.png`)"
                :to="{ path: '/'}"
            ></v-img>

            <v-card-title>
              Top western road trips
            </v-card-title>

            <v-card-subtitle>
              1,000 miles of wonder
            </v-card-subtitle>


          </v-card>
        </template>
      </v-flex>
      <v-flex>
        test
      </v-flex>
    </v-layout>
  </v-container>

</template>

<script>
export default {
  data: () => ({
    show: false,
  }),
}
</script>

<style scoped>
  .sidebar {
    width : 250px;
    height : 100%;
  }
</style>