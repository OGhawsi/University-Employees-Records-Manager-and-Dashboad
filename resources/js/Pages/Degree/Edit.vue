<template>
  <div class="max-w-7xl mx-auto px-6 sm:px-12 py-8">
		<div class="flex justify-between mb-4">
			<h1 class="text-base font-medium text-gray-500">
				<Link
				:href="route('employee.show', degree.employee.id)"
				class="text-sky-500 hover:underline"
				>
				{{ degree.employee.first_name_english }}'s profile
				</Link>
				/ Add Education
			</h1>
		</div>
    <div class="bg-white rounded-lg p-10">

    <div class="flex justify-between mb-10">
      <!-- info section of the form -->
     <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Education Level</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Choose the appropriate education level that the employee has. 
          </p>
        </div>
      <!-- content section of the form  -->
      <div class="w-full flex-shrink px-8 items-center">
        <div class="flex-none text-sm my-6">Choose the degree / د کارکوونکي سند وټاکي</div>
            <div class="flex flex-col space-y-3 mb-8">
                <div class="flex space-x-3">
                    <input class=" h-5 w-5 text-sky-500  focus-within:ring-sky-500" v-model="form.degree_name" value='1' type="radio" name="bachelor" id="bachelor" selected>
                    <label class=" cursor-pointer" for="bachelor">Bachelor / لسانس</label>
                </div>
                <div class="flex  space-x-3">
                    <input v-model="form.degree_name" value='2' class=" h-5 w-5 text-sky-500  focus-within:ring-sky-500" type="radio" name="masters" id="masters">
                    <label class=" cursor-pointer" for="masters">Masters / ماسټر</label>
                </div>
                <div class="flex  space-x-3">
                    <input v-model="form.degree_name" value='3' class=" h-5 w-5 text-sky-500  focus-within:ring-sky-500" type="radio" name="phd" id="phd">
                    <label class=" cursor-pointer" for="phd">PhD / دوکتورا</label>
                </div>
            </div>
      </div>
    </div>

    <div class="w-full border-b-2 rounded-md border-sky-400"></div>

    <!-- personal details sectoin -->
    <div class="flex justify-between my-12">
      <!-- info section of the form -->
		<div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
			<span class=" font-medium">Education Details</span>
			<p class="leading-relaxed tracking-wide font-normal pt-2">
			Enter the details about the education that the employee has,
			such as Department, faculty, university and country. 
			</p>
		</div>

      <!-- content section of the form  -->
      <div class="w-full flex-shrink px-8 items-center">
        <div class="flex flex-col w-full mb-8 space-y-2">
          <label for="study_field_english"
            >Study Field or Department / د زده کړي ډیپارټمنټ</label
          >

          <div
            class=" space-x-1 bg-gray-100 rounded-md flex justify-between items-cente  "
          >
            <input
              type="text"
              name="study_field_english"
              v-model="form.study_field_english"
              placeholder="Study field in English"
              class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none"
            />
            <div
              class="  h-8 placeholder-gray-300 border-r-2 transform rotate-12 border-gray-500 "
            ></div>
            <input
              dir="rtl"
              type="text"
              name="study_field"
              v-model="form.study_field"
              placeholder="د زده کړي ډیپارټمنټ"
              class="  w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-l-none "
            />
          </div>

          <div v-if="errors.study_field" class="form-error">
            {{ errors.study_field }}
          </div>
          <div v-if="errors.study_field_english" class="form-error">
            {{ errors.study_field_english }}
          </div>
        </div>
        <div class="flex flex-col w-full mb-8 space-y-2">
          <label for="faculty">Faculty / د زده کړي پوهنځي</label>

          <div
            class=" space-x-1 bg-gray-100 rounded-md flex justify-between  items-center "
          >
            <input
              type="text"
              name="faculty_english"
              v-model="form.faculty_english"
              placeholder="Faculty..."
              class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none"
            />
            <div
              class=" h-8 placeholder-gray-300 border-r-2 transform rotate-12 border-gray-500 "
            ></div>
            <input
              dir="rtl"
              type="text"
              name="faculty"
              v-model="form.faculty"
              placeholder="د زده کړي پوهنځي"
              class=" w-72  border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-l-none "
            />
          </div>

          <div v-if="errors.faculty" class="form-error">
            {{ errors.faculty }}
          </div>
          <div v-if="errors.faculty_english" class="form-error">
            {{ errors.faculty_english }}
          </div>
        </div>
        <div class="flex flex-col w-full mb-8 space-y-2">
          <label for="university_english"> University / پوهنتون</label>

          <div
            class=" space-x-1 bg-gray-100 rounded-md flex justify-between items-center "
          >
            <input
              type="text"
              name="university_english"
              v-model="form.university_english"
              placeholder="َUniversity name ... "
              class="
                w-72
                border-0
                placeholder-gray-400
                bg-gray-100
                rounded-md rounded-r-none
              "
            />
            <div
              class="h-8 border-r-2 transform rotate-12 border-gray-500"
            ></div>
            <input
              dir="rtl"
              type="text"
              name="university"
              v-model="form.university"
              placeholder="کورنی نوم یا تخلص"
              class="
                w-72
                border-0
                placeholder-gray-400
                bg-gray-100
                rounded-md rounded-l-none
              "
            />
          </div>
          <div v-if="errors.university" class="form-error">
            {{ errors.university }}
          </div>
          <div v-if="errors.university_english" class="form-error">
            {{ errors.university_english }}
          </div>
        </div>
        <div class="flex flex-col w-full mb-8 space-y-2">
          <label for="country">Country / هیواد</label>

          <div
            class="
              space-x-1
              bg-gray-100
              rounded-md
              flex
              justify-between
              items-center
            "
          >
            <input
              type="text"
              name="country_english"
              v-model="form.country_english"
              placeholder="Father name in english"
              class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none"
            />
            <div
              class="
                h-8
                placeholder-gray-400
                border-r-2
                transform
                rotate-12
                border-gray-500
              "
            ></div>
            <input
              dir="rtl"
              type="text"
              name="country"
              v-model="form.country"
              placeholder="هیواد "
              class="
                w-72
                border-0
                placeholder-gray-400
                bg-gray-100
                rounded-md rounded-l-none
              "
            />
          </div>
          <div v-if="errors.country" class="form-error">
            {{ errors.country }}
          </div>
          <div v-if="errors.country_english" class="form-error">
            {{ errors.country_english }}
          </div>
        </div>
      </div>
    </div>

    <div class="w-full border-b-2 rounded-md border-sky-400"></div>

    <div class="flex justify-between my-10">
      <!-- info section of the form -->
      <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
		<span class=" font-medium">Education Duration</span>
		<p class="leading-relaxed tracking-wide font-normal pt-2">
		Enter the start and end dates of the education. 
		</p>
	</div>
      <!-- content section of the form  -->
      <div class="w-full flex-shrink px-8 items-center">
        <div class="space-y-2 mb-6">
          <label for="start_date">Start Date / د پیل نیټه</label>
          <div class="bg-gray-100 rounded-md flex justify-between items-center">
            <input
              type="date"
              name="start_date"
              v-model="form.start_date"
              class="  w-full  border-0  placeholder-gray-400  bg-gray-10   rounded-m  "
            />
          </div>
          <div v-if="errors.start_date" class="form-error">
            {{ errors.start_date }}
          </div>
        </div>
        <div class="space-y-2 mb-6">
          <label for="graduation_date"
            >graduation_date Date / د فراغت نیټه</label
          >
          <div class="bg-gray-100 rounded-md flex justify-between items-center">
            <input
              type="date"
              name="graduation_date"
              v-model="form.graduation_date"
              class="
                w-full
                border-0
                placeholder-gray-400
                bg-gray-100
                rounded-md
              "
            />
          </div>
          <div v-if="errors.graduation_date" class="form-error">
            {{ errors.graduation_date }}
          </div>
        </div>
        <div class="flex items-center flex-row-reverse mt-10">
           <button
	            @click.prevent="submit"
	            class=" bg-sky-500 text-white px-6  py-2 rounded-md  text-sm  float-right  mx-4  my-2 flex"
	          >
	            <icon
	              v-if="sending"
	              name="spining-circle"
	              class="text-white h-5 w-5"
	            />
	            Save
	          </button>
	          <Link
	            class=" float-right px-4 py-2 border mx-4 my-2  shadow-sm text-gray-700  rounded-m "
	            :href="route('employee.show', degree.employee.id)"
	            >cancel</Link
	          >
                <button
                  @click.prevent="remove"
                  class=" text-red-500 px-4 py-2 rounded text-sm float-right mx-4 my-2 flex items-center"
                >
                    <icon v-if="deleting" name="spining-circle" class="text-red-500 h-5 w-5 "/>
                   <icon name="trash" class="h-4 w-4 text-red-500 mx-1" />
                  Delete 
                </button>
		
        </div>
      </div>
    </div>

  </div>
</div>

</template>

<script>

import { Link } from "@inertiajs/inertia-vue3";
import Icon from '@/Components/Icon.vue';
export default {

  props: {
    errors: Object,
    degree: Object,
  },
  components: {
    Link,
    Icon,
  },
  data() {
    return {
		sending: false, 
		deleting: false, 
      form: this.$inertia.form({
        employee_id: this.degree.employee_id,
        study_field: this.degree.study_field,
        study_field_english: this.degree.study_field_english,
        faculty: this.degree.faculty,
        faculty_english: this.degree.faculty_english,
        university: this.degree.university,
        university_english: this.degree.university_english,
        degree_name: this.degree.degree_name,
        country: this.degree.country,
        country_english: this.degree.country_english,
        start_date: this.degree.start_date,
        graduation_date: this.degree.graduation_date,
        completed: true,
      }),
    };
  },
  methods: {
    submit() {
      this.form.put(route("degree.update",this.degree.id), {
        preserverState: true,
        preserveScroll: true,
		onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
    remove() {
        if(confirm("are you sure?")) {
          this.$inertia.delete(route('degree.delete', this.degree.id), {
        onStart: () => this.deleting = true,
        onFinish: () => this.deleting = false,
      });
      }
    },
  },
};
</script>