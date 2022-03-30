import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Product from '../views/products/ListProducts.vue'
import CreateProduct from '../views/products/CreateProduct.vue'
import UpdateProduct from '../views/products/UpdateProduct.vue'
import Order from '../views/orders/ListOrders.vue'
import CreateOrder from '../views/orders/CreateOrder.vue'
import UpdateOrder from '../views/orders/UpdateOrder.vue'

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
    {
        path: '/order',
        name: 'order',
        component: Order
    },
    {
        path: '/create-order',
        name: 'create-order',
        component: CreateOrder
    },
    {
        path: '/update-order/:id',
        name: 'update-order',
        component: UpdateOrder
    },

]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router