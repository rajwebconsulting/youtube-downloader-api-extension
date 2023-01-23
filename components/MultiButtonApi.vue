<template>
  <div>
    <div class="flex flex-wrap justify-center">
      <div
        v-for="r in output"
        :key="r.hash"
        :class="r.className"
        v-on:click="convertFileTo(r.hash)"
      >
        <div class="text-2xl tracking-wide uppercase">{{ r.format }}</div>
        <div>{{ r.quality }}</div>
        <div class="h-0 m-0 divider"></div>
        <div>{{ r.filesize }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    const dataOut = [];
    this.res.tasks.forEach((value, index) => {
      let data = value.bitrate
        ? {
            format: "mp3",
            quality: value.bitrate + " kbps",
            hash: value.hash,
            className: `w-28 p-2 mx-2 my-2 text-center border rounded-lg cursor-pointer bit${value.bitrate}`,
            filesize: value.filesize
          }
        : {
            format: "mp4",
            quality: value.qualityLabel,
            hash: value.hash,
            className: `w-28 p-2 mx-2 my-2 text-center border rounded-lg cursor-pointer v${value.bitrate}`,
            filesize: value.filesize
          };

      dataOut.push(data);
    });
    return {
      output: dataOut,
    };
  },
  props: {
    res: {
      type: Object,
    },
  },
  methods: {
    async convertFileTo(hash) {
      const task = await this.$axios
        .post("/api/json", {
          hash: hash,
        })
        .then(function (response) {
          return response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      this.$router.push("/api/button/task/" + task.taskId);
    },
  },
};
</script>

<style scoped>
.bit320,
.v4320p,
.v2160p,
.v1440p,
.v4320p60,
.v2160p60,
.v1440p60 {
  --tw-border-opacity: 1 !important;
  border-color: hsl(#000 / var(--tw-border-opacity)) !important;
  --tw-bg-opacity: 0.9;
  background-color: hsl(var(--in) / var(--tw-bg-opacity));
  --tw-text-opacity: 1;
  color: hsl(#000 / var(--tw-text-opacity));
}

.bit256,
.v1080p,
.v1080p60 {
  --tw-border-opacity: 1 !important;
  border-color: hsl(#000 / var(--tw-border-opacity)) !important;
  --tw-bg-opacity: 0.9;
  background-color: hsl(var(--su) / var(--tw-bg-opacity));
  --tw-text-opacity: 1;
  color: hsl(#000 / var(--tw-text-opacity));
}

.bit192,
.v720p,
.v720p60 {
  --tw-border-opacity: 1 !important;
  border-color: hsl(#000 / var(--tw-border-opacity)) !important;
  --tw-bg-opacity: 0.9;
  background-color: hsl(var(--a) / var(--tw-bg-opacity));
  --tw-text-opacity: 1;
  color: hsl(#000 / var(--tw-text-opacity));
}

.bit128,
.v480p,
.v360p,
.v480p60,
.v360p60 {
  --tw-border-opacity: 1 !important;
  border-color: hsl(#000 / var(--tw-border-opacity)) !important;
  --tw-bg-opacity: 0.9;
  background-color: hsl(var(--wa) / var(--tw-bg-opacity));
  --tw-text-opacity: 1;
  color: hsl(#000 / var(--tw-text-opacity));
}

.bit64,
.v240p,
.v144p,
.v240p60,
.v144p60 {
  --tw-border-opacity: 1 !important;
  border-color: hsl(
    var(--erc, var(--er)) / var(--tw-border-opacity)
  ) !important;
  --tw-bg-opacity: 1;
  background-color: hsl(var(--er) / var(--tw-bg-opacity));
  --tw-text-opacity: 1;
  color: hsl(#000 / var(--tw-text-opacity));
}
</style>
