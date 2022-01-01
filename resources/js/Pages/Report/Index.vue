<template>
 <div class="max-w-7xl mx-auto px-6 sm:px-12 py-8">
        <div class="mb-4">
             <h1 class="text-base font-medium text-gray-500">
                <Link
                :href="route('dashboard')"
                class="text-sky-500 hover:underline"
                >
                Dashboard
                </Link>
                / Reports
            </h1>
        </div>
     <div class="w-full flex-shrink rounded-lg p-10 bg-white">
        <div class="flex items-center justify-between border-b pb-2 mb-4">
            <div class=" flex" >
                <icon name="filter" class=" mr-1 text-gray-500" /> 
                <span>Apply Filters</span> 
            </div>
            <div class="flex items-end space-x-6 ">
                 <div  v-if="employees" class="text-gray-400 text-sm">
                    Total <span class="font-bold text-lg text-red-400 ">{{employees_count}}</span> employees found  
                </div>
                <div>
                    <button class="text-sky-500 underline text-sm mx-4" @click="reset"> 
                    Reset
                    </button>
                </div>
            </div>
        </div>
        <!-- filter body -->
            <div class=" " >
                <div class="flex justify-between mb-6" >
                     <!-- academic ranks -->
                    <div class="flex flex-col w-44">
                        <div class="mb-2 pb-1 text-sm font-bold">
                            Academic Ranks
                            <div class="w-24 border-b"></div>
                        </div>
                        <div class="text-xs flex flex-col mt-1">
                            <label for="professor" class=" cursor-pointer mb-2 "> 
                                <input value="7" v-model="params.academic_rank" type="checkbox" name="professor" id="professor"
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold  peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span>Professor</span>
                                   <span v-if="this.params.academic_rank.includes('7')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>  
                            </label>
                            <label for="senoir_asso_prof" class=" cursor-pointer my-2">
                                <input value="6" v-model="params.academic_rank" type="checkbox" name="senoir_asso_prof" id="senoir_asso_prof" 
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Sen. Assoc. Prof.</span>
                                   <span v-if="this.params.academic_rank.includes('6')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>  
                            </label>
                            <label for="assoc_prof" class=" cursor-pointer my-2">
                                <input value="5" v-model="params.academic_rank" type="checkbox" name="assoc_prof" id="assoc_prof" 
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Associate Prof.</span>
                                   <span v-if="this.params.academic_rank.includes('5')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>   
                            </label>
                            <label for="sen_assist_prof" class=" cursor-pointer my-2">
                                <input value="4" v-model="params.academic_rank" type="checkbox" name="sen_assist_prof" id="sen_assist_prof" 
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Senior Assist. Prof</span>
                                   <span v-if="this.params.academic_rank.includes('4')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>  
                            </label>
                            <label for="assist_prof" class=" cursor-pointer my-2">
                                <input value="3" v-model="params.academic_rank" type="checkbox" name="assist_prof" id="assist_prof" 
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Assistant Prof. </span>
                                   <span v-if="this.params.academic_rank.includes('3')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span> 
                            </label>
                            <label for="senior_teaching_assist" class=" cursor-pointer my-2">
                                <input value="2" v-model="params.academic_rank" type="checkbox" name="senior_teaching_assist" id="senior_teaching_assist" 
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Senior Teaching Assis. </span>
                                   <span v-if="this.params.academic_rank.includes('2')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>
                            </label>
                            <label for="teaching_asist" class=" cursor-pointer my-2">
                                <input value="1" v-model="params.academic_rank" type="checkbox" name="teaching_asist" id="teaching_asist" 
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Teaching Assistant </span>
                                   <span v-if="this.params.academic_rank.includes('1')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <!-- faculty filter -->
                    <div class="flex flex-col w-48">
                        <div class=" mb-2 pb-1 text-sm font-bold">
                            Faculties
                            <div class=" w-24 border-b"></div>
                        </div>
                        <div class="text-xs max-h-80 overflow-auto scrollbar scrollbar-thumb-gray-400 scrollbar-track-gray-200 scrollbar-w-1">
                            <div v-for="faculty in faculties" class="my-3 mt-1 mx-1">
                                <label :for="faculty.name" class="cursor-pointer">
                                    <input type="checkbox" 
                                            :value="faculty.id" :name="faculty.name"
                                            :id="faculty.name"  
                                            v-model="params.faculty"
                                            class="hidden peer" >
                                    <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                    <span>{{faculty.name}}</span>
                                    <span v-if="this.params.faculty.includes(faculty.id)"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- department filter -->
                    <div class="flex flex-col ml-2 w-48">
                        <div class=" mb-2 pb-1 text-sm font-bold">
                            Departments
                            <div class=" w-24 border-b"></div>
                        </div>
                        <div class="text-xs max-h-80 maxh overflow-auto scrollbar scrollbar-thumb-gray-400 scrollbar-track-gray-200 scrollbar-w-1" v-if="departments">
                            <transition-group name="list" tag="p">
                                <div v-for="(department, index) in departments" :key="index" class="my-3 mt-1 mx-1">
                                    <label :for="department.name" class="cursor-pointer">
                                        <input type="checkbox" :value="department.id" 
                                                :name="department.name"  
                                                :id="department.name"
                                                v-model="params.department"
                                                 class="hidden peer" >
                                        <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                        <span>{{department.name}}</span>
                                        <span v-if="this.params.department.includes(department.id)"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                        </span>
                                    </label>
                                </div>
                            </transition-group>
                        </div>
                        <div v-else class="text-xs text-gray-400"> Select a faculty first </div>
                    </div>
                    <!-- other and education -->
                    <div class="flex flex-col">
                        <div class=" mb-2 pb-1 text-sm font-bold">
                            Education
                            <div class=" w-24 border-b"></div>
                        </div>
                        <div class="text-xs flex flex-col mt-1">
                            <label for="bachelor" class="cursor-pointer" >
                                <input type="checkbox" value="1" 
                                        name="bachelor" id="bachelor"  
                                        v-model="params.degree_name"
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Bachelor </span>
                                   <span v-if="this.params.degree_name.includes('1')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>
                            </label>
                            <label for="masters" class="my-3 cursor-pointer">
                                <input value="2" type="checkbox" name="masters" id="masters" 
                                        v-model="params.degree_name"
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Masters </span>
                                   <span v-if="this.params.degree_name.includes('2')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>
                            </label>
                            <label for="phd" class="cursor-pointer">
                                <input value="3" type="checkbox" name="phd" id="phd" 
                                        v-model="params.degree_name"
                                        class="hidden peer ">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> PhD </span>
                                   <span v-if="this.params.degree_name.includes('3')"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>
                            </label>
                        </div>
                        <div class=" mt-6 mb-2 pb-1 text-sm font-bold ">
                            Others
                            <div class="w-20 border-b"></div>
                        </div>
                        <div class="text-xs flex flex-col w-36">
                            <label for="is_due" class="cursor-pointer" >
                                <input type="checkbox" 
                                        name="is_due" id="is_due"  
                                        v-model="params.is_due"
                                        class="hidden peer">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Academic Rank Due </span>
                                   <span v-if="params.is_due"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>
                            </label>
                            <label for="is_studying" class="cursor-pointer  my-3" >
                                <input type="checkbox" 
                                        name="is_studying" id="is_studying"  
                                        v-model="params.is_studying"
                                        class="hidden peer">
                                <span class=" select-none text-gray-600 font-semibold peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Studying </span>
                                   <span v-if="params.is_studying"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>
                            </label>
                            <label for="is_working_outside" class="cursor-pointer">
                                <input  type="checkbox" name="is_working_outside" id="is_working_outside" 
                                        v-model="params.is_working_outside"
                                        class=" hidden peer">
                                <span class=" select-none text-gray-600 font-semibold  peer-checked:text-gray-700 peer-checked:font-bold flex justify-start items-center">
                                   <span> Working Outside </span>
                                   <span v-if="params.is_working_outside"><icon name="x" class="h-4 w-4 mx-1" /></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <!-- age  -->
                    <div class="flex flex-col mr-8">
                        <div class=" mb-4 pb-1 text-sm font-bold ">
                            Age Range
                            <div class=" w-20 border-b"></div>
                        </div>
                        <label for="end" class="text-xs mb-1 flex justify-between">
                            <span>from</span>
                            <span class="text-gray-500  text-sky text-xs rounded-md" v-if="params.age.start">{{params.age.start}}</span>
                        </label>
                        <input 
                            v-model="params.age.start"
                            class="h-1 mb-4 rounded-lg cursor-pointer bg-sky-500" 
                            type="range" name="age" id="start"
                            min="20" max="90">
                        <label for="end" class="text-xs mb-1 flex justify-between">
                            <span>to</span>
                            <span class="text-gray-500  text-sky text-xs rounded-md" v-if="params.age.end">{{params.age.end}}</span>
                        </label>
                        <input 
                            v-model="params.age.end"
                            class=" h-1 rounded-lg cursor-pointer" 
                            type="range" name="age" id="end"
                            min="20" max="90">
                    </div>
                    <!-- Hiring Date  -->
                    <div class="flex flex-col">
                        <div class=" pb-1 text-sm mb-4 font-bold">
                            Hiring Date
                            <div class=" w-20 border-b"></div>
                        </div>
                        <label for="start" class="text-xs mb-1" :class="{'font-bold ': params.employment_date.start}">Between</label>
                        <input 
                            v-model="params.employment_date.start"
                            class="mb-3 text-xs h-6 rounded-md w-36 border-gray-200 ring-sky-200 focus:ring-sky-200  " 
                            type="date" name="employment_date" id="start">
                        <label for="end" class="text-xs mb-1" :class="{'font-bold ': params.employment_date.end}">and</label>
                        <input 
                            v-model="params.employment_date.end"
                            class="text-xs  h-6 rounded-md w-36 border-gray-200 ring-sky-200 focus:ring-sky-200 " 
                            type="date" name="employment_date" id="end">
                    </div>
                </div>
                <!-- total employees and export section -->
                <div class="flex justify-between items-center border-t pt-6 mt-12">
                    <div  v-if="employees" class="text-gray-500 divide-x-2 ">
                       <span class="text-gray-700 font-bold px-1"> Employees List </span>
                        <span class="px-1">click the export button, to export the list to excel </span>
                    </div>
                    <div>
                         <a :href="route('report.export', this.params)" 
                            method="get"
                            target="__blank" class="float-right px-3 py-1 bg-sky-500 text-white shadow-md rounded mx-2" 
                            @click="print">export to excel</a>
                    </div>
                </div>
            </div>
        <!-- Employees List  -->
        <div class="w-full">
            <employee-list :employees="this.employees" />
        </div>
     </div>
 </div>
