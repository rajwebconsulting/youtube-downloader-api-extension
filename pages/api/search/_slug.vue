<template>
<div>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-7 gap-4 p-2">
    <SearchCard v-for="s in search" :key="s.key" :data="s"/>
  </div>
</div>
</template>

<script>
import SearchCard from '~/components/SearchCard.vue';
export default {
    async asyncData({ params, $axios }) {
        let loading = true;
        const searchterm = params.slug;
        const search = await $axios
            .post("/ajax", {
            term: searchterm,
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
    components: { SearchCard }
}
</script>
