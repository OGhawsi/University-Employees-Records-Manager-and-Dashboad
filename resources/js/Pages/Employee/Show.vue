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
                 /
                <Link
                :href="route('employee.index')"
                class="text-sky-500 hover:underline"
                >
                  Employees 
                </Link>
                 / {{employee.first_name_english}} {{employee.last_name_english}}
            </h1>
        </div>
       <div class="bg-white px-12 py-10 rounded-lg flex flex-col"> 
           <div class="flex justify-between items-start">
                <!-- left section  -->
                <div class="w-72 flex-shrink-0 flex flex-col items-start min-h-screen mx-2">
                    <!-- top section -->
                    <div class="space-y-2 flex flex-col items-center">
                        <!-- photo  -->
                        <div class="">
                            <avatar :employee="this.employee"></avatar>
                        </div>
                        <!-- basic info  -->
                        <div>
                            <!-- <div class="text-sm text-gray-500  font-semibold" v-if="rank_name[0]">{{rank_name[0].name_english}}</div> -->
                            <div class="text-2xl text-gray-700 font-bold group">
                                <Link :href="route('employee.edit', employee.id)" class="flex space-x-2 hover:underline hover:text-sky-500 transition-colors">
                                    <span>{{employee.first_name_english}} {{employee.last_name_english}}</span>
                                    <icon name="pencil" class=" group-hover:text-sky-500 transition-colors" />
                                </Link>
                            </div>
                           <div class="text-base text-gray-500 text-center mt-2 font-extralight leading-7 tracking-wider space-y-1">
                                <div class="" v-if="employee.working_department">{{employee.working_department.faculty.name}}</div>
                                <div class="" v-if="employee.working_department">{{employee.working_department.name}}</div>
                                <div class="bg-sky-100 mx-10 font-medium text-sky-600 px-1 py-1 rounded-md">{{organizational_post}}</div>
                           </div>
                        </div>
                    </div>
  
                    <!-- bottom section -->
                    <div class="flex tracking-wider items-start pr-8 leading-7 flex-col sm:mt-24 text-left font-extralight text-gray-600 space-y-4" v-if="addresses[0]">
                        <div class="flex space-x-4 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span> {{addresses[0].email}}</span>
                        </div>
                        <div class="flex space-x-4 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>{{addresses[0].contact_no}}</span>
                        </div>
                        <div class="flex space-x-4 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{addresses[0].street_address_english}}</span>
                        </div>
                    </div>
                </div>
        
                <!-- right scrollable section  -->
                <div class="w-full flex-shrink min-h-screen">
                   <rank :employee="this.employee" class="mb-12" />
                   <degree :employee="this.employee" :degrees="this.degrees" class="mb-12" />
                   <employment :employee="this.employee" :employments="this.employments" class="mb-12" />
                   <contact :employee="this.employee" :addresses="this.addresses" class="mb-12" />
                   <attachment :employee="this.employee" :attachments="this.attachments" class="mb-12" />
                </div>
           </div>
            <!-- <attachment :employee="this.employee" :attachments="this.attachments" class="mb-12" /> -->
       </div>

        
    </div>
</template>
<script>
import {Link} from '@inertiajs/inertia-vue3';
import AddNewButton from '@/Components/AddNewButton.vue'
import Degree from '@/Components/Show/Degree.vue'
import Employment from '@/Components/Show/Employment.vue'
import Contact from '@/Components/Show/Contact.vue'
import Rank from '@/Components/Show/Rank.vue'
import Attachment from '@/Components/Show/Attachment.vue'
import Avatar from '@/Components/Show/Avatar.vue'
import throttle from 'lodash/throttle';
import Icon from '@/Components/Icon.vue';
export default {
    components: {
        Link,
        AddNewButton,
        Degree,
        Rank,
        Employment,
        Contact,
        Attachment,
        Avatar,
        Icon,
    },
    props: {
        employee: Object,
        deanOfFaculty: Object,
        workingDepartment: Object,
        headOfDepartment: Object,
        degrees:Object,
        addresses: Object,
        attachments: Object,
        employments: Object,
        ranks: Object,
    },
    created() {
        this.rank_name;
        this.organizational_post;
    },
    computed: {
        rank_name() {
            return this.ranks.filter( function(emp) {
                return emp.pivot.current === 1;
            })
        },
        organizational_post() {
            if (this.headOfDepartment) {
                return "Head of Dept"
            }
            else if(this.deanOfFaculty) {
                return "Dean"
            }
            else 
                return "Lecturer"
        }
    },
   
}
</script>