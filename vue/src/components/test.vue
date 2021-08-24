<template>
  <div>
    <v-col
    cols="10">
      <v-card >
        <v-container>
        <Comments :data="data"/>
        </v-container>
      </v-card>
    </v-col>


  </div>
</template>

<script>
import Comments from './comments';
export default {
  name: "test",
  components: {
    Comments,
  },
  data () {
    return {
      data : '',
      comment : [],
    }
  },
  mounted () {
    const data = [
      { id : 1, name : 'test1', content : 'test1', pId : 0, deep : 0},
      { id : 3, name : 'test1_test1', content : 'test1_test1', pId : 1, deep : 1},
      { id : 6, name : 'test1_test2', content : 'test1_test2', pId : 1, deep : 1},
      { id : 2, name : 'test2', content : 'test2', pId : 0, deep : 0},
      { id : 4, name : 'test2_test1', content : 'test2_test1', pId : 2, deep : 1},
      { id : 5, name : 'test1_test1_test1', content : 'test1_test1_test1', pId : 3, deep : 2},
      { id : 7, name : 'test1_test1_test2', content : 'test1_test1_test2', pId : 3, deep : 2},

    ];

    // const data2 = [
    //   { id : 1, name : 'test1', pId : 0, d : 1,
    //     children : [{ id : 3, name : 'test1_test1', pId : 1, d : 2, children : []}]},
    //   { id : 2, name : 'test2', pId : 0, d : 1,
    //     children : [{ id : 4, name : 'test2_test1', pId : 2, d : 2, children : []}]}
    // ]


    // this.data.shift(1);

    let deep = 0;
    let set = [];

    for(let i=0; i<data.length; i++) {

      if(data[i]['deep'] >= deep) {
        deep = data[i]['deep'];
      }

      // if(this.data[i]['deep'] === 0 ) {
      //   this.comment.push(this.data[i]);
      //   this.data.splice(i,1);
      // }
    }

    for(let d=0; d <= deep; d++) {
      set[d] = [];
      for(let i=0; i<data.length; i++) {
        data[i]['children']=[];
        if(data[i]['deep'] === d) {
          set[d].push(data[i]);
          data.splice(i,1);
          i--;
        }
      }
    }

    console.log(set[0]);

    for(let d=deep; d>0; d--) {
      for(let k=0; k<set[d].length; k++) {
        for(let i = 0; i<set[d-1].length; i++) {
          if(set[d-1][i]['id'] === set[d][k]['pId']) {
            set[d-1][i]['children'].push(set[d][k]);

          }
        }
      }

    }


    this.data = set[0];


  }
}
</script>

<style scoped>

</style>