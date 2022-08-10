<template>
  <AppLayout title="User Profile">
    <template #header> User Profile </template>

    <div
      class="
        border-b border-gray-200
        dark:border-dim-200
        bg-gray-50
        dark:bg-dim-300
        border-l border-r
      "
    >
      <div
        class="
          flex flex-col
          items-center
          justify-center
          text-center
          p-6
          bg-white
          dark:bg-dim-900
          border-b border-t border-gray-200
          dark:border-dim-200
          hover:bg-gray-50
          dark:hover:bg-dim-300
          cursor-pointer
          transition
          duration-350
          ease-in-out
          text-blue-400 text-sm
        "
      >
        <img
          class="inline-block h-16 w-16 rounded-full"
          :src="profile.pic"
          alt=""
        />
        <h1 class="dark:text-white text-gray-900 text-2xl font-bold mb-2 mt-2">
          {{ profile.username }}
        </h1>
        <p class="text-gray-500 mb-5">
          {{ profile.about }}
        </p>


        <div class="flex items-center h-full text-gray-800 dark:text-white">
          <InertiaLink
            v-if="
              
              profile.isFollowing === false &&
              profile.followbutton === false
            "
            preserveScroll
            method="post"
            as="button"
            type="button"
            class="
                font-bold
                text-blue-400
                px-4
                py-1
                rounded-full
                border-2 border-blue-400
                "
            :href="route('follow', { id: profile.username })"
          >
           + Follow
          </InertiaLink>
  
          <InertiaLink
            v-if="
              
              profile.isFollowing === true &&
              profile.followbutton === false
            "
            preserveScroll
            method="post"
            as="button"
            type="button"
            class="
                font-bold
                text-blue-400
                px-4
                py-1
                rounded-full
                border-2 border-blue-400
                "
            :href="route('follow', { id: profile.username })"
          >
            - Unfollow
          </InertiaLink>

        </div>

        <p class="text-gray-500 mt-5 text-start text-base">
          {{ profile.postamount }} Posts  {{ profile.followcount }} Follows  {{ profile.followerscount }} Followers
        </p>

      </div>
    </div>

    <!-- Tweet -->
    <Post :posts="profile.posts" />
    <!-- /Tweet -->
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import Post from "../../Shared/Post.vue";

let props = defineProps({
  profile: Object,
});
</script>