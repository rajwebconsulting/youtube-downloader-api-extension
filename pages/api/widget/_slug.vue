<template>
  <div class="min-h-screen py-4">
    <Widget :data="generate" :url="videoUrl" :showTumbnail="false" />
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
  async asyncData({ route, $axios }) {
    const videoUrl = route.query.url;
    const generate = await $axios
      .post("/api/json", {
        ftype: "mp3",
        url: videoUrl,
      })
      .then(function (response) {
        return response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
    return { generate, videoUrl };
  },
};
</script>
