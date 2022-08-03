<template>
    <AppLayout title="Users">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
    </template>

<div class="m-5 card">
    <div
    class="
      w-full
      max-w-2xl
      mx-auto
      bg-white
      shadow-lg
      rounded-sm
      m-5
      border border-gray-200
    "
  >
    <input v-model="search" type="text" class="w-full" placeholder="Search.." />
  </div>

    <!-- Table -->
  <div
    class="
      w-full
      max-w-2xl
      mx-auto
      bg-white
      shadow-lg
      rounded-sm
      border border-gray-200
    "
  >
    <header class="px-5 py-4 border-b border-gray-100">
      <h2 class="font-semibold text-gray-800">Customers</h2>
    </header>
    <div class="p-3">
      <div class="overflow-x-auto">
        <table class="table-auto w-full">
          <tbody class="text-sm divide-y divide-gray-100">
            <tr v-for="user in users.data" :key="user.id">
              <td class="p-2 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="font-medium text-gray-800">{{ user.name }}</div>
                </div>
              </td>
              <td class="p-2 whitespace-nowrap">
                <div class="text-lg text-center">
                  <a href="/users/${user.id}/edit">Edit</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <Pagination :links="users.links" class="mt-5 px-4" />
</div>


  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import throttle from "lodash/throttle";

let props = defineProps({
  users: Object,
  filters: Object,
});

let search = ref(props.filters.search);

watch(
  search,
  throttle(function (value) {
    Inertia.get(
      "/users",
      { search: value },
      {
        preserveState: true,
        replace: true,
      }
    );
  }, 500)
);
</script>
