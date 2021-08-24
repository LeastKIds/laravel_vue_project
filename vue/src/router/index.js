import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@/components/Home';
import Register from '@/components/Register';
import CreateBoard from '@/components/CreateBoard';
import ShowBoard from "../components/ShowBoard";
import UpdateBoard from "../components/UpdateBoard";
import MyBoard from '../components/MyBoard';
import Test from '../components/test';
import store from '../store';

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
  },
  {
    path: '/board/update/:id',
    name : 'UpdateBoard',
    component : UpdateBoard,
    meta : {requiresAuth : true}
  },
  {
    path: '/myboard',
    name : 'MyBoard',
    component: MyBoard,
    meta : {requiresAuth : true}
  },
  {
    path: '/test',
    name : 'Test',
    component: Test
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
    store.dispatch('loginCheck')
        .then(response => {
          if(response.login ===1)
          {
            store.commit('saveUser',response.user);
            next();
          }
          else
            alert('로그인 필요');
        }).catch(err => {
      console.log(err);
    });
  }else {
    next();
  }


})


export default router
