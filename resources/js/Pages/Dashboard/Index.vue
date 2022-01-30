<template>
    <Head title="Dashboard" />
        <div class="py-8">
            <div class="max-w-7xl mx-auto px-6 sm:px-12">
                <!-- boxes -->
                <div class="flex justify-between space-x-8">
                    <Link :href="route('setting')" class="w-full ">
                        <div class="bg-white hover:shadow-md transition-shadow p-5 rounded-lg w-full flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="mr-3 p-2 rounded-full bg-sky-100">
                                    <icon name="users" class="h-5 w-5 text-sky-600 " />
                                </div>
                                <div class="text-gray-500">Total Capacity</div>
                            </div>
                            <div class="text-xl text-gray-700 font-bold">
                                {{total_seats.seats}}
                            </div>
                        </div>
                    </Link>
                     <Link href="http://127.0.0.1:8000/report?is_due=true" class="w-full">
                        <div class="bg-white hover:shadow-md transition-shadow p-5 rounded-lg w-full flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="mr-3 p-2 rounded-full bg-sky-100">
                                    <icon name="employees" class="h-5 w-5 text-sky-600 " />
                                </div>
                                <div class="text-gray-500">Acc. Rank. Due</div>
                            </div>
                            <div class="text-xl text-gray-700 font-bold">
                                {{rankDueCount}}
                            </div>
                        </div>
                    </Link>
                    <Link :href="route('faculty.index', 1)" class="w-full">
                        <div class="bg-white hover:shadow-md transition-shadow p-5 rounded-lg w-full flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="mr-3 p-2 rounded-full bg-sky-100">
                                    <icon name="building" class="h-5 w-5 text-sky-500 " />
                                </div>
                                <div class="text-gray-500">Total Faculties</div>
                            </div>
                            <div class="text-xl text-gray-700 font-bold">
                                {{total_faculties}}
                            </div>
                        </div>
                    </Link>
                    <Link href="#" class="w-full">
                        <div class="bg-white hover:shadow-md transition-shadow p-5 rounded-lg w-full flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="mr-3 p-2 rounded-full bg-sky-100">
                                    <icon name="hat" class="h-5 w-5 text-sky-600 " />
                                </div>
                                <div class="text-gray-500">Total Departments</div>
                            </div>
                            <div class="text-xl text-gray-700 font-bold">
                                {{total_departments}}
                            </div>
                        </div>
                    </Link>
                </div>
                <!-- first two charts  -->
                <div class="flex space-x-8 mt-8">
                    <!-- first chart with employee count -->
                    <div class="w-full p-6 flex-grow bg-white rounded-md">
                        <div class=" border-b border-gray-200 text-gray-500 text-sm pb-2 mb-8 flex justify-between">
                            <div>Employees and Academic Ranks</div>
                            <div class="hover:underline font-medium text-sky-500">
                                <Link  :href="route('rank.addRank')" class="flex">
                                    <icon name="plus" />
                                    New Academic Rank
                                 </Link>
                            </div>
                        </div>
                      
                        <div class="flex p-10">
                            <div class="w-2/6 pt-8">
                                <Link :href="route('employee.index')">
                                    <div class="flex items-center">
                                        <div class="mr-3 p-4 rounded-full bg-sky-100">
                                            <icon name="users" class="h-5 w-5 text-sky-600 " />
                                        </div>
                                        <div class="flex flex-col"> 
                                            <span class="text-gray-600 text-4xl font-bold">{{total_employees}}</span>
                                            <span class="text-gray-600 text-sm">total employees</span>
                                        </div>
                                    </div>
                                </Link>
                                  <Link :href="route('setting')">
                                    <div class="flex items-center mt-16">
                                        <div class="mr-3 p-4 rounded-full bg-sky-100">
                                        <icon name="announcement" class="h-5 w-5 text-sky-600 " />
                                        </div>
                                        <div class="flex flex-col"> 
    
                                            <span class="text-gray-600 text-4xl font-bold">{{emptySeats}}</span>
                                            <span class="text-gray-600 text-sm">Empty Seats</span>
                                        </div>
                                    </div>
                                    </Link>
                            </div>
                            <div class="w-full overflow-auto pl-10">
                                <pie-chart
                                        id="ranks"
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
                    <!-- second chart  -->
                    <div class="w-1/4 flex-shrink-0 p-6 bg-white rounded-lg">
                        <div class="border-b pb-2 text-sm text-gray-500 border-gray-100">
                            Employees Availibilty
                        </div>
                            <pie-chart class="pt-10"
                                    legend="bottom"
                                    :library="{plotOptions: { pie: {  allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: false }, showInLegend: true }}}"
                                    :colors="['#FF217E', '#08D7FF', '#803755']"  
                                    adapter="highcharts" :data="available_employees_count">
                        </pie-chart>
                    </div>
                </div>
                <!-- bar  charts  -->
                <div class="flex mt-8 space-x-8">
                    <div class="flex flex-col flex-grow w-full p-6 pt-0 bg-white rounded-lg">
                        <div class="py-6 border-b border-gray-200 text-gray-500 text-sm pb-2 mb-8 flex justify-between">
                            <div>Employees based on Faculties</div>
                            <div class="hover:underline font-medium text-sky-500">
                                <Link :href="route('faculty.create')" class="flex">
                                    <icon name="plus" />
                                    New Faculty
                                </Link>
                            </div>
                        </div>
                        <column-chart adapter="highcharts"
                                    :data="this.faculty_series"
                                    :colors = "[ '#08D7FF']"
                                    :library="{ plotOptions: {column: {pointPadding: 0.1,borderWidth: 0}}}">
                        </column-chart>
                    </div>
                     <div class="w-1/4 p-6 flex-shrink-0 bg-white rounded-lg">
                        <div class=" border-b border-gray-200 text-gray-500 text-sm pb-2 mb-8 flex justify-between">
                            <div>Academic Ranks</div>
                            <div class="hover:underline font-medium text-sky-500">
                                 <Link  :href="route('rank.addRank')" class="flex">
                                    <icon name="plus" />
                                    New Rank
                                 </Link>
                            </div>
                        </div>
                        <div>
                            <table class="w-full">
                                <tr v-for="(rank, index) in ranks.data" class="hover:bg-sky-100 focus-within:bg-sky-100 text-sm" :class="{'bg-gray-50': index%2 === 0}">
                                    <td class="rounded-l-md  py-2 px-2 mt-3 ">
                                        <Link class=" focus:text-indigo-500" 
                                                :href="route('rank.editRank', rank.id)">
                                               {{rank.academic_rank}}
                                        </Link>
                                    </td>
                                    <td class="rounded-l-md  py-2 px-2 mt-3 ">
                                        <Link class=" focus:text-indigo-500" 
                                                :href="route('rank.editRank', rank.id)">
                                               {{rank.name_english}}
                                        </Link>
                                    </td>
                                    <td class="rounded-r-md  py-2 px-2 mt-3 text-left">
                                        <Link class=" focus:text-indigo-500" 
                                                :href="route('rank.editRank', rank.id)">
                                               {{rank.name}}
                                        </Link>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Deans List -->
                <div class="flex mt-8 space-x-8">
                    <div class=" w-full px-10 pb-10 bg-white rounded-md shadow-sm">
                        <div class="flex-none py-10 border-b border-gray-100 text-gray-500 text-sm pb-2 mb-4 flex justify-between">
                            <div>All Deans </div>
                            <div class="hover:underline font-medium text-sky-500">
                                <Link :href="route('employee.create')" class="flex">
                                    <icon name="plus" />
                                    New Employee
                                </Link>
                            </div>
                        </div>
                        <div>
                            <table class="w-full whitespace-nowrap">
                            <tr class="text-left text-sm text-gray-500">
                                <td class="px-4 pt-4 pb-2"></td>
                                <td class="px-4 pt-4 pb-2">Name</td>
                                <td class="px-4 pt-4 pb-2">Faculty</td>
                                <td class="px-4 pt-4 pb-2">Mobile No</td>
                                <td class="px-4 pt-4 pb-2">Email</td>
                            </tr>
                            <tr v-for="(faculty, index) in faculties" class="hover:bg-sky-100 focus-within:bg-sky-100 text-sm" :class="{'bg-gray-50': index%2 ===0}" >
                                <td class="rounded-l-md" v-if="faculty.employee">
                                    <Link class="px-4 pt-3 pb-1 flex items-center focus:text-indigo-500" 
                                            :href="route('employee.show', faculty.employee.id)">
                                            <img v-if="faculty.employee.profile_photo_url" :src="faculty.employee.profile_photo_url" 
                                                    class="h-8 w-8 rounded-full object-cover">
                                            <icon v-if="!faculty.employee.profile_photo_url" 
                                                name="person" 
                                                class="w-8 h-8 stroke-current text-gray-400 bg-gray-100 rounded-full p-1" />
                                    </Link>
                                </td>
                                <td class="" v-if="faculty.employee">
                                    <Link class="px-4 pt-3 pb-1 flex items-center focus:text-indigo-500" 
                                            :href="route('employee.show', faculty.employee.id)">
                                        {{ faculty.employee.first_name_english }}
                                        {{ faculty.employee.last_name_english }}
                                    </Link>
                                </td>
                                <td class="" v-if="faculty.employee">
                                    <Link class="px-4 pt-3 pb-1 flex items-center focus:text-indigo-500" 
                                            :href="route('employee.show', faculty.employee.id)">
                                        {{ faculty.name }}
                                    </Link>
                                </td>
                                <td class="" v-if="faculty.employee">
                                    <div v-if=" faculty.employee.addresses[0]">
                                        <Link class="px-4 pt-3 pb-1 focus:text-indigo-500" :href="route('employee.show', faculty.employee.id)">
                                            {{ faculty.employee.addresses[0].contact_no }}
                                        </Link>
                                    </div>
                                    <div class="text-gray-400 px-4 pt-3 pb-1" v-else>
                                       No mobile No.
                                    </div>
                                </td>
                               
                                <td class="rounded-r-md" v-if="faculty.employee" >
                                    <div  v-if="faculty.employee.addresses[0]">
                                        <Link class="px-4 pt-3 pb-1 flex items-center focus:text-indigo-500" :href="route('employee.show', faculty.employee.id)">
                                            {{ faculty.employee.addresses[0].email }}
                                        </Link>
                                    </div>
                                    <div class="text-gray-400 px-4 pt-3 pb-1" v-else>
                                        No email
                                    </div>
                                </td>
                               
                            </tr> 
                            </table>
                        </div>
                    </div>
                     <div class="w-1/3 p-10 pt-0 bg-white rounded-md shadow-sm" v-if="rankDueCount > 0">
                        <div class=" py-10 border-b border-gray-200 text-gray-500 text-sm pb-2 mb-4 flex justify-between">
                            <div>Rank Due Employees</div>
                            <div class="underline font-medium text-sky-500">
                                <Link href="http://127.0.0.1:8000/report?is_due=true" class="w-full hover:shadow-md transition-shadow">
                                    See all
                                </Link>
                            </div>
                        </div>
                        <div>
                            <table class="w-full">
                                <tr v-for="(employee, index) in limited_rank_due_employees" class="hover:bg-sky-100 focus-within:bg-sky-100 text-sm" :class="{'bg-gray-50': index%2 === 0}">
                                    <td class="rounded-l-md  py-3 px-4 mt-3 ">
                                        <Link class="flex items-center focus:text-indigo-500" 
                                                :href="route('employee.show', employee.id)">
                                                <img v-if="employee.profile_photo_url" :src="employee.profile_photo_url" 
                                                        class="h-7 w-7 rounded-full object-cover">
                                                <icon v-if="!employee.profile_photo_url" 
                                                    name="person" 
                                                    class="w-7 h-7 stroke-current text-gray-400 bg-gray-100 rounded-full p-1" />
                                        </Link>
                                    </td>
                                    <td class="rounded-r-md  py-3 px-2 mt-3 text-left">
                                        <Link class="flex items-center focus:text-indigo-500" 
                                                :href="route('employee.show', employee.id)">
                                                {{employee.first_name}} {{employee.last_name}}
                                        </Link>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import Icon from '@/Components/Icon.vue';
