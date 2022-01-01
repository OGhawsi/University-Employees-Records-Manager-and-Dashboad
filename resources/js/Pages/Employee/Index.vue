<template>
    <div class="max-w-7xl mx-auto px-6 sm:px-12 py-8">
        <div class=" mb-4">
           <h1 class="text-base font-medium text-gray-500">
                <Link
                :href="route('dashboard')"
                class="text-sky-500 hover:underline"
                >
                Dashboard
                </Link>
                / Employees
            </h1>
        </div>
    <div class="flex flex-col items-start mb-12">
        <!-- search box   -->
        <div class="flex justify-between items-end w-full mb-4">
            <div class="flex-shrink-0 rounded-lg flex items-center justify-start w-96 bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" 
                        class="ml-3 h-5 w-5 flex-grow-0 flex-shrink-0 stroke-current" 
                        fill="none" 
                        viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    class="w-full rounded-md border-none focus:ring-0 h-10 placeholder-gray-400 text-sm" 
                    type="text"
                    v-model="params.employee_search"
                    name="faculty_search" 
                    id="faculty_search"
                    placeholder="search employee name... "
                >
                <div
                    v-if="params.employee_search"
                    @click="this.params.employee_search = null" 
                    class="space-x-1 px-3 py-2 text-sm group hover:text-gray-900 
                            hover:bg-white text-gray-700 cursor-pointer ">
                        <!-- <span> esc</span> -->
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="h-5 w-5 stroke-current group-hover:text-gray-900 text-gray-700" 
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                </div>
            </div>
            <div>
                <Link :href="route('employee.create')" class="bg-sky-500 transition-colors hover:bg-yellow-600 text-white text-sm py-2 px-4 rounded-md shadow">Add Employee</Link>
            </div>
        </div>
        
        <div class="bg-white rounded-lg w-full px-10"> 
            <employee-list :employees="this.employees" />
        </div>

    </div>
    </div>
</template>
<script>
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
import { Link } from '@inertiajs/inertia-vue3';
import Icon from '@/Components/Icon.vue';
import EmployeeList from '@/Components/EmployeeList.vue';

export default {
    components : {
        Link,
        Icon,
        EmployeeList
    },
    props: {
        employees: Object,
        errors: Object,
        // filters: Object,
    }, 
    data() {
        return {
            params: {
                employee_search: null,
            },
        }
    },
    watch: {
        params: {
             handler: throttle(function() {
                this.$inertia.get(route('employee.index'), pickBy(this.params) , { 
                    preserveState: true,
                    preserveScroll: true,
                    replace: true });
            }, 500),
            deep: true,
        },
    },



}
</script>