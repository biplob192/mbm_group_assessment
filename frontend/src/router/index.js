import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import RegisterView from "../views/auth/RegisterView.vue";
import LoginView from "../views/auth/LoginView.vue";

/*import router*/
import UserRouter from "./user/UserRouter";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/register",
      name: "Register",
      component: RegisterView,
    },
    {
      path: "/login",
      name: "Login",
      component: LoginView,
    },
    {
      path: "/",
      name: "Home",
      component: HomeView,
    },
    {
      path: "/home",
      redirect: "/",
    },
    {
      path: "/about",
      name: "About",
      component: () => import("../views/AboutView.vue"),
    },

    ...UserRouter,
  ],
});

router.beforeEach((to, from, next) => {
  if (to.name !== "Login" && !localStorage.getItem("access_token") && to.name !== "Register") next({ name: "Login" });
  else next();
});

export default router;
