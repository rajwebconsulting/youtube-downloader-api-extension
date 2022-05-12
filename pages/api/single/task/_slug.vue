<template>
  <div>
    {{ taskId }}
    {{ task }}
  </div>
</template>

<script>
export default {
  async asyncData({ params, route, $axios }) {
    const taskId = params.slug;
    console.log(taskId);
    const task = await $axios
      .post("/ajax", {
        taskId: taskId
      })
      .then(function (response) {
        console.log(response);
        // return response.data;
        const data = {
          title: response.data.title,
          headline: "Convert",
        };
        console.log(data);
        return { data };
      })
      .catch(function (error) {
        console.log(error);
      });
    return { taskId, task };
  },
};
</script>
