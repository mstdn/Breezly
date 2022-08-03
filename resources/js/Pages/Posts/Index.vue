<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
  content: "",
});

let submit = () => {
  form.post("/home");
};

let props = defineProps({
  posts: Object,
});
</script>

<template>
  <AppLayout title="Home">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Home</h2>
    </template>

    <div class="w-full flex justify-center items-center">
      <form @submit.prevent="submit">
        <div class="rounded-xl w-full md:w-2/3 lg:w-1/3">
          <div class="flex p-4">
            <div>
              <img
                class="rounded-full w-14"
                :src="$page.props.user.profile_photo_url"
              />
            </div>
            <div class="ml-3 flex flex-col w-full">
              <textarea
                v-model="form.content"
                name="content"
                placeholder="What's happening?"
                class="w-full text-xl resize-none outline-none h-32"
                required
                id="content"
              ></textarea>
            </div>
          </div>

          <div
            class="
              flex
              items-center
              text-blue-400
              justify-between
              py-6
              px-4
              border-t
            "
          >
            <div class="flex text-2xl pl-12">
              <div
                class="
                  flex
                  items-center
                  justify-center
                  p-3
                  hover:bg-blue-100
                  rounded-full
                  cursor-pointer
                "
              >
                <i class="fas fa-image"></i>
              </div>

              <div
                class="
                  flex
                  items-center
                  justify-center
                  p-3
                  hover:bg-blue-100
                  rounded-full
                  cursor-pointer
                "
              >
                <i class="fas fa-poll-h"></i>
              </div>

              <div
                class="
                  flex
                  items-center
                  justify-center
                  p-3
                  hover:bg-blue-100
                  rounded-full
                  cursor-pointer
                "
              >
                <i class="fas fa-smile"></i>
              </div>

              <div
                class="
                  flex
                  items-center
                  justify-center
                  p-3
                  hover:bg-blue-100
                  rounded-full
                  cursor-pointer
                "
              >
                <i class="fas fa-calendar-alt"></i>
              </div>
            </div>

            <div>
              <button
                type="submit"
                class="
                  inline
                  px-4
                  py-3
                  rounded-full
                  font-bold
                  text-white
                  bg-blue-300
                  cursor-pointer
                "
                :disabled="form.processing"
              >
                Post
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div
            v-for="post in posts.data"
            :key="post.id"
            class="p-6 sm:px-20 bg-white border-b border-gray-200"
          >
            <div class="mt-4 text-gray-500">
              {{ post.content }}

              <div class="mt-4 text-gray-500">
                {{ post.user.name }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
