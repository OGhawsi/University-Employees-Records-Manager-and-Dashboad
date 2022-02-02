<template>
  <div class="max-w-7xl mx-auto px-6 sm:px-12 py-8">
    <div class="flex justify-between mb-4">
      <h1 class="text-base font-medium text-gray-500">
        <Link
          :href="route('employee.show', employee.id)"
          class="text-sky-500 hover:underline"
        >
          {{ employee.first_name_english }}'s profile
        </Link>
        / Add Rank
      </h1>
    </div>
    <div class="flex flex-col rounded-lg bg-white px-12">
      <div class="flex justify-between my-10">
        <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Choose Academic Rank</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Choose the academic rank, which the employee is going to achieve in
			the next 3 years. 
          </p>
        </div>
        <div class="w-full flex-shrink px-8 items-center">
          <div class="flex-none font-medium text-sm my-6">Academic Rank / علمي رتبه</div>
      
            <div class="my-2" v-for="rank in ranks">
				<input
					class="h-5 w-5 text-sky-500 focus-within:ring-sky-500"
					v-model="form.rank_id"
					:value="rank.id"
					type="radio"
					:name="rank.name_english"
					:id="rank.name_english"
				/>
				<label :for="rank.name_english" class="mx-3 cursor-pointer"
					>{{ rank.name_english }} / {{ rank.name }}</label
				>
				</div>
				<div v-if="errors.rank_id" class="form-error">
				{{ errors.rank_id }}
				</div>
			</div>
      </div>
      <div class="w-full border-b-2 rounded-md border-sky-400"></div>

      <!-- second section -->
      <div class="flex justify-between py-8">
        <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Research Topic and Date</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Write the research topic of the employee for the
			academic rank that the employee is going to achieve.
          </p>
        </div>
        <div class="flex flex-col w-full flex-grow px-8">
        	<div class="space-y-2 mb-6">
	          <label for="subject_of_academic_research"
	            >Researc Topic / علمي موضوِع</label
	          >
	          <div class="bg-gray-100 rounded-md flex justify-between items-center">
	            <input
	              type="text"
	              name="subject_of_academic_research"
	              v-model="form.subject_of_academic_research"
	              placeholder="Research Topic / علمي موضوِع"
	              class="  w-full border-0 placeholder-gray-400  bg-gray-100   rounded-md  "
	            />
	          </div>
	          <div v-if="errors.subject_of_academic_research" class="form-error">
	            {{ errors.subject_of_academic_research }}
	          </div>
	        </div>
	        <div class="space-y-2 mb-6">
	          <label for="registration_of_academic_research"
	            >Registration of Research TOpic / د علمي موضوِع د ثبتولو نیټه</label
	          >
	          <div class="bg-gray-100 rounded-md flex justify-between items-center">
	            <input
	              type="date"
	              name="registration_of_academic_research"
	              v-model="form.registration_of_academic_research"
	              class="
	                w-full
	                border-0
	                placeholder-gray-400
	                bg-gray-100
	                rounded-md
	              "
	            />
	          </div>
	          <div
	            v-if="errors.registration_of_academic_research"
	            class="form-error"
	          >
	            {{ errors.registration_of_academic_research }}
	          </div>
	        </div>
	        <div class="space-y-2 mb-6">
	          <label for="completion_of_academic_research"
	            >Completeion Date of Research / د علمي موضوِع د پوره کولو
	            نیټه</label
	          >
	          <div class="bg-gray-100 rounded-md flex justify-between items-center">
	            <input
	              type="date"
	              name="completion_of_academic_research"
	              v-model="form.completion_of_academic_research"
	              class="
	                w-full
	                border-0
	                placeholder-gray-400
	                bg-gray-100
	                rounded-md
	              "
	            />
	          </div>
	          <div v-if="errors.completion_of_academic_research" class="form-error">
	            {{ errors.completion_of_academic_research }}
	          </div>
	        </div>
	        <div class="flex items-center flex-row-reverse">
	          <button
	            @click.prevent="submit"
	            class=" bg-sky-500 text-white px-6  py-2 rounded-md  text-sm  float-right  mx-4  my-2 flex"
	          >
	            <icon v-if="sending" name="spining-circle" class="text-white h-5 w-5" />
	            Save
	          </button>
	          <Link
	            class=" float-right px-4 py-2 border mx-4 my-2  shadow-sm text-gray-700  rounded-m "
	            :href="route('employee.show', employee.id)"
	            >cancel</Link
	          >
	        </div>
        </div>
		
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Icon from '@/Components/Icon.vue'
export default {
  props: {
    errors: Object,
    employee: Object,
    ranks: Object,
  },
  components: {
    Link,
	Icon,
  },
  data() {
    return {
      sending: false,
      form: this.$inertia.form({
        employee_id: this.employee.id,
        rank_id: 1,
        subject_of_academic_research: null,
        registration_of_academic_research: null,
        completion_of_academic_research: null,
        current: true,
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(route("rank.store", this.employee.id), {
        preserverState: true,
        preserveScroll: true,
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },

  },
};
</script>