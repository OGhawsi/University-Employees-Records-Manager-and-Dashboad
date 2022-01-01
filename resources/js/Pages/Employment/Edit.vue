<template>
 <div class="max-w-7xl mx-auto px-6 sm:px-12 my-10">
	 <div class="flex justify-between mb-4">
      <h1 class="text-base font-medium text-gray-500">
        <Link
          :href="route('employee.show', employment.employee_id)"
          class="text-sky-500 hover:underline"
        >
          {{ employment.employee.first_name_english }}'s profile
        </Link>
        / Add Employment Details
      </h1>
    </div>
    <div class="flex flex-col rounded-lg bg-white px-12 mb-12">
      <!-- <form @submit.prevent="submit"> -->
      <!-- faculty section -->
      <div class="flex justify-between my-10">
       <!-- info section of the form -->
         <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Choose Academic Rank</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Choose the academic rank, which the employee in which the employee
			is hired, into this current position i.e. Head of Department, Dean of Faculty, and etc. 
          </p>
        </div>
        <!-- content section of the form  -->
        <div class="w-full flex-shrink px-8 items-center">
          <div class="flex-none text-sm my-6">Employment Rank / د مققرری رتبه</div>
              <div class="my-2" v-for="rank in ranks">
				<input
					class="h-5 w-5 text-sky-500 focus-within:ring-sky-500"
					v-model="form.academic_rank"
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
      <div class="flex justify-between my-10">
          <!-- info section of the form -->
         <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Post Details</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Enter the details related to this post such as Designation, Post code,
			Official Employment Letter number and date. 
          </p>
        </div>
        <!-- content section of the form  -->
        <div class="w-full flex-shrink px-8 items-center">
          <div class="space-y-2 mb-6">
            <label for="post_code">Post Code / د بست کوډ</label>
            <div class="bg-gray-100 rounded-md flex justify-between items-center">
              <input
                type="number"
                name="post_code"
                v-model="form.post_code"
                class="
                  w-full
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md
                "
              />
            </div>
            <div v-if="errors.post_code" class="form-error">
              {{ errors.post_code }}
            </div>
          </div>
          <div class="space-y-2 mb-6">
            <label for="designation"
              >Designation / دنده</label
            >
            <div class="bg-gray-100 rounded-md flex justify-between items-center">
              <input
                type="text"
                name="designation"
                v-model="form.designation"
                placeholder="e.g. Teacher"
                class="
                  w-full
                   text-sm
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md
                "
              />
            </div>
            <div v-if="errors.designation" class="form-error">
              {{ errors.designation }}
            </div>
          </div>
          <div class="space-y-2 mb-6">
            <label for="employment_letter_number"
              >ٍEmployment Official Letter Number / د مقرری د مکتوب نمبر</label
            >
            <div class="bg-gray-100 rounded-md flex justify-between items-center">
              <input
                type="text"
                name="employment_letter_number"
                v-model="form.employment_letter_number"
                placeholder="e.g. 3466443"
                class="
                  w-full
                   text-sm
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md
                "
              />
            </div>
            <div v-if="errors.employment_letter_number" class="form-error">
            </div>
          </div>
          
          <div class="space-y-2 mb-6">
            <label for="employment_date"
              >Employment Date / د مقرری نیټه</label
            >
            <div class="bg-gray-100 rounded-md flex justify-between items-center">
              <input
                type="date"
                name="employment_date"
                v-model="form.employment_date"
                class="
                  w-full
                   text-sm
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md
                "
              />
            </div>
            <div v-if="errors.employment_date" class="form-error">
              {{ errors.employment_date }}
            </div>
          </div>
          
        </div>
      </div>
  
      <div class="w-full border-b-2 rounded-md border-sky-400"></div>
  
      <!-- personal details sectoin -->
      <div class="flex justify-between my-12">
         <!-- info section of the form -->
        <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Rewards and Penalties</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Add Post title, rewards and penalties in this section .
          </p>
        </div>
  
        <!-- content section of the form  -->
        <div class="w-full flex-shrink px-8 items-center">
            <div class="flex flex-col w-full mb-8 space-y-2">
            <label for="penalties_englishpenalties"
              >Post title / د بست عنوان</label
            >
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
                name="post_title_english"
                v-model="form.post_title_english"
                placeholder="Post title in English"
                class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none"
              />
              <div
                class="
                  h-8
                  placeholder-gray-300
                  border-r-2
                  transform
                  rotate-12
                  border-gray-500
                "
              ></div>
              <input
                dir="rtl"
                type="text"
                name="post_title"
                v-model="form.post_title"
                placeholder="دبست عنوان"
                class="
                  w-72
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md rounded-l-none
                "
              />
            </div>
  
            <div v-if="errors.post_title" class="form-error">
              {{ errors.post_title }}
            </div>
            <div v-if="errors.post_title_english" class="form-error">
              {{ errors.post_title_english }}
            </div>
          </div>
          <div class="flex flex-col w-full mb-8 space-y-2">
            <label for="rewards_english"
              >Rewards / مکافات</label
            >
  
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
                name="rewards_english"
                v-model="form.rewards_english"
                placeholder="rewards in English"
                class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none"
              />
              <div
                class="
                  h-8
                  placeholder-gray-300
                  border-r-2
                  transform
                  rotate-12
                  border-gray-500
                "
              ></div>
              <input
                dir="rtl"
                type="text"
                name="rewards"
                v-model="form.rewards"
                placeholder="مکافات"
                class="
                  w-72
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md rounded-l-none
                "
              />
            </div>
  
            <div v-if="errors.rewards" class="form-error">
              {{ errors.rewards }}
            </div>
            <div v-if="errors.rewards_english" class="form-error">
              {{ errors.rewards_english }}
            </div>
          </div>
          <div class="flex flex-col w-full mb-8 space-y-2">
            <label for="penalties_englishpenalties"
              >Pernalties / مجازات</label
            >
  
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
                name="penalties_english"
                v-model="form.penalties_english"
                placeholder="pernalties in English"
                class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none"
              />
              <div
                class="
                  h-8
                  placeholder-gray-300
                  border-r-2
                  transform
                  rotate-12
                  border-gray-500
                "
              ></div>
              <input
                dir="rtl"
                type="text"
                name="penalties"
                v-model="form.penalties"
                placeholder="مجازات"
                class="
                  w-72
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md rounded-l-none
                "
              />
            </div>
  
            <div v-if="errors.penalties" class="form-error">
              {{ errors.penalties }}
            </div>
            <div v-if="errors.penalties_english" class="form-error">
              {{ errors.penalties_english }}
            </div>
            <div class="mt-10">
             <button
	            @click.prevent="submit"
	            class=" bg-sky-500 text-white px-6  py-2 rounded-md  text-sm  float-right  mx-4  my-2 flex"
	          >
	            <icon v-if="sending" name="spining-circle" class="text-white h-5 w-5" />
	            Save
	          </button>
	          <Link
	            class=" float-right px-4 py-2 border mx-4 my-2  shadow-sm text-gray-700  rounded-m "
	            :href="route('employee.show', employment.employee_id)"
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
      <!-- </form> -->
    </div>
 </div>
