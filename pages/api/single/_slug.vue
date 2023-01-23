<template>
  <div>
    <div v-if="loading">loading</div>
    <div v-else>
      <button class="w-full" v-for="gen in generate" :key="gen.title" v-on:click="convert(gen.hash)">
        <SingleButtonApi v-for="gen in generate" :key="gen.title" :res="gen" />
      </button>
    </div>
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
          "data-cfasync": "false",
        },
      ],
    };
  },
  data() {
    return {
      generate: [],
    };
  },
  async asyncData({ params, route, $axios }) {
    let loading = true;
    const format = params.slug;
    const videoUrl = route.query.url;

    const generate = await $axios
      .post("/api/json", {
        ftype: format,
        url: videoUrl,
      })
      .then(function (response) {
        const data = {
          subline: response.data.title,
          quality: response.data.tasks[0].bitrate
            ? response.data.tasks[0].bitrate + " kbps"
            : response.data.tasks[0].qualityLabel,
          hash: response.data.tasks[0].hash,
          headline: "Convert",
          format: format,
          filesize: "- " + response.data.tasks[0].filesize,
        };
        return { data };
      })
      .catch(function (error) {
        console.log(error);
      })
      .finally(() => (loading = false));

    return { videoUrl, format, generate, loading };
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
      this.$router.push("/api/single/task/" + task.taskId);
    },
  },
};
</script>
