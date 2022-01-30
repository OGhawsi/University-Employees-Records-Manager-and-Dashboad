<template>
        <!-- right column for details  -->
        <div class="w-full ml-4">
            <div class="flex justify-between items-center ">
                <Link :href="route('faculty.edit', faculty.id)">
                    <div class="text-2xl font-bold group transition-colors text-gray-600 flex space-x-2 items-center">
                        <span class="group-hover:text-sky-500 group-hover:underline">{{faculty.name}}</span>
                        <icon name="pencil" class=" stroke-current group-hover:text-sky-500 " />
                    </div>
                </Link>
                <div class="flex items-center pb-2" >
                    <div v-if="faculty.employee">
                        <Link class=" p-2 flex items-center focus:text-indigo-500" 
                                :href="route('employee.show', faculty.employee.id)">
                                <img v-if="faculty.employee.profile_photo_url" :src="faculty.employee.profile_photo_url" 
                                        class="h-8 w-8 rounded-full object-cover">
                                <icon v-if="!faculty.employee.profile_photo_url" 
                                    name="person" 
                                    class="w-8 h-8 stroke-current text-gray-400 bg-gray-100 rounded-full p-1" />
                        </Link>
                    </div>
                    <div class="flex flex-col px-2"> 
                        <span class="text-gray-500 text-sm">Dean</span>
                        <span class="text-gray-700 font-medium text-sm" v-if="faculty.employee">
                            <Link :href="route('employee.show', faculty.employee.id)">{{faculty.employee.first_name_english}}</Link>
                        </span>
                        <span class="text-gray-600 text-base" v-else>No dean assigned</span>
                    </div>
                </div>
            </div>
                <!-- first chart with employee count -->
            <div class="w-full  p-6 flex-grow bg-white rounded-lg ">
                <div class="  border-b border-gray-200 text-gray-500 text-sm pb-2 flex justify-between">
                    <div>Emplyees Academic Rank</div>
                    <div class="hover:underline transform  ease-in font-bold text-sky-500">
                        <Link :href="route('faculty.create')" class="flex">
                            <icon name="plus" />
                            New Faculty
                        </Link>
                    </div>
                </div>
                <div class="flex p-10">
                    <div class="w-2/6 pt-8">
                            <div class="flex items-center">
                                <div class="mr-3 p-4 rounded-full bg-sky-100">
                                    <icon name="users" class="h-5 w-5 text-sky-600 " />
                                </div>
                                <div class="flex flex-col"> 
                                    <span class="text-gray-600 text-4xl font-bold">{{totalEmployees}}</span>
                                    <span class="text-gray-600 text-sm">total employees</span>
                                </div>
                            </div>
                            <div class="flex items-center mt-16">
                                <div class="mr-3 p-4 rounded-full bg-sky-100">
                                <icon name="hat" class="h-5 w-5 text-sky-600 " />
                                </div>
                                <div class="flex flex-col"> 
                                    <span class="text-gray-600 text-4xl font-bold">{{totalDepartments}}</span>
                                    <span class="text-gray-600 text-sm">Total Departments</span>
                                </div>
                            </div>
                    </div>
                    <div class="w-full overflow-auto pl-10">
                        <pie-chart 
                                donut="true"
                                legend="right"
                                :library="{plotOptions: { pie: {  allowPointSelect: true,
                                                            cursor: 'pointer', 
                                                        dataLabels: { enabled: true, format: '<strong>{point.name}:</strong> <i>{point.y}</i>' }, 
                                                        showInLegend: false }}}"
                                 :colors="['#FF217E', '#803755', '#CC1B64', '#FF6EAA', '#08D7FF', '#2A7180', '#06ABCC', '#54E3FF']"  
                                adapter="highcharts" :data="ranks_data">
                        </pie-chart>
                    </div>
                </div>
            </div>
            <!-- bar  charts  -->
            <div class="w-full mt-8 flex-grow">
                <div class="flex w-full space-x-6">
                    <div class="flex flex-col w-full bg-white rounded-lg p-6">
                        <div class=" pt-4 border-b border-gray-200 text-gray-500 text-sm pb-2 mb-6 flex justify-between">
                            <div>Employees based on departments</div>
                            <div class="hover:underline font-bold text-sky-500">
                                <Link :href="route('department.create', faculty.id)" class="flex">
                                      <icon name="plus" />
                                        New department
                                      </Link>
                            </div>
                        </div>
                        <column-chart adapter="highcharts"
                                    :data="this.department_series"
                                    :library="{ plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}}}">
                        </column-chart>
                    </div>
                </div>
            </div>
            <!-- Departments -->
            <div class=" w-full mt-8 px-6 flex-grow bg-white rounded-lg p-6">
                <div class="pt-4 border-b border-gray-200 text-gray-500 text-sm pb-2 flex justify-between">
                    <div>All Departments </div>
                    <div class="underline font-bold text-sky-500">
                        <Link :href="route('employee.create')" class="flex">
                              <icon name="plus" />
                            New employee
                        </Link>
                    </div>
                </div>
                <div class="py-10">
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left text-sm text-gray-500">
                            <td class="px-2 pb-2">Department</td>
                            <td class="px-2 pb-2">Photo</td>
                            <td class="px-2 pb-2">Name</td>
                            <td class="px-2 pb-2">Mobile</td>
                            <td class="px-2 pb-2">Email</td>
                        </tr>
                        <tr v-for="(department,index) in departments" class="hover:bg-sky-100 focus-within:bg-sky-100 text-sm" :class="{'bg-gray-50': index % 2 === 0}">
                            <td class="rounded-l-md" >
                                <Link class="px-2 focus:text-indigo-500" 
                                        :href="route('department.edit', department.id)">
                                        {{department.name}}
                                </Link>
                            </td>
                            <td class="" v-if="department.employee">
                                <Link class="px-2 focus:text-indigo-500" 
                                        :href="route('employee.show', department.employee.id)">
                                        <img v-if="department.employee.profile_photo_url" :src="department.employee.profile_photo_url" 
                                                class="h-6 w-6 rounded-full object-cover ml-2">
                                        <icon v-if="!department.employee.profile_photo_url" 
                                            name="person" 
                                            class="w-6 h-6 stroke-current text-gray-400 bg-gray-100 rounded-full p-1 ml-2" />
                                </Link>
                            </td>
                            <td v-else class="px-2">
                                 <icon      name="person" 
                                            class="w-6 h-6 stroke-current text-gray-400 bg-gray-100 rounded-full p-1 ml-2" />
                            </td>
                            <td class="" v-if="department.employee">
                                <Link class=" px-2  focus:text-indigo-500" 
                                        :href="route('employee.show', department.employee.id)">
                                    {{ department.employee.first_name_english }} {{ department.employee.last_name_english }}
                                </Link>
                            </td>
                            <td v-else class="text-gray-500 text-sm p-2">
                                HOD not found
                            </td>
                            <td class="" v-if="department.employee" >
                                <div v-if="department.employee.addresses[0]">
                                    <Link class="px-2 focus:text-indigo-500" :href="route('employee.show', department.employee.id)">
                                        {{ department.employee.addresses[0].contact_no }}
                                    </Link>
                                </div>
                                <div class="text-gray-400 px-2" v-else>
                                    No Mobile
                                </div>
                            </td>
                            <td v-else class="text-gray-500 text-sm p-2">
                               No mobile
                            </td>
                            <td class="rounded-r-md" v-if="department.email" >
                                <div v-if="department.email">
                                    <Link class="px-2 flex items-center focus:text-indigo-500" :href="route('department.edit', department.id)">
                                        {{ department.email}}
                                    </Link>
                                </div>
                                <div class="text-gray-400 p-2" v-else>
                                    No Email
                                </div>
                            </td>
                        </tr> 
                    </table>
                </div>
                    
            </div>
        </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import pickBy from 'lodash/pickBy';
