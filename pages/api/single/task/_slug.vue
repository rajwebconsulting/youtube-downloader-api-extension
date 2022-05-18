<template>
  <div>
    <div v-if="loading">
      <SingleLoading />
    </div>
    <div v-else>
      <a :href="items.download">
        <SingleButtonApi :res="items" />
      </a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: {},
      interval: null,
      loading: false,
    };
  },
  methods: {
    loadData: async function () {
      const taskId = this.$route.params.slug;
      const task = await this.$axios
        .post("/ajax", {
          taskId: taskId,
        })
        .then(function (response) {
          if (response.data.status === "finished") {
            const data = {
              title: response.data.title,
              quality: response.data.ext == "mp3" ? "320 kbps" : "",
              status: response.data.status,
              format: response.data.ext,
              headline: "Download ",
              subline: response.data.title,
              download: response.data.download,
              filesize: "- " + response.data.filesize,
            };
            return data;
          } else {
            const data = {
              title: response.data.title,
              status: response.data.status,
              headline: response.data.status,
              subline:
                response.data.convert_progress < 0
                  ? response.data.download_progress + "%"
                  : response.data.convert_progress + "%",
              download: "#",
              filesize: "",
            };
            return data;
          }
        })
        .catch(function (error) {
          console.log(error);
        })
        .finally(() => (this.loading = false));
      if (
        task.status === "finished" ||
        task.status === "failed" ||
        typeof task.error !== "undefined"
      ) {
        clearInterval(this.interval);
      }
      this.items = task;
    },
  },
  mounted() {
    this.loading = true;
    this.loadData();

    this.interval = setInterval(
      function () {
        this.loadData();
      }.bind(this),
      2000
    );
  },
  beforeDestroy: function () {
    clearInterval(this.interval);
  },
};
</script>
