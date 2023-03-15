<template>
  <div>
    <div v-if="generate.data.error">
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
                <h1 class="font-bold text-2xl">{{ generate.data.code }} {{ generate.data.errorMsg }}</h1>
                <div class="text-base">{{ generate.data.message }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <MultiButtonApi v-for="gen in generate" :key="gen.title" :res="gen" />
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
