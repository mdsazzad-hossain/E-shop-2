//components import
const login = () => import(/* webpackChunkName: "login" */ './components/login')
const register = () => import(/* webpackChunkName: "register" */ './components/register')
const dashboard = () => import(/* webpackChunkName: "dashboard" */ './components/backend/dashboard')
const category = () => import(/* webpackChunkName: "category" */ './components/backend/category')
const role = () => import(/* webpackChunkName: "role" */ './components/backend/role')
const sub_category = () => import(/* webpackChunkName: "sub_category" */ './components/backend/subCategory')
const menu = () => import(/* webpackChunkName: "menu" */ './components/backend/menus')
const test = () => import(/* webpackChunkName: "test" */ './components/backend/test')


export default[
    {
        path:'/',
        component:login,
        name:'login',
        beforeEnter(to,from,next){
            if(!localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/dashboard');
            }
        }
    },
    {
        path:'/register',
        component:register,
        name:'register',
        beforeEnter(to,from,next){
            if(!localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/dashboard');
            }
        }
    },
    {
        path:'/dashboard',
        component:dashboard,
        name:'dashboard',
        beforeEnter(to,from,next){
            if(localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path:'/categories',
        component:category,
        name:'category',
        beforeEnter(to,from,next){
            if(localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path:'/roles',
        component:role,
        name:'role',
        beforeEnter(to,from,next){
            if(localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path:'/categories/:name',
        component:sub_category,
        name:'sub_category',
        beforeEnter(to,from,next){
            if(localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/');
            }
        }
    },

    {
        path:'/sub-categories',
        component:sub_category,
        name:'sub_categories',
        beforeEnter(to,from,next){
            if(localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path:'/menus',
        component:menu,
        name:'menu',
        beforeEnter(to,from,next){
            if(localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/');
            }
        }
    },
    {
        path:'/test',
        component:test,
        name:'test',
        beforeEnter(to,from,next){
            if(localStorage.getItem('e-shop-sss'))
            {
                next();
            }else{
                next('/');
            }
        }
    }

]
