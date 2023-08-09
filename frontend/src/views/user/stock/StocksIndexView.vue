<template>
  <div><h2>Current Stock</h2></div>

  <div>
    <li v-for="stock in stocks" :key="stock.id">
      <span style="font-size: 1.5rem">{{ stock.item.name }} - {{ stock.quantity }} </span>
    </li>
  </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {};
  },

  computed: {
    // Import states
    ...mapState("stock", ["stocks"]),

    // Import getters
    ...mapGetters({
      logged_in: "loginStatus",
      user_role: "userRole",
    }),
  },

  mounted() {
    if (this.logged_in) {
      this.getStocks();
    }
  },

  methods: {
    ...mapActions("stock", ["getStocks"]),
  },
};
</script>

<style scoped>
.answer {
  font-weight: bold;
  color: orangered;
}

a:hover {
  color: orangered;
  text-decoration: underline;
}

a {
  display: inline-block;
  font-size: 14px;
  text-decoration: none;
  /* padding: 5px;
  margin: 5px; */
  border-left: 1px solid var(--color-border);
}

.post_title {
  font-size: 21px;
  text-decoration: none;
  margin: 5px;
  cursor: pointer;
}

.post_title:hover {
  color: orangered;
  text-decoration: underline;
}
</style>
