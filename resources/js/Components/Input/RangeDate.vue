<template>
  <div ref="flatpickr" class="relative min-w-auto md:min-w-350px">
    <input type="text" class="w-full pr-8 bg-transparent absolute pointer-events-none" :placeholder="placeholder" :class="class" :style="style" :disabled="disabled">
    <input type="text" class="w-full pr-8" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :class="class" :style="style" data-input :disabled="disabled" placeholder="Pilih Tanggal">
 <!--    <a class="absolute right-3 top-3.5 cursor-pointer" data-toggle>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
      </svg>
    </a> -->
    <a class="absolute right-3 top-3 cursor-pointer" data-clear>
      <svg v-show="modelValue.length > 0" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z"/>
      </svg>
    </a>
  </div>
</template>

<script>
  import flatpickr from "flatpickr";
  require("flatpickr/dist/themes/airbnb.css");
  import { Indonesian } from "flatpickr/dist/l10n/id.js"

  export default {
    name: 'RangeDate',
    props: {
      modelValue: {
        type: String,
        default: () => ''
      },
      class: {
        type: [String, Array, Object]
      },
      style: {
        type: [String, Array, Object]
      },
      placeholder: {
        type: String
      },
      disabled: {
        type: Boolean,
        default: () => false
      },
      maxOneMonth: {
        type: Boolean,
        default: () => false
      },
      minDate: {
        type: String,
        default: () => ''
      },
      maxDate: {
        type: String,
        default: () => ''
      },
    },
    mounted() {
      let checkMaxOne = this.maxOneMonth;
      this.$nextTick(() => {
        flatpickr(this.$refs.flatpickr, {
          mode: "range",
          wrap: true,
          locale: Indonesian,
          dateFormat: "Y-m-d",
          altInput: true,
          altFormat: "d F Y",
          minDate: this.minDate,
          maxDate: this.maxDate,
          onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates[0] && checkMaxOne) {
              instance.set('maxDate', selectedDates[0].fp_incr(30))
            }
          },
          onOpen: function(selectedDates, dateStr, instance) {
            instance.set('maxDate', null)
          },
        })
      })
    }
  }
</script>