<template>
  <div>
	<div class="flex justify-between">
		<span class="text-lg font-bold tracking-wide">Documents and Files</span>
		<Link :href="route('attachment.create', this.employee.id)" class="flex items-center space-x-1 text-sky-500 hover:underline">
			<icon name="paper-clip" class=" h-5 w-5" />
			<span class="text-sm font-medium capitalize">Upload Files</span>
		</Link>
	</div>

    <div v-if="!attachments[0]" class="border-2 rounded-lg mt-3 border-dashed border-sky-500 px-6 py-3">
      <!-- big drag and drop -->
		<div class="text-sky-500 hover:underline cursor-pointer hover:text-sky-600">
			<Link :href="route('attachment.create', this.employee.id)" class="flex items-center space-x-1 text-sky-500 hover:underline">
			<icon name="paper-clip" class=" h-5 w-5" />
			<span class="text-sm font-medium capitalize">Upload Files</span>
			</Link>
		</div>
    </div>

    <div v-else class="flex flex-col border-t-3 border-sky-500">
            <div>
              <table class="w-full whitespace-nowrap">
                <tr class="text-left text-sky-800 font-semibold bg-sky-100">
                  <th class="px-6 py-2"></th>
                  <th class="px-6 py-2">Document Name</th>
                  <th class="px-6 py-2">Size</th>
                  <th class="px-6 py-2 text-center">Actions</th>
                </tr>
                <tr
                  class="hover:bg-gray-100 focus-within:bg-gray-100"
                  v-for="(attachment, index) in attachments"
                  :key="index"
                >
                  <td class="border-t px-6 py-2">
                    <img :src="attachment.preview_url" class="w-8 h-6" alt="" />
                  </td>
                  <td class="border-t px-6 py-2">
                    <Link class="focus:text-indigo-500">
                      {{ attachment.name }}
                    </Link>
                  </td>
                  <td class="border-t px-6 py-2">
                    <Link class="focus:text-indigo-500">
                      {{attachment.size}}
                    </Link>
                  </td>
                  
                  <td class="border-t px-6 py-2 flex justify-end space-x-1 items-center">
                    <button @click="remove(attachment.id)" class="flex items-center space-x-1">
                      <icon name="trash" class="text-red-500 h-4 w-4" />
                      <span>Delete</span>
                    </button>
                 
                    <a :href="route('attachment.download', attachment)" class="rounded-lg space-x-1 px-4 py-1  flex items-center">
                        <icon name="download" class="text-yellow-500 h-4 w-4" />
                        <span> Download</span>
                    </a>
                  
                    <a :href="attachment.preview_url" target="_blank" class="rounded-lg space-x-1 px-4 py-1 flex items-center">
                        <icon name="photograph" class="text-sky-500 h-4 w-4" />
                        <span>View</span>
                    </a>
                  </td>
            </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Icon from '@/Components/Icon.vue'
export default {
  components: {
    Link,
	Icon
  },
  props: {
    attachments: Object,
    employee: Object
  },
 
  methods: {
    remove(attachment) {
		if (confirm("Are you sure ?")) {
			this.$inertia.delete(route('attachment.delete',attachment))
		}
    },
    
  },
};
</script>