<template>
<div>
  <MultiButtonApi v-for="gen in generate" :key="gen.title" :res="gen" />
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
        const data = response.data
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
        .post("/ajax", {
          hash: fileHash,
        })
        .then(function (response) {
          return response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      this.convertFile = task;
      this.$router.push('/api/button/task/' + task.taskId )
    },
  },
}
</script>
