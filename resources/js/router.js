import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import SignUp from './views/account/SignUp'
import SignIn from './views/account/SignIn'
import AccountLayout from './components/layouts/AccountLayout'
import AppLayout from './components/layouts/AppLayout'
import DashBoard from './views/DashBoard';
import Revenues from './views/Revenues';
import RevenueType from './views/RevenueType';
import Expendictures from './views/Expendictures'
import ExpendictureType from './views/ExpendictureType'
import CreateRevenue from './views/CreateRevenue'
import CreateExpendicture from './views/CreateExpendicture'
import store from './store';

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/account', component: AccountLayout,
            children: [
                {
                    path: '',
                    component: SignIn
                },
                {
                    path: "login",
                    component: SignIn,
                    alias: "/login"
                },
                {
                    path: "register",
                    component: SignUp
                }
            ]
        },  
        {
            path: '/', component: AppLayout,
            children: [
                {
                    path: '', 
                    component: Home
                },
                {
                    path: 'dashboard',
                    component: DashBoard
                },
                {
                    path: 'revenue-types',
                    component: RevenueType,
                },
                {
                    path: 'revenue-records',
                    component: Revenues,
                },
                {
                    path: 'expendicture-types',
                    component: ExpendictureType,
                },
                {
                    path: 'expendicture-records',
                    component: Expendictures,
                },
                {
                    path: 'create-expendicture',
                    component: CreateExpendicture,
                },
                {
                    path: 'create-revenue',
                    component: CreateRevenue,
                }
            ]
        }
  ]
})
