import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/components/Home';
import Register from '@/components/Register';
import CreateBoard from '@/components/CreateBoard';
import axios from'axios';
import ShowBoard from "../components/ShowBoard";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/register',
    name : 'Register',
    component: Register
  },
  {
    path: '/board/create',
    name : 'CreateBoard',
    component : CreateBoard,
    meta : {requiresAuth : true}
  },
  {
    path: '/board/show/:id',
    name : 'ShowBoard',
    component : ShowBoard,
    meta : {requiresAuth : true}
  }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

router.beforeEach( (to, from, next) => {
  // console.log('afadsfa');
  if(to.matched.some( (record) => record.meta.requiresAuth)) {
    axios.get('/api/auth/user')
        .then(response => {
          if (response.data.login === 1)
            next();
          else {
            alert('로그인 필요');
          }
        }).catch(err => {
      console.log(err);
    })
  }else {
    next();
  }
})


export default router
