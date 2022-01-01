<template>
  <div class="relative">
    <div v-show="open" class="fixed inset-0 z-40" @click="open = false"></div>
    <div
      @click="this.open = !this.open"
      :class="{'rounded-b-none border-b-gray-50': open}"
      class="w-80 select-none flex justify-between border text-gray-700 border-gray-500 rounded px-3 z-50 py-2 h-10 cursor-pointer"
    >
      <span class="text-sm font-medium text-gray-400" v-if="!this.selectedName">Select an employee </span>
      <span v-else>{{ selectedName }}</span>
      <svg xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 stroke-current text-gray-600"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M19 9l-7 7-7-7"
        />
      </svg>
    </div>

    <transition name="fade">
      <div
        v-show="open"
        class="w-80 absolute z-50 p-4 bg-white border border-t-0 rounded-t-none border-gray-500 rounded-md shadow-lg space-y-2"
      >
        <input
          autocomplete="nope"
          ref="searchable-dropdown"
          placeholder="type the name here..."
          type="text"
          name="searchInput"
          @input="fetch"
          v-model="inputValue"
          class="rounded border-none w-full focus-within:ring-sky-500 bg-gray-200"
        />
        <div
          v-for="(item, index) in employees"
          :key="index"
          class="px-0"
          tabindex="0"
        >
            <div
				v-if="employees"
              @click="selectTheId(index)"
              class=" hover:bg-gray-200 px-2 py-2 inline-block rounded-md cursor-pointer w-full"
              :class="{'bg-gray-200 rounded-md px-2 py-2' : this.selectedName === item.first_name_english }"
              tabindex="-1"
            >
              {{ item.first_name_english }} {{ item.last_name_english }}
          </div>
        </div>
      </div>
    </transition>
      <div v-if="selectedName === null" class="form-error">choose a name</div>
      
  </div>
</template>

<script>
import throttle from "lodash/throttle";
export default {
  props: {
  employees: {
    type: Object,
    required: true
  },
  currentDean: {
    type: Object,
    required: false,
  },
	fetchingRoute: String, 
  },
  emits: ["selectId"],
  data() {
    return {
      selectedId: null,
      selectedName: null,
      inputValue: null,
      open: false,
    };
  },
  mounted() {
        if (this.currentDean) {
          this.selectedId = this.currentDean.id;
          this.selectedName = this.currentDean.first_name_english;
        }
  },
  created() {
    let that = this;
    document.addEventListener("keyup", function (evt) {
      if (evt.keyCode === 27) {
        that.open = false;
      }
    });
  },

  methods: {
    selectTheId(item) {
      this.selectedName = this.employees[item].first_name_english +' '+ this.employees[item].last_name_english;
      this.$emit("selectId",this.employees[item].id);
      this.open = false;
    },

    fetch: throttle(function () {
      this.open = true;
      let term = this.inputValue;
      this.$inertia.get(
        this.fetchingRoute,
        { term },
        {
          preserveState: true,
          preserveScroll: true,
          replace: true,
        }
      );
    }, 500),
  },
};
</script>