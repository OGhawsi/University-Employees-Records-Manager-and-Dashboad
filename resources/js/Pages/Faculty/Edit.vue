<template>
  <div class="max-w-7xl mx-auto px-6 sm:px-12 py-8">
	<div class="flex justify-between mb-4">
		<h1 class="text-base font-medium text-gray-500">
			<Link
			:href="route('dashboard')"
			class="text-sky-500 hover:underline"
			>
			Dashboard
			</Link> / 
			<Link
			:href="route('faculty.index', faculty.id)"
			class="text-sky-500 hover:underline"
			>
			All Faculties
			</Link>
			/ {{faculty.name}}
		</h1>
	</div>
    <div class="mb-6 border-b border-gray-300"></div>

    <div class="flex">
      <!-- side bar -->
	<div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
		<span class=" font-medium">Faculty Detailes</span>
		<p class="leading-relaxed tracking-wide font-normal pt-2">
			Enter Faculty name, email, and select dean for the faculty
			by searching employee name from the list, and then enter the
			established date for the faculty as well. 
		</p>
	</div>

      <!-- main create form   -->
      <div class="flex flex-col w-full flex-shrink mx-auto rounded-lg shadow-md">
        <form @submit.prevent="submit">
            <div class="px-16 bg-white rounded-t-lg p-10">
              <div class="flex flex-col mb-6 space-y-1">
                  <label for="name">Name</label>
                  <input
                    type="text"
                    name="name"
                    v-model="form.name"
                    class="w-80 rounded"
                  />
                  <div v-if="errors.name" class="form-error">{{ errors.name }}</div>
                </div>
              <div class="flex flex-col mb-6 space-y-1">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    name="email"
                    v-model="form.email"
                    class="w-80 rounded"
                  />
                  <div v-if="errors.email" class="form-error">{{ errors.email }}</div>
                </div>
              <div class="flex flex-col mb-6 space-y-1">
                  <label for="dean">Dean</label>
                  <searchable-dropdown
                    :employees="employees"
                    :currentDean = "faculty.employee"
                    :fetchingRoute="route('faculty.edit', this.faculty.id)"
                    @selectId="selectEmployee">
                  </searchable-dropdown>
                 <div v-if="errors.employee_id" class="form-error">This employee is already a dean in other faculty</div>
                  
                </div>
              <div class="flex flex-col mb-6 space-y-1">
                  <label for="established">Established Date</label>
                  <input
                    type="date"
                    name="established"
                    v-model="form.established"
                    class="w-80 rounded"
                  />
                   <div v-if="errors.established" class="form-error">{{ errors.established }}</div>
                </div>
            </div>
            <div class="bg-gray-200 rounded-b-lg flex justify-end">
                <button
                  @click.prevent="remove"
                  class=" text-red-500 px-4 py-2 rounded text-sm float-right mx-4 my-2 flex items-center"
                >
                    <icon v-if="deleting" name="spining-circle" class="text-red-500 h-5 w-5 "/>
                   <icon name="trash" class="h-4 w-4 text-red-500 mx-1" />
                  Delete 
                </button>
				<Link
				class=" float-right px-4 py-2 border border-gray-300 shadow-sm mx-4 my-2  text-gray-700  rounded-md "
				:href="route('faculty.index',faculty.id)"
				>cancel</Link>
              <button
                @click.prevent="update"
                class=" bg-sky-500 text-white px-6 py-2 rounded-md text-sm float-right mx-4 my-2 flex">
                    <icon v-if="sending" name="spining-circle" class="text-white h-5 w-5 " />
                Update
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Icon from '@/Components/Icon.vue';
import SearchableDropdown from '@/Components/EmployeeSearchableDropdown.vue'

export default {
  components: {
    Link,
    Icon,
    SearchableDropdown,
  },
  props: {
    faculty: Object,
    employees: Object,
    universities: Object,
    errors: Object,
  },
  data() {
      return {
          sending: false,
          deleting: false,
          form: {
            name : this.faculty.name,
            email : this.faculty.email,
            employee_id : this.faculty.employee_id,
            established : this.faculty.established,
            university_id : 1,

          }
      }
  },

  methods: {
	  selectEmployee(value) {
		  this.form.employee_id = value
	  },
    remove(){
        if (confirm("are you sure ? ")) {
            this.$inertia.delete(this.route('faculty.delete', this.faculty.id) , {
              onStart: () => this.deleting = true,
              onFinish: () => this.deleting = false,
            })
        }
    },
    update() {
      this.$inertia.put(this.route('faculty.update', this.faculty.id), this.form, {
        replace : true,
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })
    }
},
}
</script>