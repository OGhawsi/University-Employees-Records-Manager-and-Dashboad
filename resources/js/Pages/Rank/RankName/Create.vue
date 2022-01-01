<template>
  <div class="max-w-7xl mx-auto px-6 sm:px-12">
    <div class="flex justify-between mb-4">
		<h1 class="text-base font-medium text-gray-500">
			<Link
			:href="route('dashboard')"
			class="text-sky-500 hover:underline"
			>
			Dashboard
			</Link> / 
			Creat New Academic Rank
		</h1>
	</div>
   
    <div class="mb-6 border-b border-gray-300"></div>
    <div class="flex">
      <!-- side bar -->
	<div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
		<span class=" font-medium">Academic Rank Details</span>
		<p class="leading-relaxed tracking-wide font-normal pt-2">
			Enter the academic rank name in Pashto and English, 
            also add the rank number. 
		</p>
	</div>

      <!-- main create form   -->
      <div class="flex flex-col w-full flex-shrink mx-auto rounded-lg shadow-md mb-12">
        <form @submit.prevent="submit">
            <div
                class="px-16 bg-white rounded-t-lg p-10">
                <div class="flex flex-col mb-6 space-y-1">
                    <label for="name">د رتبي نوم</label>
                    <input
                        type="text"
                        name="name"
                        v-model="form.name"
                        class="w-80 rounded"
                    />
                    <div v-if="errors.name" class="form-error">{{ errors.name }}</div>
                </div>
                <div class="flex flex-col mb-6 space-y-1">
                    <label for="name_english">Academic Rank</label>
                    <input
                        type="text"
                        name="name_english"
                        v-model="form.name_english"
                        class="w-80 rounded"
                    />
                    <div v-if="errors.name_english" class="form-error">{{ errors.name_english }}</div>
                </div>
                <div class="flex flex-col mb-6 space-y-1">
                    <label for="academic_rank">Academic Rank Number</label>
                    <input
                        type="number"
                        name="namacademic_rank"
                        v-model="form.academic_rank"
                        class="w-80 rounded"
                    />
                    <div v-if="errors.academic_rank" class="form-error">{{ errors.academic_rank }}</div>
                </div>
            </div>
            <div class="bg-gray-200 rounded-b-lg flex justify-end">
				<Link
					class=" float-right px-4 py-2 border border-gray-300 shadow-sm mx-4 my-2  text-gray-700  rounded-md "
					:href="route('dashboard')"
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

export default {
  components: {
    Link,
    Icon,
  },

  props: {
      errors: Object
  },
  data() {
      return {
          sending: false,
          form: this.$inertia.form({
            name : null,
            name_english : null,
            academic_rank : null,
          }),
      }
  },

  methods: {
    submit() {
      this.form.post(route('rank.storeRank'), {
        preserveScroll: true,
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })
    }
},
}
</script>