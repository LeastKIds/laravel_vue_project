<template>
<div style="width : 100%;" class="ma-2">

    <v-row v-for="(comment,index) in data" :key="index" class="ma-2">
      <v-col sm="1" md="1"  v-for="d in comment['deep']" :key="d" class="ma-0 pa-0">
          <p >↳</p>
      </v-col>
      <v-col
      sm="1"
      md="2"
      class="ma-0 pa-0">

        <v-text-field
            label="이름"
            outlined
            readonly
            :value="comment['name']"

        ></v-text-field>
      </v-col>
      <v-col
      class="ma-0 pl-3 pt-0 pb-0 pr-0">
        <v-textarea
            outlined
            name="input-7-4"
            label="댓글"
            :value="comment['content']"
            readonly
            rows="1"
            auto-grow
        ></v-textarea>
      </v-col>
       <Comments v-if="comment['children'] !=''" :data="comment['children']" class="ml-8"/>


    </v-row>

</div>
</template>

<script>
import Comments from './comments.vue';
export default {
  name: "Comments",
  props : ['data'],
  mounted () {
    console.log(this.test);
  },
  data () {
    return {
      test : this.data
    }
  },
  components: {
    Comments,
  },
}
</script>
<style scoped>
</style>