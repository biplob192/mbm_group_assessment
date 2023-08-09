<template>
  <div class="about">
    <h2>This is an about page</h2>

    <br />
    {{ access_token }}
  </div>
</template>

<script>
export default {
  name: "AboutView",

  data() {
    return {
      access_token: null,
    };
  },

  mounted() {
    this.access_token = localStorage.getItem("access_token");
  },
};
</script>

<style>
</style>
