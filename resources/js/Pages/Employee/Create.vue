<template>
<div class="max-w-7xl mx-auto px-6 sm:px-12 py-8">
    <div class=" mb-4">
        <h1 class="text-base font-medium text-gray-500">
            <Link
            :href="route('dashboard')"
            class="text-sky-500 hover:underline"
            >
            Dashboard 
            </Link>
                /
            <Link
            :href="route('employee.index')"
            class="text-sky-500 hover:underline"
            >
                Employees 
            </Link>
            / Create
        </h1>
    </div>
    <div class="flex flex-col rounded-lg bg-white px-12 mb-12">
        <form @submit.prevent="submit">
            <!-- faculty section -->
            <div class=" flex justify-between my-10">
                <!-- info section of the form -->
                <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
                    <span class=" font-medium">Select Faculty and Department</span>
                    <p class="leading-relaxed tracking-wide font-normal pt-2">
                        Select the faculty that employee is hired at. 
                        Then select the resepected department as well.
                        <span class="font-semibold mt-2">All fields are required</span>
                    </p>
                </div>
                <!-- content section of the form  -->
                <div class=" w-full flex-shrink px-8 items-center">
                        <div class=" mb-8 space-y-2">
                            <div class="flex flex-col space-y-2">
                                <label for="faculty_id">Faculty / پوهنځي</label>
                                    <select @change="updateDepartments()"
                                            class="w-80 rounded-md" 
                                            name="faculty_id" id="faculty_id" 
                                            v-model="selected_faculty">
                                        <option 
                                                v-for="(faculty, index) in faculties" 
                                                :key="index" 
                                                :value="faculty.id" >
                                                    {{faculty.name}}
                                        </option>
                                    </select>
                            </div>
                        </div>
                        <div class=" mb-8 space-y-2">
                            <div class="flex flex-col space-y-2">
                                <label for="department_id">Department / ډیپارټمنټ</label>
                                    <select name="department_id"
                                            class="w-80 rounded-md " 
                                            id="department_id" 
                                            v-model="form.department_id">
                                        <option 
                                                v-if="departments"
                                                v-for="(department, index) in departments" 
                                                :key="index" 
                                                :value="department.id" >
                                                    {{department.name}}
                                        </option>
                                    </select>
                            
                                <div v-if="errors.department_id" class="form-error">{{ errors.department_id }}</div>
                            
                            </div>
                        </div>
                </div>
            </div>
            <div class="w-full border-b-2 rounded-md border-sky-400"></div>
            <!-- personal details sectoin -->
            <div class="flex justify-between my-12 ">
                <!-- info section of the form -->
                <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
                    <span class=" font-medium">Employee Persoanl Details</span>
                    <p class="leading-relaxed tracking-wide font-normal pt-2">
                        Enter the personal details of the employee such as
                         first name, last name, father name, grand father name, and nationality.
                         <p class="font-semibold">Only English fields are required</p>
                    </p>
                </div>
                <!-- content section of the form  -->
                <div class=" w-full flex-shrink px-8 items-center">
                    <div class="flex flex-col w-full mb-8 space-y-2">
                        <label for="first_name_english">First Name / نوم</label>
                        <div class="space-x-1 bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="first_name_english"
                            v-model="form.first_name_english"
                            placeholder="Name in English"
                            class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none"
                            />
                            <div class="h-8 placeholder-gray-400 border-r-2 transform rotate-12 border-gray-500"></div>
                            <input
                            dir="rtl"
                            type="text"
                            name="first_name"
                            v-model="form.first_name"
                            placeholder="نوم دلته ولیکئ"
                            class="w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-l-none"
                            />
                        </div>
                        <div v-if="errors.first_name" class="form-error">{{ errors.first_name }}</div>
                        <div v-if="errors.first_name_english" class="form-error">{{ errors.first_name_english }}</div>
                    </div>
                    <div class="flex flex-col w-full mb-8 space-y-2">
                        <label for="last_name">Last Name / کورنی نوم</label>
                        <div class="space-x-1 bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="last_name_english"
                            v-model="form.last_name_english"
                            placeholder="Name in English"
                            class="w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-r-none"
                            />
                            <div class="h-8 border-r-2 transform rotate-12 border-gray-500"></div>
                            <input
                            dir="rtl"
                            type="text"
                            name="last_name"
                            v-model="form.last_name"
                            placeholder="کورنی نوم یا تخلص"
                            class="w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-l-none"
                            />
                        </div>
                        <div v-if="errors.last_name" class="form-error">{{ errors.last_name }}</div>
                        <div v-if="errors.last_name_english" class="form-error">{{ errors.last_name_english }}</div>
                    </div>
                    <div class="flex flex-col w-full mb-8 space-y-2">
                        <label for="father_name_english">Father Name / د پلار نوم</label>
    
                        <div class="space-x-1 bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="father_name_english"
                            v-model="form.father_name_english"
                            placeholder="Father name in english"
                            class="w-72 border-0 bg-gray-100 rounded-md rounded-r-none"
                            />
                            <div class="h-8 placeholder-gray-400 border-r-2 transform rotate-12 border-gray-500"></div>
                            <input
                            dir="rtl"
                            type="text"
                            name="father_name"
                            v-model="form.father_name"
                            placeholder="د پلار نوم"
                            class="w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-l-none"
                            />
                        </div>
    
                        <div v-if="errors.father_name" class="form-error">{{ errors.father_name }}</div>
                        <div v-if="errors.father_name_english" class="form-error">{{ errors.father_name_english }}</div>
                    </div>
                    <div class="flex flex-col w-full mb-8 space-y-2">
                        <label for="grandfather_name">Grandfather Name / د نیکه نوم</label>
    
                        <div class="space-x-1 bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="grandfather_name_english"
                            v-model="form.grandfather_name_english"
                            placeholder="Name in English"
                            class="w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-r-none"
                            />
                            <div class="h-8 border-r-2 transform rotate-12 border-gray-500"></div>
                            <input
                            dir="rtl"
                            type="text"
                            name="last_name"
                            v-model="form.grandfather_name"
                            placeholder="دنیکه نوم"
                            class="w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-l-none"
                            />
                        </div>
                        <div v-if="errors.grandfather_name" class="form-error">{{ errors.grandfather_name }}</div>
                        <div v-if="errors.grandfather_name_english" class="form-error">{{ errors.grandfather_name_english }}</div>
                    </div>
                    <div class="flex flex-col w-full mb-8 space-y-2">
                        <label for="nationality">Nationality / ملیت</label>
    
                        <div class="space-x-1 bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="nationality_english"
                            v-model="form.nationality_english"
                            placeholder="Name in English"
                            class="w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-r-none"
                            />
                            <div class="h-8 border-r-2 transform rotate-12 border-gray-500"></div>
                            <input
                            dir="rtl"
                            type="text"
                            name="last_name"
                            v-model="form.nationality"
                            placeholder="ملیت"
                            class="w-72 border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-l-none"
                            />
                        </div>
                        <div v-if="errors.nationality" class="form-error">{{ errors.nationality }}</div>
                        <div v-if="errors.nationality_english" class="form-error">{{ errors.nationality_english }}</div>
                    </div>
                    
                </div>
            </div>
            <div class="w-full border-b-2 rounded-md border-sky-400"></div>
            <!-- status section -->
            <div class=" flex justify-between my-10">
                <!-- info section of the form -->
                <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
                    <span class=" font-medium">Gender and Marital Status</span>
                    <p class="leading-relaxed tracking-wide font-normal pt-2">
                        Select the appropriate gender status, marital status, as well as working status. 
                          <p class="font-semibold">All fields are required</p>
                    </p>
                </div>
                <!-- content section of the form  -->
                <div class=" w-full flex-shrink px-8 items-center">
                    <!-- gender -->
                    <div class="flex-none text-sm my-6">Choose the gender / د کارکوونکي جنسیت وټاکي</div>
                    <div class="flex justify-start space-x-6 mb-8">
                        <div class="flex flex-col items-center space-y-2">
                            <label for="male">Male / نارینه</label>
                            <input class="h-5 w-5 text-sky-500 ring-0" v-model="form.gender" value="1" type="radio" name="male" id="male" selected>
                        </div>
                        <div class="flex flex-col items-center space-y-2">
                            <label for="female">Female / ښځینه</label>
                            <input v-model="form.gender" value="2" class="h-5 w-5 text-sky-500 ring-0" type="radio" name="female" id="female">
                        </div>
                        <div class="flex flex-col items-center space-y-2">
                            <label for="other">Other / کوم بل څه</label>
                            <input v-model="form.gender" value="3" class="h-5 w-5 text-sky-500 ring-0" type="radio" name="other" id="other">
                        </div>
                    </div>
                    <!-- marital status -->
                    <hr class="my-6">
                    <div class="flex-none text-sm my-5">Select marital status / د کارکوونکي مدنی وټاکي</div>
                    <div class="flex justify-start space-x-6 mb-8">
                        <div class="flex flex-col items-center space-y-3">
                            <label for="married">Married / متاهل</label>
                            <input class="h-5 w-5 text-sky-500 ring-0" v-model="form.marital_status" value="1" type="radio" name="married" id="married" selected>
                        </div>
                        <div class="flex flex-col items-center space-y-3">
                            <label for="single">Single / مجرد</label>
                            <input v-model="form.marital_status" value="2" class="h-5 w-5 text-sky-500 ring-0" type="radio" name="single" id="single">
                        </div>
                        <div class="flex flex-col items-center space-y-3">
                            <label for="others">Other / کوم بل څه</label>
                            <input v-model="form.marital_status" value="3" class="h-5 w-5 text-sky-500 ring-0" type="radio" name="others" id="others">
                        </div>
                    </div>
                    <!-- marital status -->
                    <hr class="my-6">
                    <div class="flex-none text-sm my-5">Select current status / د کارکوونکي اوسني حالت</div>
                    <div class="flex justify-start space-x-6 mb-8">
                        <div class="flex flex-col items-center space-y-3">
                            <label for="available">Available / موجود</label>
                            <input class="h-5 w-5 text-sky-500 ring-0" v-model="form.status" value="1" type="radio" name="available" id="available" selected>
                        </div>
                        <div class="flex flex-col items-center space-y-3">
                            <label for="working">Working Outside / حفظ کدر</label>
                            <input v-model="form.status" value="2" class="h-5 w-5 text-sky-500 ring-0" type="radio" name="working" id="working">
                        </div>
                        <div class="flex flex-col items-center space-y-3">
                            <label for="studying">Studying / خدمتي</label>
                            <input v-model="form.status" value="3" class="h-5 w-5 text-sky-500 ring-0" type="radio" name="studying" id="studying">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full border-b-2 rounded-md border-sky-400"></div>
            <div class=" flex justify-between my-10">
                <!-- info section of the form -->
                <div class="flex flex-col w-72 flex-shrink-0 pr-8 text-gray-600">
                    <span class=" font-medium">Other Important Details</span>
                    <p class="leading-relaxed tracking-wide font-normal pt-2">
                        Enter the National ID number, Passport Number, Date of birth, Native language, 
                        and Other languages that the employee can speak with.
                          <p class="font-semibold">National ID, Date of Birth and Native language fields are required</p> 
                    </p>
                </div>
                <!-- content section of the form  -->
                <div class=" w-full flex-shrink px-8 items-center">
                    <div class=" mb-8 space-y-2">
                        <label for="id_tazkira">National ID / د تذکیرې نمبر</label>
                        <div class=" w-full space-x-1 bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="id_tazkira"
                            v-model="form.id_tazkira"
                            placeholder="e.g: 5577789"
                            class="w-full border-0 placeholder-gray-400 bg-gray-100 rounded-md "
                            />
                        </div>
                        <div v-if="errors.id_tazkira" class="form-error">{{ errors.id_tazkira }}</div>
                    </div>
                    <div class="mb-8 space-y-2">
                        <label for="passport_number">Passport Number / د پاسپورټ نمبر</label>
                        <div class=" w-full space-x-1 bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="passport_number"
                            v-model="form.passport_number"
                            placeholder="e.g: 5577789"
                            class="w-full border-0 placeholder-gray-400 bg-gray-100 rounded-md "
                            />
                        </div>
                        <div v-if="errors.passport_number" class="form-error">{{ errors.passport_number }}</div>
                    </div>
                    <div class="space-y-2 mb-6">
                        <label for="date_of_birth">Birthdate / د زېږېدني نیټه</label>
                        <div class=" bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="date"
                            name="date_of_birth"
                            v-model="form.date_of_birth"
                            class="w-full border-0 placeholder-gray-400 bg-gray-100 rounded-md"
                            />
                        </div>
                        <div v-if="errors.date_of_birth" class="form-error">{{ errors.date_of_birth }}</div>
                    </div>
                    <div class="space-y-2 my-6">
                        <label for="native_language">Native Language / مورنۍ ژبه</label>
                        <div class=" bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="native_language"
                            placeholder="e.g. English  پښتو یا دری"
                            v-model="form.native_language"
                            class="w-full border-0 placeholder-gray-400 bg-gray-100 rounded-md"
                            />
                        </div>
                        <div v-if="errors.native_language" class="form-error">{{ errors.native_language }}</div>
                    </div>
                    <div class="space-y-2 mt-6 mb-2">
                        <label for="native_language">Other Languages / نوري ژبي</label>
                        <div class=" bg-gray-100 rounded-md flex justify-between items-center">
                            <input
                            type="text"
                            name="other_language"
                            placeholder="e.g. English  پښتو یا دری"
                            v-model.trim="language"
                            ref="language_input"
                            class="w-full border-0 placeholder-gray-400 bg-gray-100 rounded-md rounded-r-none"
                            />
                            <button
                                @click.prevent="addLanguage"
                                class="px-4 py-2 border border-sky-500  shadow-sm  text-sky-500 rounded-md rounded-l-none">add</button>
                        </div>
                        <div v-if="errors.other_languages" class="form-error">{{ errors.other_languages }}</div>
                    </div>
                    <div class="flex flex-wrap">
                        <div v-if="form.other_languages" v-for="(language,index) in form.other_languages">
                            <div class="shadwo-md m-1 bg-gray-200 text-sm rounded-md px-4 py-2 w-36 flex justify-between">
                                {{language}}
                                <div @click="removeLanguage(index)" class="bg-gray-200 cursor-pointer">
                                    <icon name="x" class="h-5 w-5 group-hover:text-gray-900 text-gray-700" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center flex-row-reverse mt-8">
                        <button
                            @click.prevent="submit"
                            class=" bg-sky-500 text-white px-6  py-2 rounded-md  text-sm  float-right   my-2 flex"
                        >
                            <icon v-if="sending" name="spining-circle" class="text-white h-5 w-5" />
                            Save
                        </button>
                        <Link
                            class=" float-right px-4 py-2 border mx-4 my-2  shadow-sm text-gray-700  rounded-md "
                            :href="route('employee.index')"
                            >cancel</Link
                        >
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</template>
<script>

