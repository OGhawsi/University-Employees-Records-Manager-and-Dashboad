<template>
  <div class="max-w-7xl mx-auto px-6 sm:px-12 my-10">
    <div class="flex flex-col rounded-md shadow-lg bg-white px-12 mb-12">
      <!-- <form @submit.prevent="submit"> -->
      <div class="flex justify-between my-12">
        <!-- info section of the form -->
        <div class="flex flex-col w-72 flex-shrink-0 pr-8">
          <span class="text-gray-700 font-bold">Rank Details</span>
          <p class="leading-relaxed tracking-wide font-normal pt-2">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto
            sequi corrupti, cum suscipit, possimus illum inventore
            exercitationem dolores in hic repellendus, unde nam! Omnis illum
            impedit velit corporis dolorum voluptate!
          </p>
        </div>

        <!-- content section of the form  -->
        <div class="w-full flex-shrink px-8 items-center">
          <div class="flex-none text-sm my-6">
            Academic Rank / علمي رتبه
          </div>
          <div class="flex flex-wrap space-y-6 justify-start space-x-6 mb-8">
            <div class="flex flex-col items-center space-y-2">
              <label for="ta">Teaching Assistant / بوهیالی</label>
              <input
                class="h-5 w-5 text-indigo-500 ring-0"
                v-model="form.academic_rank"
                value="1"
                type="radio"
                name="ta"
                id="ta"
              />
            </div>
            <div class="flex flex-col items-center space-y-2">
              <label for="senior_assist_ta"
                >Senior Teaching Assist. / نامزد پوهنیار</label
              >
              <input
                v-model="form.academic_rank"
                value="2"
                class="h-5 w-5 text-indigo-500 ring-0"
                type="radio"
                name="senior_assist_ta"
                id="senior_assist_ta"
              />
            </div>
            <div class="flex flex-col items-center space-y-2">
              <label for="assist_prof">Assist. Prof. / پوهنیار</label>
              <input
                v-model="form.academic_rank"
                value="3"
                class="h-5 w-5 text-indigo-500 ring-0"
                type="radio"
                name="assist_prof"
                id="assist_prof"
              />
            </div>
            <div class="flex flex-col items-center space-y-2">
              <label for="senior_assist_prof"
                >Senior Assist. Prof. / پوهنمل</label
              >
              <input
                v-model="form.academic_rank"
                value="4"
                class="h-5 w-5 text-indigo-500 ring-0"
                type="radio"
                name="senior_assist_prof"
                id="senior_assist_prof"
              />
            </div>
            <div class="flex flex-col items-center space-y-2">
              <label for="associate_prof">Associate Prof. / پوهندوی</label>
              <input
                v-model="form.academic_rank"
                value="5"
                class="h-5 w-5 text-indigo-500 ring-0"
                type="radio"
                name="associate_prof"
                id="associate_prof"
              />
            </div>
            <div class="flex flex-col items-center space-y-2">
              <label for="senior_associate_prof"
                >Senior Associate Prof. / پوهنوال</label
              >
              <input
                v-model="form.academic_rank"
                value="6"
                class="h-5 w-5 text-indigo-500 ring-0"
                type="radio"
                name="senior_associate_prof"
                id="senior_associate_prof"
              />
            </div>
            <div class="flex flex-col items-center space-y-2">
              <label for="Professor">Professor / پوهاند</label>
              <input
                v-model="form.academic_rank"
                value="7"
                class="h-5 w-5 text-indigo-500 ring-0"
                type="radio"
                name="Professor"
                id="Professor"
              />
            </div>
          </div>
        <div class="space-y-2 mb-6">
            <label for="subject_of_academic_research">Researc Topic / علمي موضوِع</label>
            <div class="bg-gray-100 rounded-md flex justify-between items-center">
              <input
                type="text"
                name="subject_of_academic_research"
                v-model="form.subject_of_academic_research"
                placeholder="Research Topic / علمي موضوِع"
                class="
                  w-full
                  border-0
                  placeholder-gray-400
                  bg-gray-100
                  rounded-md
                "
              />
            </div>
            <div v-if="errors.subject_of_academic_research" class="form-error">
              {{ errors.subject_of_academic_research }}
            </div>
          </div>
        <div class="space-y-2 mb-6">
            <label for="registration_of_academic_research">Registration of Research TOpic / د علمي موضوِع د ثبتولو نیټه</label>
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
            <div v-if="errors.registration_of_academic_research" class="form-error">
              {{ errors.registration_of_academic_research }}
            </div>
          </div>
        <div class="space-y-2 mb-6">
            <label for="completion_of_academic_research">Completeion Date of Research / د علمي موضوِع د پوره کولو نیټه</label>
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
          <div class="mt-10">
            <button
              @click.prevent="submit()"
              class="
                float-right
                mt-4
                px-4
                py-2
                bg-gray-800
                text-white
                shadow
                rounded-md
              "
            >
              save and continue
            </button>
            <Link
              class="
                float-right
                mt-4
                px-4
                py-2
                border
                mx-4
                shadow-sm
                text-gray-700
                rounded-md
              "
              :href="route('employee.show', employee.id)"
              >cancel</Link
            >
          </div>
        </div>
      </div>

      <!-- </form> -->
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  props: {
    errors: Object,
    employee: Object,
  },
  components: {
    Link,
  },
  data() {
    return {
      form: this.$inertia.form({
        employee_id: this.employee.id,
        academic_rank: null,
        subject_of_academic_research: null,
        registration_of_academic_research: null,
        completion_of_academic_research: null,
        completed: true,
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(route("rank.store", this.employee.id), {
        preserverState: true,
        preserveScroll: true,
        replace: true,
      });
    },
    cancel() {},
  },
};
</script>