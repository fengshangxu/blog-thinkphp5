import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Login from '@/components/admin/login/login.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'login',//路由名称 用于<router-link :to="{name:"login", params:{login_id:1}}">
      component: Login,
    }
  ]
})