import EmployeeList from '@/Components/EmployeeList.vue';

export default {
    components: {
        Head,
        Link,
        Icon,
        EmployeeList,
    },
    props: {
        is_working_outside: Object,
        is_studying: Object,
        available_employees: Object,
        ranks:Object,
        total_employees: Object,
        total_departments: Object,
        total_faculties: Object,
        academic_ranks: Object,
        total_seats: Object,
        employees: Object,
        faculties: Object,
        employee_rank_due: Object,
    },
    data() {
        return {
            ranks_data: [], 
            available_employees_count: [],
            faculty_series: [],
            limited_rank_due_employees: [],
        }
    },
    created() {
        this.academicRanksChart;
        this.availableEmployees;
        this.facultiesWithEmployees;
        this.rankDueCount;
        this.limitedRankDueEmployees;
    },
    computed: {
        emptySeats() {
            return this.total_seats.seats - this.total_employees ;
        },
        limitedRankDueEmployees() {
            let count = 0; 
            return this.employee_rank_due.forEach(element => {
                count++;
                if (count <= 12) {
                    this.limited_rank_due_employees.unshift(element);
                }
            });
        },
        rankDueCount() {
            return this.employee_rank_due.length;
        },
        availableEmployees() {
            return this.available_employees_count.unshift(
                ['available', this.available_employees],
                ['studying', this.is_studying],
                ['working', this.is_working_outside],
            );
        },
        facultiesWithEmployees() {
            return this.faculties.forEach(element => {
                this.faculty_series.unshift([element.name, element.employees_count])
            });
        },
        academicRanksChart() {
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
        }
    },
}
</script>
