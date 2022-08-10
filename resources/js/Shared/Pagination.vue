<template>
   <div>
    <Component
    :is="link.url ? 'Link' : 'span'"
    v-for="link in links" 
    :href="link.url" 
    v-html="link.label" 
    class="px-1"
    :class="{ 'text-blue-400 text-sm font-normal p-3 hover:bg-gray-100 dark:hover:bg-dim-300 cursor-pointer transition duration-350 ease-in-out' : ! link.url, 'font-bold' : link.active }"

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