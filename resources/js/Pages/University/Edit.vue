<template>
  <div class="max-w-7xl mx-auto px-6 sm:px-12 py-8">
    <div class=" mb-4">
            <h1 class="text-base font-medium text-gray-500">
                <Link :href="route('dashboard')" class="text-sky-500 hover:underline"  >
                Dashboard 
                </Link>
                 / Settings
            </h1>
        </div>
     <div class="mb-6 border-b border-gray-300"></div>

    <div class="flex">
      <!-- side bar -->
      <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Application Details</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Enter the details about the university and the name of this application.s
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
							type="text"
							name="email"
							v-model="form.email"
							class="w-80 rounded"
						/>
						<div v-if="errors.email" class="form-error">{{ errors.email }}</div>
					</div>
					<div class="flex flex-col mb-6 space-y-1">
						<label for="seats">seats</label>
						<input
							type="number"
							name="seats"
							v-model="form.seats"
							class="w-80 rounded"
						/>
						<div v-if="errors.seats" class="form-error">{{ errors.seats }}</div>
					</div>
					<div class="flex flex-col mb-6 space-y-1">
						<label for="established">established</label>
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
                :href="route('dashboard')"
                >cancel</Link>
                <button
                  @click.prevent="submit"
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
export default {
  components: {
    Link,
	Icon,
  },
  props: {
	  university: Object,
	  errors: Object
  },
  data() {
		return {
			sending: false, 
			form: this.$inertia.form({
				name: this.university.name,
				email: this.university.email,
				seats: this.university.seats,
				established: this.university.established,
			}),
		}
  },
  methods: {
	  submit() {
			this.form.put(route('setting.update', this.university.id), {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
		},
  },

	  
}
</script>