<template>
  <div class="card md:w-1/2 bg-base-100 shadow-xl mx-auto mb-2">
    <figure class="px-10 pt-10">
      <img :src="thumbnail" alt="thumbnail" class="rounded-xl" />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title text-2xl">{{ data.title }}</h2>
      <div class="tabs tabs-boxed w-36 mx-auto">
        <div
          v-on:click="changeFormat('mp3')"
          class="text-white bg-pink-500 btn btn-sm mx-2"
        >
          MP3
        </div>
        <div
          v-on:click="changeFormat('mp4')"
          class="text-white bg-pink-500 btn btn-sm"
        >
          MP4
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="table table-fixed w-full">
          <thead>
            <tr>
              <th class="w-1/4">Quality</th>
              <th class="text-center">Format</th>
              <th class="lg:w-1/4 text-center lg:text-right">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="task in apiData.tasks" :key="task.bitrate">
              <td v-if="task.bitrate">{{ task.bitrate }} kbps</td>
              <td v-if="task.bitrate" class="text-center">.mp3</td>
              <td v-if="task.qualityLabel">{{ task.qualityLabel }}</td>
              <td v-if="task.qualityLabel" class="text-center">.mp4</td>
              <td class="lg:w-1/4 lg:text-right">
                <div v-on:click="convertFileTo(task.hash)"
                  class="
                    btn
                    bg-gradient-to-r
                    from-purple-500
                    to-pink-500
                    btn-sm
                  "
                >
                  Convert
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    data: {
      type: Object,
      default: () => {},
    },
    url: {
      type: String,
    },
  },
  data() {
    return {
      apiData: this.data,
      thumbnail:
        "https://i.ytimg.com/vi/" + this.data.videoId + "/mqdefault.jpg",
    };
  },
  methods: {
    async changeFormat(ftype) {
      const task = await this.$axios
        .post("/ajax", {
          ftype: ftype,
          url: this.url,
        })
        .then(function (response) {
          return response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      this.apiData = task;
    },
    async convertFileTo(hash) {
      const task = await this.$axios
        .post("/ajax", {
          hash: hash,
        })
        .then(function (response) {
          return response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
      this.$router.push('/api/widgetv2/task/' + task.taskId )
    },
  },
};
</script>
