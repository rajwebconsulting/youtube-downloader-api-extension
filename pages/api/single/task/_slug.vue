<template>
  <div>
    <a :href="items.download">
      <SingleButtonApi :res="items" />
    </a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: {},
      interval: null,
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
              quality: response.data.ext == "mp3" ? " 320 kbps" : "",
              status: response.data.status,
              format: response.data.ext,
              headline: "Download ",
              subline: response.data.title,
              download: response.data.download,
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
            };
            return data;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
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
