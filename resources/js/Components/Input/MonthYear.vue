<template>
  <div ref="flatpickr" class="relative">
    <input type="text" class="w-full pr-8 bg-transparent absolute pointer-events-none" :placeholder="placeholder" :class="class" :style="style" :disabled="disabled">
    <input type="text" class="w-full pr-8" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :class="class" :style="style" data-input :disabled="disabled">
  <!--   <a class="absolute right-3 top-3.5 cursor-pointer" data-toggle>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
      </svg>
    </a> -->
  </div>
</template>

<script>
  import flatpickr from "flatpickr";
  require("flatpickr/dist/themes/airbnb.css");
  require("flatpickr/dist/plugins/monthSelect/style.css");
  import { Indonesian } from "flatpickr/dist/l10n/id.js"
  import monthSelectPlugin from "flatpickr/dist/plugins/monthSelect"

  export default {
    name: 'MonthYear',
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
      }
    },
    mounted() {
      this.$nextTick(() => {
        flatpickr(this.$refs.flatpickr, {
          wrap: true,
          locale: Indonesian,
          altInput: true,
          plugins: [
                monthSelectPlugin({
                  shorthand: true, //defaults to false
                  dateFormat: "Y-m", //defaults to "F Y"
                  altFormat: "F Y", //defaults to "F Y"
                  theme: "light" // defaults to "light"
                })
            ]
        })
      })
    }
  }
</script>