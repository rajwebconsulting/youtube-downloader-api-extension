<template>
  <div>
    <span v-if="convertFile.taskId"> {{ convertFile.taskId }}</span>
    <button
      class="w-full"
      v-for="gen in generate"
      :key="gen.title"
      v-on:click="convert(gen.hash)"
    >
      <SingleButtonApi v-for="gen in generate" :key="gen.title" :res="gen" />
    </button>
  </div>
</template>

<script>
export default {
  async asyncData({ params, route, $axios }) {
    const format = params.slug;
    const videoUrl = route.query.url;

    const generate = await $axios
      .post("/ajax", {
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
        };
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
      this.convertFile = 'fuck';
      console.log(fileHash);
      const task = await this.$axios
        .post("/ajax", {
          hash: fileHash,
        })
        .then(function (response) {
          console.log(response);
          return response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
        console.log(task);
      this.convertFile = task;
      this.$router.push('/api/single/task/' + task.taskId )
      // this.router.push('/bla')
    },
  },
};
</script>
