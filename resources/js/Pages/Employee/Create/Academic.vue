<template>
  
    <div>
                academic
                   <form @submit.prevent="submit">
                    <div class="flex flex-col bg-white rounded-t-lg  p-10 space-y-4" dir="rtl">
                      
                            <div class="flex flex-col">
                                <label for="name">Name</label>
                                <input type="text" name="name" v-model="form.name" class="w-80 rounded ">
                            </div>
                            <div class="flex flex-col">
                                <label for="rank">Accademic Rank </label>
                                <input type="text" name="rank" v-model="form.rank" class="w-80 rounded ">
                            </div>
                            <div class="flex flex-col">
                                <div class="flex">
                                    <select name="filter" id="filter" v-model="form.faculty">
                                        <option value="edu">Educatoin Facluty</option>
                                        <option value="eng">Engineering Facluty</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <label for="city">City</label>
                                <input type="text" name="city" v-model="form.city" class="w-80 rounded ">
                            </div>

                            <!-- file Upload -->
                            <!-- <div
                                @drop.prevent="onDropFiles"
                                @dragover.prevent="dragging = true"
                                @dragleave.prevent="dragging = false "

                                :class="[ dragging ? 'border-indigo-500' : 'border-gray-400 bg-gray-100 flex items-center flex-col my-20 border-4 rounded px-6 py-10 border-dashed w-72 h-60']"
                                class="bg-gray-100 flex items-center flex-col my-20 border-4 rounded px-6 py-10 border-dashed w-72 h-60">
                                <p>Drop your files here</p>
                                <p>OR</p>
                                <label class="bg-white px-4 h-9 rounded border shadow  inline-flex items-center my-4">
                                     Select files
                                <input ref="files" @input="onSelectedFiles" type="file" name="files" id="files" multiple class="sr-only">
                                </label>

                                <p>Max size should be 50 MB. </p>
                            </div > -->

                            <!-- display uploading files along with progress bar  -->
                            <ul class="my-6 bg-gray-200 rounded divide-y divide-white shadow">
                                <li v-for="(item, index) in media" :key="index"
                                    class="p-3 flex items-center justify-between">
                                    <div class="text-sm text-gray-700">{{item.file.name}}</div>
                                    <div v-if="item.uploaded < 100 && !item.error" class="text-gray-700">{{item.progress}}%</div>
                                    <div v-if=" item.uploaded " class="text-indigo-500 underline text-sm">Edit</div>

                                    <div v-if="item.error" class="text-sm text-red-600">
                                        {{item.error}}
                                    </div>
                                </li>
                            </ul>
                        



                    </div>
                    <div class="bg-gray-200 rounded-b-lg">
                        <button  type="submit"  class="bg-gray-900 text-white px-4 py-2 rounded text-sm float-right mx-4 my-2"> Save </button>
                    </div>
               </form>
           
            
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import axios from 'axios';
import BreezeNavLink from '@/Components/NavLink.vue'
import Authenticated from '@/Layouts/Authenticated.vue';
import EmployeeCreate from '@/Layouts/EmployeeCreate.vue';
export default {
      layout: (h, page) => {
        return h(Authenticated, [
            h(EmployeeCreate, [page])
        ])
    },

    components: {
        Link,
        BreezeNavLink
    },
     remember: {
    data: ['form'],
    key: 'Employee/Create/Academic',
  },
    data() {
        return {
            form: this.$inertia.form ({
                name: null,
                rank: null,
                faculty: null,
                city: null,
            }),

            dragging: false,
            media: [], 
        }
    },
    methods: {
        onDropFiles($event) {
            this.dragging = false;

            let files = [...$event.dataTransfer.items]
                .filter(item => item.kind === 'file')
                .map(item => item.getAsFile());

            this.uploadFiles(files);
        },

        onSelectedFiles ($event) {
            let files = [...$event.target.files];
               this.uploadFiles(files);
               this.$refs.files.value = null;
        },
        
        uploadFiles(files) {
            files.forEach( file => {
                this.media.unshift({
                    file: file,
                    progress: 0,
                    error: null,
                    uploaded: false,
                })
            })

            this.media.filter(media => !media.uploaded)
                .forEach(media => {
                    let form = new FormData;

                    form.append('file', media.file);

                    axios.post(this.route('media.store'), form, {
                        onUploadProgress: (event) => {
                            media.progress = Math.round(event.loaded * 100 / event.total);
                        }
                    }).then(() => media.uploaded = true)
                        .catch(error => {
                        media.error = `upload fail please try again`;
                        
                        if(error?.response.status === 422) {
                            media.error = error.response.data.errors.file[0];
                        }
                    })
                })
            
        }, 
        submit() {
            this.form.submit('post','/crud', {
                preserveScroll: true,
                onSuccess: () => form.reset()
            })
        }
    }
}
</script>