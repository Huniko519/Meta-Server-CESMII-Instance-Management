import { createWebHistory, createRouter } from "vue-router";
import Home from '../components/Home.vue';
import OrganizationsList from '../components/Organizations/OrganizationsList.vue';
import OrganizationsCreate from '../components/Organizations/OrganizationsCreate.vue';
import OrganizationsEdit from '../components/Organizations/OrganizationsEdit.vue';

const routes = [
  {
    path: "/",
    redirect: '/organizations',
    name: "Home",
    component: Home,
  },
  {
    path: "/organizations",
    name: "Organizations-List",
    component: OrganizationsList,
  },
  {
    path: "/organizations/create",
    name: "Organizations-Create",
    component: OrganizationsCreate,
  },
  {
    path: "/organizations/:id",
    name: "Organizations-Edit",
    component: OrganizationsEdit,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
