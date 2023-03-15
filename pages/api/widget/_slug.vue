<template>
  <div class="min-h-screen py-4">
    <div v-if="generate.error">
      <div class="hero min-h-screen">
        <div class="hero-content text-center">
          <div class="alert shadow-lg">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="stroke-info flex-shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <div>
                <h1 class="font-bold text-2xl">{{ generate.code }} {{ generate.errorMsg }}</h1>
                <div class="text-base">{{ generate.message }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <Widget :data="generate" :url="videoUrl" :showTumbnail="false" />
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
