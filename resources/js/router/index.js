import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Product from '../views/ListProducts.vue'
import CreateProduct from '../views/CreateProduct.vue'
import UpdateProduct from '../views/UpdateProduct'

Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/product',
        name: 'product',
        component: Product
    },
    {
        path: '/create-product',
        name: 'create-product',
        component: CreateProduct
    },
    {
        path: '/update-product/:id',
        name: 'update-product',
        component: UpdateProduct
    },

]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router