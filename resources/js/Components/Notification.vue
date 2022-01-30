<template>
    <transition name="slide-fade">
        <div v-if="toast && visible" class="absolute flex max-w-xs w-full mt-4 mr-4 top-12 right-0 rounded-md shadow-md p-4 bg-white">
            <div class="mr-2">
                 <icon name="check-circle" class="text-green-600" />
            </div>
            <div class="flex-1 text-gray-600">
                {{toast.message}}
            </div>
            <div class="ml-2">
                <button @click="this.visible = false" class="align-top text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600">
                    <icon name="x" />
                </button>
            </div>
        </div>
    </transition>
</template>
<script>

import Icon from '@/Components/Icon.vue'
export default {
    components: {
        Icon
    }, 
    props: {
        toast: Object,
        popstate: Boolean
    }, 
    data() {
        return {
            visible: false,
            timeout: null,
        }
    }, 
    watch: {
        toast: {
            deep:true,
            handler() {
                this.visible = true

                if (this.timeout) {
                    clearTimeout(this.timeout)
                }
                this.timeout = setTimeout(() => this.visible = false, 2000)
            }
        }
    }
}
</script>

<style>
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .4s ease;
}
.slide-fade-leave-active {
  transition: all .6s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
    
</style>