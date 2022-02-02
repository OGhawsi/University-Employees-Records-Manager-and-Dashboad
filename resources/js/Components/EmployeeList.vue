<template>
    <div class="flex flex-col w-full flex-shrink-1 mb-8">
        <!-- main table display  -->
        <div class=" w-full flex-shrink-1 rounded-lg py-4">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left ">
                    <td class="px-4 pt-6 pb-4 text-gray-400"></td>
                    <td class="px-4 pt-6 pb-4 text-gray-400">Name</td>
                    <td class="px-4 pt-6 pb-4 text-gray-400"> Department</td>
                    <td class="px-4 pt-6 pb-4 text-gray-400"> Faculty</td>
                    <td class="px-4 pt-6 pb-4 text-gray-400" > email</td>
                </tr>
                <tr v-for="(employee, index) in employees.data" class="hover:bg-sky-100 focus-within:bg-sky-100 text-sm transition-colors" :class="{'bg-gray-50': index%2 === 0}">
                    <td class=" rounded-l-md">
                        <Link class="px-4 py-3 flex items-center focus:text-indigo-500" 
                                :href="route('employee.show', employee.id)">
                                <img v-if="employee.profile_photo_url" :src="employee.profile_photo_url" 
                                        class="h-8 w-8 rounded-full object-cover">
                                <icon v-if="!employee.profile_photo_url" 
                                    name="person" 
                                    class="w-8 h-8 stroke-current text-gray-400 bg-gray-100 rounded-full p-1" />
                        </Link>
                    </td>
                    <td class="">
                        <Link class="px-4 py-3 flex items-center focus:text-indigo-500" 
                                :href="route('employee.show', employee.id)">
                            <span v-if="employee.first_name_english">
                                {{ employee.first_name_english }}
                                {{ employee.last_name_english }}
                            </span>
                            <span v-else class="text-sm text-gray-500"> Name not set</span>
                        </Link>
                    </td>
                    <td class="" v-if="employee.working_department">
                        <Link class="px-4 py-3 flex items-center focus:text-indigo-500" :href="route('employee.show', employee.id)">
                            {{ employee.working_department.name }}
                        </Link>
                    </td>
                    <td class="" v-else>
                        <div class="px-4 py-3 text-gray-400">Department not chosen</div>
                    </td>
                    <td class="" v-if="employee.working_department.faculty">
                        <Link class="px-4 py-3 flex items-center focus:text-indigo-500" :href="route('employee.show', employee.id)">
                            {{ employee.working_department.faculty.name }}
                        </Link>
                    </td>
                    <td class="" v-else>
                        <div class="px-4 py-3 text-gray-400">Faculty not chosen</div>
                    </td>
                    <td class="rounded-r-md" v-if="employee.addresses[0]">
                        <Link class="px-4 py-3 flex items-center focus:text-indigo-500" :href="route('employee.show', employee.id)">
                            {{ employee.addresses[0].email }}
                        </Link>
                    </td>
                    <td class="rounded-r-md text-gray-500" v-else>
                          <Link class="px-4 py-3 flex items-center focus:text-indigo-500" :href="route('employee.show', employee.id)">
                            Email not found
                          </Link>
                    </td>
                </tr>
            </table>
        <!-- pagination links  -->
        </div>
        <div class="w-full flex-shrink-1 rounded-lg  pt-8">
            <pagination :links="employees.links" />
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue'
import Icon from '@/Components/Icon.vue';
export default {
    components: {
        Link,
        Pagination,
        Icon,
    },
    props: {
        employees: Object,
    }
}
</script>