import Icon from '@/Components/Icon.vue';
import { Link } from '@inertiajs/inertia-vue3'
export default {
	props: {
		errors: Object,
		faculties: Object,
		departments: Object,
	},
	components: {
		Link,
        Icon,
	},
	data() {
		return {
            sending: false, 
            language: null,
            selected_faculty: null,
			form: this.$inertia.form( {
				first_name: "",
				first_name_english: "",
				last_name: "",
				last_name_english: "",
				father_name: "",
				father_name_english: "",
				grandfather_name: "",
				grandfather_name_english: "",
				nationality: "",
				nationality_english: "",

				id_tazkira: null,
				passport_number: null,
				gender: 1,
				marital_status: 1,

				date_of_birth: null,
				native_language: null,
				other_languages: [],

                status: 1,

                faculty_id: this.selected_faculty,
                department_id: null,
			}),
		}
	},

    watch: {
        selected_faculty () {
            return this.form.faculty_id = this.selected_faculty
        }
    },
	methods: {
        updateDepartments() {
            let relatedDepartment = this.selected_faculty;
            this.$inertia.get(route('employee.create'),{relatedDepartment}, 
            {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        },
        addLanguage(){
            if (this.language) {
                this.form.other_languages.push(this.language);
                this.language = null;
                this.$nextTick(this.$refs.language_input.focus())
            }
        },
        removeLanguage(index){
            this.form.other_languages.splice(index,1);
            this.language = null;
        },
		submit() {
			this.form.post(route('employee.store'), {
                preserverState: true,
                preserveScroll: true,
                onStart: () => (this.sending = true),
                onFinish: () => (this.sending = false),
            })
		},
		cancel() {
			
		},
	},
}
</script>