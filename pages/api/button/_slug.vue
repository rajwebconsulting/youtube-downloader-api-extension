<template>
  <div>
    <MultiButtonApi v-for="gen in generate" :key="gen.title" :res="gen" />
  </div>
</template>

<script>
export default {
  head() {
    return {
      script: [
        {
          src: process.env.APP_API_ADS || "",
          async: true,
          body: true,
          'data-cfasync': 'false'
        },
      ],
    };
  },
  async asyncData({ params, route, $axios }) {
    const format = params.slug;
    const videoUrl = route.query.url;
    const generate = await $axios
      .post("/api/json", {
        ftype: format,
        url: videoUrl,
      })
      .then(function (response) {
        const data = response.data;
        return { data };
      })
      .catch(function (error) {
        console.log(error);
      });

    return { videoUrl, format, generate };
  },
  data() {
    return {
      generate: [],
      convertFile: [],
    };
  },
  methods: {
    async convert(fileHash) {
      const task = await this.$axios
        .post("/api/json", {
          hash: fileHash,
        })
        .then(function (response) {
          return response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      this.convertFile = task;
      this.$router.push("/api/button/task/" + task.taskId);
    },
  },
};
</script>
