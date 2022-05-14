<template>
  <div class="navbar bg-base-100 shadow-lg">
    <div class="navbar-start"></div>
    <div class="navbar-center">
      <a href="/" class="btn btn-ghost normal-case text-xl">{{ title }}</a>
    </div>
    <div class="navbar-end"></div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      title: null,
    };
  },
  mounted() {
    this.title = process.env.APP_NAME;
  },
};
</script>
