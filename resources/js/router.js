import { createRouter, createWebHistory } from 'vue-router'

import Login from '@/pages/login/Login.vue'
import EmptyLayout from '@/layout/EmptyLayout.vue'
import MainLayout from '@/layout/MainLayout.vue'
import ListSupplies from '@/pages/supplies/List/ListSupplies.vue'
import CreateSupply from '@/pages/supplies/Form/CreateSupply.vue'
import EditSupply from '@/pages/supplies/Form/EditSupply.vue'
import ViewSupply from '@/pages/supplies/Form/ViewSupply.vue'

const routes = [
  {
    path: '/',
    component: MainLayout,
    children: [
      {
        path: 'supplies',
        name: 'ListSupplies',
        component: ListSupplies,
      },
      {
        path: 'supplies/create-supply',
        name: 'CreateSupply',
        component: CreateSupply,
      },
      {
        path: 'supplies/edit-supply/:id',
        name: 'EditSupply',
        component: EditSupply,
      },
        {
        path: 'supplies/view-supply/:id',
        name: 'ViewSupply',
        component: ViewSupply,
      },
    ]
  },
  {
    path: '/login',
    component: EmptyLayout,
    children: [
      {
        path: '',
        name: 'Login',
        component: Login
      }
    ]
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;