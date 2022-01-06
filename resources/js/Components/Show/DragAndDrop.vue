<template>
  <div>
    <div
      class=" border-3 border-gray-400 bg-gray-100 rounded-md border-dashed flex flex-col p-10 items-center"
      @drop.prevent="onDroppedFiles"
      @dragover.prevent="dragging = true"
      @dragleave.prevent="dragging = false"
      :class="[
        dragging ? 'border-indigo-500' : 'border-gray-400',
        'border-2 bg-gray-100  rounded-md border-dashed flex flex-col p-10 items-center ',
      ]"
    >
      <div class="mb-4">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          :class="[
            dragging ? 'text-indigo-500' : 'text-gray-300',
            'h-14 w-14 stroke-current',
          ]"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1"
            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
          />
        </svg>
      </div>
      <div class="text-md md:text-lg font-medium text-center">
        Drop your files here
      </div>
      <div>Or</div>

        <label for="files" class="bg-white px-4 py-2 text-gray-700 shadow rounded my-4 cursor-pointer">
            Select Files
            <input ref="files" @input="onSelectedFiles" multiple name="files" type="file" id="files" class=" sr-only">
        </label>
      <div class="text-sm text-center">
        Max size should not be greater than 75 MB
      </div>
    </div>
    <ul class="bg-gray-100 my-6 divide-y divide-y-gray-200 rounded shadow">
      <li
        class="p-3 flex items-center justify-between"
        v-for="(item, index) in media"
      >
        <div class="text-sm text-gray-700">{{ item.file.name }}</div>
        <div
          v-if="item.progress < 100 && !item.error"
          class="text-sm text-green-500"
        >
          {{ item.progress }}%
        </div>
        <div
          v-if="item.progress === 100 && !item.error"
          class="text-sm text-green-500"
        >
          Uploaded
        </div>
        <div v-if="item.error" class="text-sm text-red-400">
          {{ item.error }}
        </div>
      </li>
    </ul>

  </div>
</template>

<script>
import axios from "axios";
export default {
  props: {
      employee: Object,
  },
 
  data() {
    return {
      dragging: false,
      media: [],
    };
  },
  watch: {
      media() {
          this.$emit('filesUploaded', this.media)
      }
  },
  methods: {
    onDroppedFiles($event) {
      this.dragging = false;
      let files = [...$event.dataTransfer.items]
        .filter((item) => item.kind === "file")
        .map((item) => item.getAsFile());

        this.uploadFiles(files);
    },
    onSelectedFiles($event) {
        let files = [...$event.target.files];
        this.uploadFiles(files);
        this.$refs.files.value = null;
    },
    uploadFiles(files) {
      // add files to the array 
        files.forEach((file) => {
        this.media.unshift({
          file: file,
          progress: 0,
          error: null,
          uploaded: false,
        });
      });

      // upload files to the server
      this.media.filter((media) => !media.uploaded).forEach((media) => {
          let form = new FormData();
          form.append("file", media.file);

          axios.post(this.route("attachment.store", this.employee.id), form, {
              onUploadProgress: (event) => {
                media.progress = Math.round((event.loaded * 100) / event.total);
              },
            })
            .then(function() {
              media.uploaded = true
            })
            .catch((error) => {
              media.error = "Upload failed, try again later.";
              if (error?.response.status === 422) {
                media.error = error.response.data.errors.file[0];
              }
            });
        });
    }
  },
};
</script>