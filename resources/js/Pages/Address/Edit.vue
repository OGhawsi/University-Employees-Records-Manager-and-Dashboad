<template>
  <div class="max-w-7xl mx-auto px-6 sm:px-12 my-10">
		<div class="flex justify-between mb-4">
			<h1 class="text-base font-medium text-gray-500">
				<Link
				:href="route('employee.show', address.employee.id)"
				class="text-sky-500 hover:underline"
				>
				{{ address.employee.first_name_english }}'s profile
				</Link>
				/ Add Address
			</h1>
		</div>
    <div class="flex flex-col rounded-lg bg-white px-12 mb-12">
      <!-- <form @submit.prevent="submit"> -->
      <!-- faculty section -->
      <div class="flex justify-between my-10">
        <!-- info section of the form -->
        <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Choose Address Type</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Select the appropriate address type i.e. Permanent address
			or Current Address. 
          </p>
        </div>
        <!-- content section of the form  -->
        <div class="w-full flex-shrink px-8 items-center">
          <div class="flex-none text-sm my-6">Choose the address / د کارکوونکي ادرس وټاکي</div>
              <div class="flex justify-start space-x-6 mb-8">
                  <div class="flex flex-col items-center space-y-2">
                      <label for="current_address">Current Address / فعلی استوګنځای</label>
                      <input class="h-5 w-5 text-sky-500 focus-within:ring-sky-500" v-model="form.address_type" value='1' type="radio" name="current_address" id="current_address">
                  </div>
                  <div class="flex flex-col items-center space-y-2">
                      <label for="permanent_address">Permanent Address / اصلی استوګنځای</label>
                      <input v-model="form.address_type" value='2' class="h-5 w-5 text-sky-500 focus-within:ring-sky-500" type="radio" name="permanent_address" id="permanent_address">
                  </div>
              </div>
        </div>
      </div>
  
      <div class="w-full border-b-2 rounded-md border-sky-400"></div>
  
      <!-- personal details sectoin -->
      <div class="flex justify-between my-12">
        <!-- info section of the form -->
         <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Province and Street Address</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Enter the province and street address for the aboce selected address type
          </p>
        </div>
  
        <!-- content section of the form  -->
        <div class="w-full flex-shrink px-8 items-center">
          <div class="flex flex-col w-full mb-8 space-y-2">
            <label for="province_english"
              >Province / ولایت</label
            >
  
            <div
              class=" space-x-1 bg-gray-100 rounded-md flex justify-between items-center "
            >
              <input
                type="text"
                name="province_english"
                v-model="form.province_english"
                placeholder="province in English"
                class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none focus-within:ring-sky-500"
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
                name="province"
                v-model="form.province"
                placeholder="ولایت"
                class="
                  w-72
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md rounded-l-none
				  focus-within:ring-sky-500
                "
              />
            </div>
  
            <div v-if="errors.province" class="form-error">
              {{ errors.province }}
            </div>
            <div v-if="errors.province_english" class="form-error">
              {{ errors.province_english }}
            </div>
          </div>
          <div class="flex flex-col w-full mb-8 space-y-2">
            <label for="street_address_english">Street Address / د محل او کوڅې بوره ادرس</label>
  
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
                name="street_address_english"
                v-model="form.street_address_english"
                placeholder="e.g. Main street, block 4, house, 34"
                class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none focus-within:ring-sky-500"
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
                name="street_address"
                v-model="form.street_address"
                placeholder="لکه: اوله ناحیه او ۶ کوڅه"
                class="
                  w-72
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md rounded-l-none
				  focus-within:ring-sky-500
                "
              />
            </div>
  
            <div v-if="errors.street_address" class="form-error">
              {{ errors.street_address }}
            </div>
            <div v-if="errors.street_address_english" class="form-error">
              {{ errors.street_address_english }}
            </div>
          </div>
          
         
        </div>
      </div>
  
      <div class="w-full border-b-2 rounded-md border-sky-400"></div>
  
      <div class="flex justify-between my-10">
        <!-- info section of the form -->
        <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
          <span class=" font-medium">Contact Details</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Enter Email and Contact number for the selected address type. 
          </p>
        </div>
        <!-- content section of the form  -->
        <div class="w-full flex-shrink px-8 items-center">
          <div class="space-y-2 mb-6">
            <label for="contact_no">Contact Number / د تماس شمیره</label>
            <div class="bg-gray-100 rounded-md flex justify-between items-center">
              <input
                type="tel"
                name="contact_no"
                v-model="form.contact_no"
                placeholder="0000 000 000"
                class="
                  w-full
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md
				  focus-within:ring-sky-500
                "
              />
            </div>
            <div v-if="errors.contact_no" class="form-error">
              {{ errors.contact_no }}
            </div>
          </div>
          <div class="space-y-2 mb-6">
            <label for="email"
              >Email / بریښنالیک</label
            >
            <div class="bg-gray-100 rounded-md flex justify-between items-center">
              <input
                type="email"
                name="email"
                v-model="form.email"
                placeholder="example@example.com"
                class="
                  w-full
                   text-sm
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md
				  focus-within:ring-sky-500
                "
              />
            </div>
            <div v-if="errors.email" class="form-error">
              {{ errors.email }}
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
	            :href="route('employee.show', address.employee.id)"
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
    address: Object,
  },
  components: {
    Link,
	Icon, 
  },
  data() {
    return {
		sending:false,
		deleting: false,
      form: this.$inertia.form({
        employee_id: this.address.employee_id,
        contact_no: this.address.contact_no,
        email: this.address.email,
        province: this.address.province,
        province_english: this.address.province_english,
        address_type: this.address.address_type,
        street_address: this.address.street_address,
        street_address_english: this.address.street_address_english,
        completed: true,
      }),
    };
  },
  methods: {
    submit() {
      this.form.put(route("address.update", this.address.id), {
        preserverState: true,
        preserveScroll: true,
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
	 remove() {
      if(confirm("are you sure?")) {
        this.$inertia.delete(route('address.delete', this.address.id), {
			onStart: () => this.deleting = true,
			onFinish: () => this.deleting = false,
		});
      }
    },
    
  },
};
</script>