import Pagination from '@/Components/Pagination'
import Icon from '@/Components/Icon'
import FacultyLayout from '@/Layouts/FacultyLayout.vue';
export default {
    layout: (h, page) => {
        return h(AuthenticatedLayout, [
            h(FacultyLayout, [page])
        ])
    },
    components : {
        Link,
        Icon,
    },
    props: {
      faculty: Object,
      departments: Object,
      academic_ranks:Object
    }, 
    data() {
        return {
            ranks_data:[],
            department_series:[],
        }
    },
    created() {
        this.ranksData;
        this.departmentsWithEmployeesCount;
    },
    computed: {
        departmentsWithEmployeesCount() {
             return this.departments.forEach(element => {
                this.department_series.unshift([element.name, element.employees_count])
            });
        },
        ranksData() {
             return this.academic_ranks.forEach(element => {
                switch (element.rank_id) {
                    case 1:
                            this.ranks_data.unshift(['Teaching Assistant', element.total_employees]);
                        break;
                    case 2:
                            this.ranks_data.unshift(['Lecturer', element.total_employees]);
                        break;
                    case 3:
                            this.ranks_data.unshift(['Assist. Prof', element.total_employees]);
                        break;
                    case 4:
                            this.ranks_data.unshift(['Sen. Assist. Prof', element.total_employees]);
                        break;
                    case 5:
                            this.ranks_data.unshift(['Assoc. Prof', element.total_employees]);
                        break;
                    case 6:
                            this.ranks_data.unshift(['Sen. Assoc.Prof', element.total_employees]);
                        break;
                    case 7:
                            this.ranks_data.unshift(['Professor', element.total_employees]);
                        break;
                }
            });
        },
        totalEmployees() {
            return this.faculty.employees.length;
        },
        totalDepartments() {
            return this.departments.length;
        }
    },
    methods: {
        
    },


}
</script>