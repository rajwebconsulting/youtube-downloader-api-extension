<template>
  <div class="card max-w-xs bg-base-100 shadow-xl image-full mx-auto">
    <figure>
      <img :src="data.thumbnail[0].url" :alt="data.title" />
    </figure>
    <div class="card-body">
      <h2 class="card-title">{{ data.title }}</h2>
      <div class="inline">
        <div class="badge badge-secondary">{{ data.duration }}</div>
        <div class="badge badge-primary">{{ data.shortViewCount }}</div>
        <div class="badge badge-accent">{{ data.publishedAt }}</div>
      </div>
      <div class="card-actions justify-end mt-8">
        <button v-on:click="convertVideo(data.videoId)" class="btn btn-outline btn-info absolute bottom-4 right-4">Download</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    data: {
      type: Object,
    },
  },
  methods: {
    async convertVideo(videoId) {
      this.$router.push("/api/widgetv2?url=https://www.youtube.com/watch?v=" + videoId);
    },
  },
};
</script>