</template>
<script>
import Icon from '@/Components/Icon.vue';
import { Link } from '@inertiajs/inertia-vue3';
import EmployeeList from '@/Components/EmployeeList.vue'
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
export default {
  components: {
       Icon,
       Link,
       EmployeeList
        },
  props: {
      employees:Object,
      faculties: Object, 
      departments: Object,
      employees_count: Number,
  },
    data() {
        return {
            params: {
                degree_name:[],
                age:{
                    start: null,
                    end: null,
                },
                employment_date: {
                    start:null,
                    end:null
                },
                academic_rank:[],
                faculty: [],
                department: [],
                is_due: false,
                is_studying: false,
                is_working_outside: false,
            },
        }
    },
    watch: {
         params: {
             handler: throttle(function() {
                this.$inertia.get(route('report.index'),pickBy(this.params), { 
                    preserveState: true,
                    preserveScroll: true,
                });
            }, ),
         deep: true,
         }, 
     },

    methods: {
        reset() {
            this.params.degree_name = [];
            this.params.age.start = null;
            this.params.age.end = null;
            this.params.employment_date.start = null;
            this.params.employment_date.end = null;
            this.params.academic_rank = [];
            this.params.department = [];
            this.params.faculty = [];
            this.params.is_due = false;
            this.params.is_studying = false;
            this.params.is_working_outside = false;
        },
    },
}
</script>
<style scoped>
    .list-item {
  display: inline-block;
  margin-right: 10px;
}
.list-enter-active,
.list-leave-active {
  transition: all 1s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>