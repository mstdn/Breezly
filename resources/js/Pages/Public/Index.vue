<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "../../Shared/Pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Post from '../../Shared/Post.vue';

let props = defineProps({
  posts: Object,
});
</script>

<template>
  <AppLayout title="Home">
    <template #header> Public </template>

    <!-- Tweet -->
   <Post :posts="posts" />
    <!-- /Tweet -->

    <Pagination :links="posts.links" />
  </AppLayout>
</template>