</template>

<script>
import Icon from '@/Components/Icon.vue';
import { Link } from "@inertiajs/inertia-vue3";
export default {
  props: {
    errors: Object,
    employment: Object,
	ranks: Object,
  },
  components: {
    Link,
	Icon, 
  },
  data() {
    return {
	
		sending:false,
		deleting:false,
      form: this.$inertia.form({
        employee_id: this.employment.employee_id,
        rewards: this.employment.rewards,
        rewards_english: this.employment.rewards_english,
        penalties: this.employment.penalties,
        penalties_english: this.employment.penalties_english,
        post_title: this.employment.post_title,
        post_title_english: this.employment.post_title_english,
        post_code: this.employment.post_code,
        designation: this.employment.designation,
        employment_letter_number: this.employment.employment_letter_number,
        academic_rank: this.employment.academic_rank,
        employment_date: this.employment.employment_date,
        completed: true,
      }),
    };
  },
  methods: {
		submit() {
		this.form.put(route("employment.update", this.employment.id), {
			preserverState: true,
			preserveScroll: true,
			onStart: () => (this.sending = true),
			onFinish: () => (this.sending = false),
		});
		},
		remove() {
			if(confirm("are you sure?")) {
			this.$inertia.delete(route('employment.delete', this.employment.id), {
				onStart: () => this.deleting = true,
				onFinish: () => this.deleting = false,
			});
		}
	},
  }}
</script>