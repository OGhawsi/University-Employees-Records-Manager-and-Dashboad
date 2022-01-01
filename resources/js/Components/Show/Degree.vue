<template>
     <div class="mb-6">
        <!-- title and button -->
        <div class="flex justify-between">
            <span class="text-lg font-bold tracking-wide">Education</span>
            <add-new-button :href="route('degree.create', employee.id)" />
        </div>
        <!-- table to show data -->
        <div v-if="!degrees[0]" class="border-2 rounded-lg mt-3 border-dashed border-sky-500 px-6 py-3"> 
            <add-new-button :href="route('degree.create', employee.id)" />
        </div>
        <div v-else class="border-t-3 border-sky-500">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-left text-sky-800 text-sm  font-semibold bg-sky-100">
                        <th class="px-6 py-2">Degree</th>
                        <th class="px-6 py-2">Department</th>
                        <th class="px-6 py-2">Country</th> 
                        <th class="px-6 py-2">Start Date</th>
                        <th class="px-6 py-2">Graduation</th>
                        <th class="px-6 py-2"></th>
                    </tr>
                    <tr class="text-sm hover:bg-gray-100 focus-within:bg-gray-100" v-for="(degree, index) in degrees" :key="index">
                        <td class="border-t px-6 py-2">
                            <Link :href="route('degree.edit', degree.id)" class=" focus:text-indigo-500">
                                <div v-if="degree.degree_name === 1"> Bachelor</div> 
                                <div v-if="degree.degree_name === 2"> Masters</div> 
                                <div v-if="degree.degree_name === 3"> PhD</div> 
                             </Link>
                        </td>
                        <td class="border-t px-6 py-2">
                            <Link v-if="degree.study_field_english" :href="route('degree.edit', degree.id)" class=" focus:text-sky-500"> {{degree.study_field_english}} </Link>
                            <span v-else class="text-sm text-gray-400">No Department</span>
                        </td>
                        <td class="border-t px-6 py-2">
                            <Link v-if="degree.country_english" :href="route('degree.edit', degree.id)" class=" focus:text-sky-500"> {{degree.country_english}} </Link>
                            <span v-else class="text-sm text-gray-400">No Country </span>
                        </td>
                        <td class="border-t px-6 py-2">
                            <Link v-if="degree.start_date" :href="route('degree.edit', degree.id)" class=" focus:text-sky-500"> {{degree.start_date}} </Link>
                            <span v-else class="text-sm text-gray-400">Date not found</span>
                        </td>
                        <td class="border-t px-6 py-2">
                            <Link v-if="degree.end_date" :href="route('degree.edit', degree.id)" class=" focus:text-sky-500"> {{degree.graduation_date}} </Link>
                            <span v-else class="text-sm text-gray-400">Date not found</span>
                        </td>
                        <td class="border-t">
                            <Link :href="route('degree.edit', degree.id)" class="px-4 flex items-center" tabindex="-1">
                                <icon name="chavron-right" class="h-5 w-5 text-gray-400" />
                            </Link>
                        </td>
                    </tr>
                </table>
        </div>
    </div>
</template>

<script>
import AddNewButton from '@/Components/AddNewButton.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Icon from '../Icon.vue';
export default {
    components: {
        AddNewButton,
        Link,
        Icon
    },
    props: {
        degrees: Object,
        employee: Object,
    },
}
</script>