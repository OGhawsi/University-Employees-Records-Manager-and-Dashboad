<template>
  <div class="max-w-7xl mx-auto px-6 sm:px-12 py-10">
  <div class="flex justify-between mb-4">
		<h1 class="text-base font-medium text-gray-500">
			<Link
          :href="route('faculty.index', faculty.id)"
          class="text-sky-500 hover:underline"
        >
          {{faculty.name}}
        </Link>
        / Create New Department
		</h1>
	</div>
    <div class="mb-6 border-b border-gray-300"></div>
 
    <div class="flex">
      <!-- side bar -->
      	<div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Department Details</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Enter Department name, email, and select dean for the faculty
            by searching employee name from the list, and then enter the
            established date for the faculty as well. 
          </p>
        </div>
      <!-- main create form   -->
      <div class="flex flex-col w-full flex-shrink mx-auto rounded-lg shadow-md mb-12">
        <form @submit.prevent="submit">
            <div
                class="px-16 bg-white rounded-t-lg p-10"
              >
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
                  <label for="dean">Department Head</label>
                  <searchable-dropdown
                    :employees="employees"
                    :fetchingRoute ="route('department.create', faculty.id)"
                    @selectId="selectEmployee">
                  </searchable-dropdown>
				  <div v-if="errors.employee_id" class="form-error">This employee is already a HOD in other department</div>
			</div>
              <div class="flex flex-col mb-6 space-y-1">
                  <label for="established">ٍEstablished Date</label>
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
				<Link
					class=" float-right px-4 py-2 border border-gray-300 shadow-sm mx-4 my-2  text-gray-700  rounded-md "
					:href="route('faculty.index',1)"
					>cancel</Link>
				<button
				@click="submit"
				class=" bg-sky-500 text-white px-6 py-2 rounded-md text-sm float-right mx-4 my-2 flex">
					<icon v-if="sending" name="spining-circle" class="text-white h-5 w-5 " />
					Save
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
import SearchableDropdown from '@/Components/EmployeeSearchableDropdown.vue';

export default {
  components: {
    Link,
	Icon,
	SearchableDropdown,
  },
  props: {
    employees: Object,
    faculty: Object,
    errors: Object
  },
  data() {
      return {
          sending: false,
          form: this.$inertia.form({
            name : null,
            email : null,
            established : null,
            employee_id : null,
            faculty_id : this.faculty.id,
            university_id : 1,
          })
      }
  },

  methods: {
	  selectEmployee(value) {
		  this.form.employee_id = value
	  },

    submit() {
      this.form.post(this.route('department.store'), this.form, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })

    }
},
}
</script>