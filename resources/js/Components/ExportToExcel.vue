<template>
    <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold ">
            <th class="px-6 pt-6 pb-4"></th>
            <th class="px-6 pt-6 pb-4">Name</th>
            <th class="px-6 pt-6 pb-4"> Department</th>
            <th class="px-6 pt-6 pb-4"> Faculty</th>
            <th class="px-6 pt-6 pb-4"> email</th>
        </tr>
        <tr v-for="employee in employees" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
                <Link class="px-6 py-4 flex items-center focus:text-indigo-500" 
                        :href="route('employee.show', employee.id)">
                        <img v-if="employee.profile_photo_url" :src="employee.profile_photo_url" 
                                class="h-10 w-10 rounded-full object-cover">
                        <icon v-if="!employee.profile_photo_url" 
                            name="person" 
                            class="w-10 h-10 stroke-current text-gray-400 bg-gray-100 rounded-full p-1" />
                </Link>
            </td>
            <td class="border-t">
                <Link class="px-6 py-4 flex items-center focus:text-indigo-500" 
                        :href="route('employee.show', employee.id)">
                    {{ employee.first_name }}
                    {{ employee.last_name }}
                </Link>
            </td>
            <td class="border-t" v-if="employee.working_department">
                <Link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('employee.show', employee.id)">
                    {{ employee.working_department.name }}
                </Link>
            </td>
            <td class="border-t" v-if="employee.working_faculty">
                <Link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('employee.show', employee.id)">
                    {{ employee.working_faculty.name }}
                </Link>
            </td>
            <td class="border-t" v-if="employee.addresses[0]">
                <Link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('employee.show', employee.id)">
                    {{ employee.addresses[0].email }}
                </Link>
            </td>
        </tr>
    </table>
    <div><button @click="export">export</button></div>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3'
export default {
    components: { Link, },
    props: {
        employees: Object,
    },
    data() {
        return {
            
        }
    },
    methods: {
        export() {
           
        }
    },
}
</script>