import Index from "pages";
import Login from "pages/Login";
// import Local from "../pages/Local";
import Importar from "pages/Importar";
import User from "pages/User";
import Pago from "pages/Pago";
import Pagorealizado from "pages/Pagorealizado";
import Pagofaltates from "pages/Pagofaltates";
import Mispagos from "pages/Mispagos";

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: Index },
      { path: 'login', component: Login},
      { path: 'importar', component: Importar,meta:{requiresAuth: true}},
      { path: 'user', component: User,meta:{requiresAuth: true}},
      { path: 'pago', component: Pago,meta:{requiresAuth: true}},
      { path: 'pagorealizado', component: Pagorealizado,meta:{requiresAuth: true}},
      { path: 'pagofaltantes', component: Pagofaltates,meta:{requiresAuth: true}},
      { path: 'mispagos', component: Mispagos,meta:{requiresAuth: true}},

    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
