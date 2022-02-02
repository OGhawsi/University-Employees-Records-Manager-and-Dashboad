<template>
     <div class="mb-6">
        <!-- title and button -->
        <div class="flex justify-between">
            <span class="text-lg font-bold tracking-wide">Academic Ranks</span>
            <add-new-button :href="route('rank.create', employee.id)" />
        </div>
        <!-- table to show data -->
        <div v-if="!employee.ranks[0]" class="border-2 rounded-lg mt-2 border-dashed border-sky-500 px-6 py-3">
            <add-new-button :href="route('rank.create', employee.id)" />
        </div>

        <div v-else class="border-t-3 border-sky-500">
                <table class="w-full whitespace-nowrap">
                    <tr class="text-sm text-left text-sky-800 font-semibold bg-sky-100">
                        <th class="px-6 py-2">Reaserch Topic</th>
                        <th class="px-6 py-2">Academic Rank</th>
                        <th class="px-6 py-2">Registration</th>
                        <th class="px-6 py-2">Completion</th>
                        <th class="px-6 py-2"></th>
                    </tr>
                    <tr class="text-sm hover:bg-gray-100 focus-within:bg-gray-100" v-for="(rank, index) in employee.ranks" :key="index" >
                        <td class="border-t px-6 py-2" >
                            <Link v-if="rank.pivot.subject_of_academic_research" :href="`/employee/rank/edit/${employee.id}/${rank.pivot.id}`" class=" focus:text-indigo-500"> {{rank.pivot.subject_of_academic_research}}</Link>
                              <span v-else class="text-sm text-gray-400">Topic not found</span>
                        </td>
                        <td class="border-t px-6 py-2">
                            <Link v-if="rank.name_english" :href="`/employee/rank/edit/${employee.id}/${rank.pivot.id}`" class=" focus:text-indigo-500"> 
                                {{rank.name_english}}
                            </Link>
                              <span v-else class="text-sm text-gray-400">Rank not found</span>
                        </td>
                        <td class="border-t px-6 py-2">
                            <Link v-if="rank.pivot.registration_of_academic_research" :href="`/employee/rank/edit/${employee.id}/${rank.pivot.id}`" class=" focus:text-indigo-500">{{rank.pivot.registration_of_academic_research}}</Link>
                              <span v-else class="text-sm text-gray-400">Date not found</span>
                        </td>
                        <td class="border-t px-6 py-2" >
                            <Link v-if="rank.pivot.completion_of_academic_research" :href="`/employee/rank/edit/${employee.id}/${rank.pivot.id}`" class="focus:text-indigo-500">{{rank.pivot.completion_of_academic_research}}</Link>
                          <span v-else class="text-sm text-gray-400">Date not found</span>
                        </td>
                        <td class="border-t">
                            <Link :href="`/employee/rank/edit/${employee.id}/${rank.pivot.id}`" class="px-4 flex items-center" tabindex="-1">
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
import Icon from '@/Components/Icon.vue'
export default {
    components: {
        AddNewButton,
        AcademicRank,
        Link,
        Icon,
    },
    props: {
        employee: Object,
    },
}
</script>