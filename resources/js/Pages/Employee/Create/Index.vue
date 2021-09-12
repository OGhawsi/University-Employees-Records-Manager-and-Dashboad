<template>
    <div>
                      Personal
               <form @submit.prevent="submit">
                    <div class="flex flex-col bg-white rounded-t-lg  p-10 space-y-4" dir="rtl">
                            <div class="flex flex-col">
                                <label for="name">نوم</label>
                                <input type="text" name="name" v-model="form.name" class="w-80 rounded ">
                            </div>
                            <div class="flex flex-col">
                                <label for="academic_rank">علمی رتبه </label>
                                <input type="text" name="academic_rank" v-model="form.academic_rank" class="w-80 rounded ">
                            </div>
                            <div class="flex flex-col">
                                <label for="city">City</label>
                                <input type="text" name="city" v-model="form.city" class="w-80 rounded ">
                            </div>


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
        BreezeNavLink,
    },


    remember: {
    data: ['form'],
    key: 'Employee/Create/Index',
  },

    data() {
        return {
            form: this.$inertia.form ({
                name: null,
                academic_rank: null,
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
            this.form.submit('post','/employee', {
                preserveScroll: true,
                onSuccess: () => route(employee.create.personal),
            })
        }
    }
}
</script>