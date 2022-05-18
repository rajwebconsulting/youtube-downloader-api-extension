<template>
  <div>
      <div class="hero min-h-screen bg-gradient-to-r from-cyan-500 to-blue-500">
        <div class="hero-content text-center">
          <div class="max-w-xl">
            <h1 class="text-2xl font-bold text-white drop-shadow-lg">
              {{ res.headline }} <span class="uppercase" v-if="res.format">{{ res.format }}</span> <span v-if="res.quality">({{ res.quality }})</span>
            </h1>
            <h2 class="font-bold text-white text-md drop-shadow-lg">
              {{ res.subline }} {{res.filesize}}
            </h2>
          </div>
        </div>
      </div>
  </div>
</template>
<script>
export default {
  props: {
    res: {
      type: Object,
      default: () => {
      console.log(res)
      }
    }
  }
}
</script>
