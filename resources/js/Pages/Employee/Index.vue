<template>
    <div class="max-w-7xl mx-auto px-6 sm:px-12">
      <div class="flex justify-between mt-12 mb-4">
          <h1 class="text-2xl font-bold  text-gray-500">Employees</h1>
          <Link :href="route('employee.create')" class="bg-indigo-500 hover:bg-yellow-600 text-white text-sm py-3 px-6 rounded shadow">Add Employee</Link>
      </div>
      <hr class="mb-12">

        <div class="flex">
    
            <!-- local sidebar with filters -->
            <div class=" flex justify-between  w-72  flex-shrink-0">
               <div class="flex flex-col mx-4 my-10 space-y-4">
                <!-- search box with filter  -->
                    <div>
                        <input type="search" name="search" id="search" placeholder="search here..." class="w-60">
                    </div>
                    <div class="flex">
                        <select name="filter" id="filter" v-model="query.faculty">
                            <option disabled>Filter by</option>
                            <option value="">All Employees</option>
                            <option value="edu">Educatoin Facluty</option>
                            <option value="eng">Engineering Facluty</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox"  name="professor" id="professor" value="professor" v-model="query.rank">
                        <label for="professor">professor</label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox"  name="assistant_professor" id="assistant_professor" value="assitant_professor" v-model="query.rank">
                        <label for="assistant_professor">assitant professor</label>
                    </div>
                    
                    
               </div>
    
            </div>
    
            <!-- main table display  -->
            <div class=" bg-white w-full flex-shrink-1 rounded-lg p-10 shadow-md">
                <!-- <span v-if="employees.length"> total employees: {{ employees.length }}</span> -->

                <table class="w-full whitespace-nowrap">
                    <tr class="text-left font-bold ">
                        <th class="px-6 pt-6 pb-4">Name</th>
                        <th class="px-6 pt-6 pb-4"> Rank</th>
                        <th class="px-6 pt-6 pb-4"> City</th>
                        <th class="px-6 pt-6 pb-4"> Faculty</th>
                    </tr>
                    <tr v-for="employee in employees" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <Link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('employee.edit', employee.id)">
                                {{ employee.name }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('employee.edit', employee.id)">
                                {{ employee.rank }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('employee.edit', employee.id)">
                                {{ employee.city }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link class="px-6 py-4 flex items-center focus:text-indigo-500" :href="route('employee.edit', employee.id)">
                                {{ employee.faculty }}
                            </Link>
                        </td>
                    </tr>
                </table>
                
            <!-- pagination links  -->
            </div>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import pickBy from 'lodash/pickBy';
    import throttle from 'lodash/throttle';
export default {
    components : {
        Link,
    },
    props: {
        employees: Object,
        // filters: Object,
    }, 
    data() {
        return {
            query: {
                rank:[],
                'faculty': null,
            }
        }
    },
    watch: {
        query: {
            handler: throttle(function() {
                let que = pickBy(this.query)
                this.$inertia.get(route('employee.index'), que , { preserveState: true });
            }, 2000),
            deep: true,
        }
    },
    computed: {
        
    },
    methods: {
        filter() {
            // let que = pickBy(this.query)
            // this.$inertia.get(route('crud'), que );
        }
    },


}
</script>