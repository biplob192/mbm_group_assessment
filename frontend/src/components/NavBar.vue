<template>
  <div>
    <nav>
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/requisitions/create" v-if="user_role == 'Employee'">Create Requisition</RouterLink>
      <RouterLink to="/requisitions">All Requisition</RouterLink>
      <RouterLink to="/stocks"  v-if="user_role != 'Employee'">Stocks</RouterLink>
      <RouterLink v-show="!logged_in" to="/register">Registration</RouterLink>
      <a v-show="logged_in" href="#" @click="logout">Logout</a>
      <RouterLink v-show="!logged_in" to="/login">Login</RouterLink>
      {{ (user_role) }}
    </nav>
    <hr />
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { RouterLink } from "vue-router";

export default {
  name: "NavBar",

  data() {
    return {
      // logged_in: this.$store.state.logged_in_status,
    };
  },

  computed: {
    ...mapGetters({
      logged_in: "loginStatus",
      user_role: "userRole",
    }),
  },

  methods: {
    logout() {
      console.log("Logout Clicked!!");

      localStorage.removeItem("access_token");
      localStorage.removeItem("refresh_token");
      localStorage.removeItem("user_info");

      window.location.assign("/login");
    },
  },
};
</script>
<style scoped>
nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: #fff;
  background-color: orangered;
  border-radius: 5px;
}
a:hover {
  color: orangered;
  text-decoration: underline;
}
nav a.router-link-exact-active:hover {
  text-decoration: none;
}

nav a {
  display: inline-block;
  font-size: 21px;
  text-decoration: none;
  padding: 5px;
  margin: 5px;
  border-left: 1px solid var(--color-border);
}

.main {
  width: 80%;
  margin: auto;
}
</style>
