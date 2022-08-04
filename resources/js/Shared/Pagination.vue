<template>
   <div>
    <Component
    <div class="flex items-center justify-center p-4 border-b border-l border-r border-gray-200 dark:border-gray-700"
          >
            <svg class="w-8 h-8 animate-spin-fast">
              <circle
                cx="16"
                cy="16"
                fill="none"
                r="14"
                stroke-width="4"
                style="stroke: rgb(29, 161, 242); opacity: 0.2"
              ></circle>
              <circle
                cx="16"
                cy="16"
                fill="none"
                r="14"
                stroke-width="4"
                style="
                  stroke: rgb(29, 161, 242);
                  stroke-dasharray: 80;
                  stroke-dashoffset: 60;
                "
              ></circle>
            </svg>
          </div>
          />




    <Component
    :is="link.url ? 'Link' : 'span'"
    v-for="link in links" 
    :href="link.url" 
    v-html="link.label" 
    class="px-1"
    :class="{ 'text-gray-500' : ! link.url, 'font-bold' : link.active }"

    />

  </div>
</template>
<script>
export default {
    props: {
        links: Array
    }
}
</script>
<style lang="">
    
</style>