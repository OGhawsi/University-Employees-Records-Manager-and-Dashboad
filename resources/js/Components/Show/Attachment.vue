<template>
  <div>
    <div v-if="!attachments[0]">
      <!-- big drag and drop -->
    <Link :href="route('attachment.create', this.employee.id)">Upload Files</Link>
        
    </div>
    <div v-else class="flex justify-between items-start">
      <!-- show docs -->
      <div class="w-full">
        <div class="mb-6">
          <!-- title and button -->
          <div class="flex justify-between">
            <span class="text-xl font-bold tracking-wider"
              >Documents & Uploads</span
            >
                <Link :href="route('attachment.create', this.employee.id)">Upload Files</Link>

          </div>
          <div class="w-full border-t-2 border-gray-400 my-1"></div>
          <!-- table to show data -->
          <div class="flex flex-col">
            <div>
              <table class="w-full whitespace-nowrap">
                <tr class="text-left text-gray-600 font-semibold">
                  <th class="px-6 pt-4 pb-4"></th>
                  <th class="px-6 pt-4 pb-4">Document Name</th>
                  <th class="px-6 pt-4 pb-4">Size</th>
                  <th class="px-6 pt-4 pb-4 text-center" colspan="2">Actions</th>
                </tr>
                <tr
                  class="hover:bg-gray-100 focus-within:bg-gray-100"
                  v-for="(attachment, index) in attachments"
                  :key="index"
                >
                  <td class="border-t px-6 py-2">
                    <img :src="attachment.preview_url" class="h-10 w-10" alt="" />
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
                  
                  <td class="border-t px-6 py-2 text-center">
                    <button @click="remove(attachment.id)">Delete</button>
                  </td>
                  <td class="border-t px-6 py-2 text-center">
                    <!-- <Link class="focus:text-indigo-500"  target="_blank">
                      Donwload
                    </Link> -->
                    <a :href="route('attachment.download', attachment)" class="rounded-lg bg-gray-200 px-4 py-1">
                        Download
                    </a>
                  </td>
                  <td class="border-t px-6 py-2 text-center">
                    <a :href="attachment.preview_url" target="_blank" class="rounded-lg bg-gray-200 px-4 py-1">
                        View
                    </a>
                  </td>
                  
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
  props: {
    attachments: Object,
    employee: Object
  },
 
  methods: {
    remove(attachment) {
        this.$inertia.delete(route('attachment.delete',attachment))
    },
    
  },
};
</script>