<template>
  
    <div class="max-w-7xl mx-auto px-6 sm:px-12">
      <div class="flex justify-between mt-12 mb-4">
          <h1 class="text-2xl font-bold  text-gray-500">
              <Link :href="route('employee.index')" class="text-indigo-500 hover:underline"> Employees </Link> / Create 
            </h1>
      </div>
      <hr class="mb-12">

       <div class="flex">
    
            <!-- local sidebar   -->
            <div class=" flex flex-col space-y-4  w-60  flex-shrink-0">
               <Link :href="route('employee.create')" class="text-gray-500 px-4"  :class="{'text-gray-800 border-l-2 border-indigo-500 ': $page.component === 'Employee/Create/Index' }" preserve-state>
                    Personal Information
                </Link>
               <Link :href="route('employee.create.personal')" class="text-gray-500 px-4"  :class="{'text-gray-800 border-l-2 border-indigo-500 ': $page.component === 'Employee/Create/Personal' }" preserve-state>
                    Education Information
                </Link>
                <Link :href="route('employee.create.academic')" class="text-gray-500 px-4" :class="{'text-gray-800 border-l-2 border-indigo-500 ': $page.component === 'Employee/Create/Academic' }" preserve-state>
                    Academic Information
                </Link>
            </div>
    
            <!-- main table display  -->
           <div class="flex flex-col w-full mx-auto rounded-lg shadow-md">
             
             <slot></slot>
           
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
    }
}
</script>