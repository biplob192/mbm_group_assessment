<template>
  <div class="main">
    <form v-on:submit.prevent="handleLogin()">
      <input type="text" name="email" v-model="loginData.email" placeholder="Email" style="margin: 5px" required />
      <br />
      <input type="password" name="email" v-model="loginData.password" placeholder="Password" style="margin: 5px" required />
      <br />
      <button type="submit" style="margin: 5px">Login</button>
      <span style="margin-left: 10px"><RouterLink to="/register">Register</RouterLink></span>
    </form>
  </div>
</template>

<script>
import Auth from "../../services/api/AuthApi";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";

export default {
  name: "LoginView",
  components: {},
  data() {
    return {
      loginData: {
        email: "",
        password: "",
      },
      response: "",

      errors: {},
    };
  },

  computed: {
    ...mapState(["access_token", "user_info"]),
    ...mapState("auth", ["login_response"]),
  },


  methods: {
    ...mapActions("auth", ["login"]),

    handleLogin: async function () {
      let formData = new FormData();
      formData.append("email", this.loginData.email);
      formData.append("password", this.loginData.password);

      try {
        let info = await this.login(formData);
        let response = JSON.parse(info);

        if (response.status == 200) {
          this.$router.push({ name: "Home" });
        }

      } catch (e) {
        console.log(e);
      }
    },
  },
};
</script>

<style scoped></style>
