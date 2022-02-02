<template>
     <div class="mb-6">
        <!-- title and button -->
        <div class="flex justify-between">
            <span class="text-lg font-bold tracking-wide">Employment History</span>
            <add-new-button :href="route('employment.create', employee.id)" />
    <!-- TODO: move the delete ac tion to the edit pages of every section  -->
        </div>
        <!-- table to show data -->
        <div v-if="!employments[0]" class="border-2 rounded-lg mt-3 border-dashed border-sky-500 px-6 py-3">
            <add-new-button :href="route('employment.create', employee.id)" />
        </div>

        <div v-else class=" border-t-3 border-sky-500">
            <table class="w-full whitespace-nowrap">
                <tr class="text-sm text-left text-sky-800 font-semibold bg-sky-100">
                    <th class="px-6 py-2">Post title</th>
                    <th class="px-6 py-2">Designation</th>
                    <th class="px-6 py-2">Academic Rank</th> 
                    <th class="px-6 py-2">Employment Date</th>
                    <th class="px-6 py-2"></th>
                </tr>
                <tr class="text-sm hover:bg-gray-100 focus-within:bg-gray-100" v-for="(employment, index) in employments" :key="index">
                    <td class="border-t px-6 py-2">
                        <Link :href="route('employment.edit', employment.id)" class=" focus:text-indigo-500"> {{employment.post_title}} </Link>
                    </td>
                    <td class="border-t px-6 py-2">
                        <Link :href="route('employment.edit', employment.id)" class=" focus:text-indigo-500"> {{employment.designation}} </Link>
                    </td>
                    <td class="border-t px-6 py-2">
                        <Link :href="route('employment.edit', employment.id)" class=" focus:text-indigo-500">
                            <academic-rank :rank="employment" />
                        </Link>
                    </td>
                    <td class="border-t px-6 py-2">
                        <Link :href="route('employment.edit', employment.id)" class=" focus:text-indigo-500"> {{employment.employment_date}} </Link>
                    </td>
                    <td class="border-t">
                        <Link :href="route('employment.edit', employment.id)" class="px-4 flex items-center" tabindex="-1">
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
import AcademicRank from './AcademicRank.vue';
export default {
    components: {
        AddNewButton,
        AcademicRank,
        Link,
    },
    props: {
        employments: Object,
        employee: Object,
    },
}
</script>