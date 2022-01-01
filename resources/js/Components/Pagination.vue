<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, k) in links" :key="k">
        <div v-if="link.url === null"  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded cursor-not-allowed " v-html="link.label" />
        <Link v-else class=" mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded transition-colors hover:border-sky-500 hover:text-sky-500 text-gray-500 " :class="{ 'bg-white  border border-gray-500  text-gray-700': link.active }" :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
</template>
  
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
	components: {
		Link,
	},
  props: {
    links: Array,
  },
}
</script> 