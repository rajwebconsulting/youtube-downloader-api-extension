<template>
  <div>
    <div
      class="
        flex flex-wrap
        place-content-center
        gap-4
        justify-center
        mx-auto
        p-2
      "
    >
      <SearchCard v-for="s in search" :key="s.key" :data="s" />
    </div>
  </div>
</template>

<script>
import SearchCard from "~/components/SearchCard.vue";
export default {
  head() {
    return {
      script: [
        {
          src: process.env.APP_SEARCH_ADS || "",
          async: true,
          body: true,
          "data-cfasync": "false",
        },
      ],
    };
  },
  async asyncData({ params, $axios }) {
    let loading = true;
    const searchterm = params.slug;
    const search = await $axios
      .post(process.env.APP_BACKEND_URL + "/api/search", {term: searchterm}, {
        headers: {
          "apiKey": process.env.APP_BACKEND_API_KEY
        }
      })
      .then(function (response) {
        return response.data.results;
      })
      .catch(function (error) {
        console.log(error);
      })
      .finally(() => (loading = false));
    return { searchterm, search, loading };
  },
  components: { SearchCard },
};
</script>
