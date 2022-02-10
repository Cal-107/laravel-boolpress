// Dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';

// Route Components
import Home from './pages/Home';
import About from './pages/About';
import Blog from './pages/Blog';
import PostDetail from './pages/PostDetail';

// Vue Router Activation
Vue.use(VueRouter);

// Routes Definition
const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        { 
            path: '/',
            name: 'home',
            component: Home,
        },
        { 
            path: '/about',
            name: 'about',
            component: About,
        },
        { 
            path: '/blog',
            name: 'blog',
            component: Blog,
        },
        { 
            path: '/blog/:slug',
            name: 'post-detail',
            component: PostDetail,
        },
    ]
});

// Export for the routes, we need it for 'IMPORT' in anothers files.
export default router;