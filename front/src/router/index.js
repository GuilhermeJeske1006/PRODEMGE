import HomeView from '../pages/index.vue';
import StoreView from '../pages/store.vue';
import DetailsView from '../pages/users/_id.vue';
import HistoryView from '../pages/users/history/_id.vue';

import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  { path: '/', component: HomeView,  },
  { path: '/store', component: StoreView },
  { path: '/users/:id', component: DetailsView },
  { path: '/users/history/:id', component: HistoryView },


];

const router = createRouter({
  history: createWebHistory(),
  routes, 
})

export default router;