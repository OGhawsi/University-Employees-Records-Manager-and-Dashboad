<template>
    <div class="max-w-7xl mx-auto px-6 sm:px-12 py-8">
        <div class="flex items-start">
            <!-- left column for names  -->
            <div class="w-1/5 flex-shrink-0">
                <div class="text-xl text-gray-700 font-semibold mb-8"><span class="pb-4 border-b border-gray-400">All Faculties</span></div>
                <div class="border-b w-48 my-3 pb-3 text-gray-500 border-gray-300" v-for="faculty in faculties" > 
                    <Link   :href="route('faculty.index', faculty.id)" 
                            :class="{'text-sky-500 font-medium transition-colors':$page.url === `/faculty/${faculty.id}`}" 
                            class=" hover:text-sky-500 transition-colors">
                        <span>{{faculty.name}}</span>
                    </Link>
                </div>
            </div>

			<!-- Content -->
			<slot />

        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        Link,
    },
    data() {
        return {
        }
    },
    computed: {
        faculties() {
            return this.$page.props.faculties.names;
        }
    },
}
</script>