<template>
  <div class="card card-compact w-56 bg-base-100 shadow-xl">
    <figure>
      <img :src="data.thumbnail[0].url" :alt="data.title" />
    </figure>
    <div class="card-body">
      <h2 class="text-md">{{ data.title }}</h2>
      <p>⏰ {{ data.duration }} - 📺 {{ data.shortViewCount }}</p>
      <div class="card-actions justify-end">
        <button
          v-on:click="convertVideo(data.videoId)"
          class="btn btn-outline btn-info btn-sm"
        >
          Download
        </button>
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
      this.$router.push(
        "/api/widgetv2?url=https://www.youtube.com/watch?v=" + videoId
      );
    },
  },
};
</script>
