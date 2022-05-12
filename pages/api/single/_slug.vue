<template>
  <div>
    <h1>{{ format }}</h1>
    <h2>{{ videoUrl }}</h2>
    <button class="w-full" v-if="generate" v-on:click="convert(generate.hash)">
      <div class="hero min-h-screen bg-gradient-to-r from-cyan-500 to-blue-500">
        <div class="hero-content text-center">
          <div class="max-w-md">
            <h1
              class="text-2xl font-bold text-white drop-shadow-lg"
              v-if="generate"
            >
              Convert <span class="uppercase">{{ format }}</span> ({{
                generate.quality
              }})
            </h1>
            <h2 class="font-bold text-white text-md drop-shadow-lg" v-if="generate">
              {{ generate.title }}
            </h2>
          </div>
        </div>
      </div>
    </button>
  </div>
</template>

<script>
export default {
  async asyncData({ params, route, $axios }) {
    const format = params.slug;
    const videoUrl = route.query.url;
    console.log(format);
    console.log(videoUrl);
    const generate = await $axios
      .post("/ajax.php", {
        ftype: format,
        url: videoUrl,
      })
      .then(function (response) {
        console.log(response);
        // return response.data;
        const data = {
          title: response.data.title,
          quality: response.data.tasks[0].bitrate
            ? response.data.tasks[0].bitrate + " kbps"
            : response.data.tasks[0].qualityLabel,
          hash: response.data.tasks[0].hash,
        };
        console.log(data);
        return data;
      })
      .catch(function (error) {
        console.log(error);
      });

    return { videoUrl, format, generate };
  },
  methods: {
    async convert(fileHash) {
      console.log(fileHash);
      const convertFile = await this.$axios
      .post("/ajax.php", {
        hash: fileHash,
      })
      .then(function (response) {
        console.log(response);
        // return response.data;
        const data = {

        };
        // console.log(data);
        // return data;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
  },
};
</script>
