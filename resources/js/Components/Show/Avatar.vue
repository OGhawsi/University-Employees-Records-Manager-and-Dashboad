<template>
    <input  type="file" accept="image/*" ref="file" class="hidden" @change="change">

     <div 
            @mouseenter="showButtons = true"
            @mouseleave="showButtons = false" class="relative inline-block">
         <img v-if="src" :src="src" alt="Avatar" class="h-44 w-44  rounded-lg shadow-md object-cover">
         <div v-else class="bg-gray-200 rounded-lg shadow-md">
             <icon name="person" class="stroke-current text-gray-300 h-40 w-40 rounded-lg  object-cover bg-gray-200" />
         </div>
         <div v-if="showButtons" class="rounded-full absolute top-0 h-full w-full flex items-center justify-center">
            <button @click="browse" class="rounded-full text-white bg-black bg-opacity-30 hover:bg-black hover:bg-opacity-20 p-2 focus:outline-none">
                <icon name="camera" class="h-5 w-5 "></icon>
            </button>
            <button v-if="src" @click="remove" class="rounded-full text-white bg-black bg-opacity-30 hover:bg-black hover:bg-opacity-20 p-2 focus:outline-none">
                <icon name="x" class="h-5 w-5" />
            </button>
         </div>
     </div>
</template>
<script>
import Icon from '@/Components/Icon.vue'
export default {
    props: {
        employee: Object,
    },
    components: {
        Icon,
    },
    data() {
        return {
            showButtons: false,
            src: this.employee.profile_photo_url,
            form: this.$inertia.form({
                file: null
            })
        }
    },
    methods: {
        remove() {
            this.$inertia.delete(route('employee.removeAvatar', this.employee.id));
            this.src = null;
        },
        browse() {
            this.$refs.file.click();
        },
        change(e) {
  
            this.form.file = e.target.files[0];
            this.$emit('update:modelValue', this.form.file);

            let reader = new FileReader();
            reader.readAsDataURL(this.form.file);
            reader.onload = (e) => {
                this.src = e.target.result;
            }
            
            this.$inertia.post(route('employee.addAvatar', this.employee),{
                _method: 'put',
                file: this.form.file
            })
        }
    }
}
</script>