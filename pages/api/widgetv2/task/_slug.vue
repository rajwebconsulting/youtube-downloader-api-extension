<template>
  <div class="min-h-screen pb-5">
    <div class="card md:w-1/2 bg-base-100 shadow-xl mx-auto mb-2">
      <figure class="px-10 pt-10">
        <img :src="items.thumbnail" alt="thumbnail" class="rounded-xl" />
      </figure>
      <div class="card-body items-center text-center">
        <h2 class="card-title text-2xl">{{ items.title }}</h2>
        <div class="radial-progress" :style="items.percent_style">
          {{ items.percent }}%
        </div>
        <p class="font-bold text-xl">{{ items.status }}</p>
        <div class="card-actions">
          <span></span>
          <a v-if="items.btnDisabled" class="btn" disabled>Download</a>
          <a v-else :href="items.download" class="btn">Download</a>
        </div>
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
              videoId: response.data.videoId,
              thumbnail:
                "https://i.ytimg.com/vi/" +
                response.data.videoId +
                "/mqdefault.jpg",
              title: response.data.title,
              quality: response.data.ext == "mp3" ? " 320 kbps" : "",
              status: response.data.status,
              format: response.data.ext,
              headline: "Download ",
              percent_style:
                response.data.convert_progress < 0
                  ? "--value:" + response.data.download_progress
                  : "--value:" + response.data.convert_progress,
              percent:
                response.data.convert_progress < 0
                  ? response.data.download_progress
                  : response.data.convert_progress,
              download: response.data.download,
              btnDisabled: false,
            };
            return data;
          } else {
            const data = {
              videoId: response.data.videoId,
              thumbnail:
                "https://i.ytimg.com/vi/" +
                response.data.videoId +
                "/mqdefault.jpg",
              title: response.data.title,
              status: response.data.status,
              headline: response.data.status,
              percent_style:
                response.data.convert_progress < 0
                  ? "--value:" + response.data.download_progress
                  : "--value:" + response.data.convert_progress,
              percent:
                response.data.convert_progress < 0
                  ? response.data.download_progress
                  : response.data.convert_progress,
              download: "#",
              btnDisabled: true,
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

