<template>
  <div>
    <div v-if="loading">loading</div>
    <div v-else>
      <div v-if="generate.data.isError">
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
                  <h1 class="font-bold text-2xl">{{ generate.data.code }} {{ generate.data.errTitle }}</h1>
                  <div class="text-base">{{ generate.data.message }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <button class="w-full" v-for="gen in generate" :key="gen.title" v-on:click="convert(gen.hash)">
          <SingleButtonApi v-for="gen in generate" :key="gen.title" :res="gen" />
        </button>
      </div>
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
        if (response.data.error) {
          console.log('error merror');
          const data = {
            isError: response.data.error,
            code: response.data.code,
            errTitle: response.data.errorMsg,
            message: response.data.message

          };
          console.log(data);
          return { data };
        }
        else {
          const data = {
            isError: false,
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
        }
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
