<template>
  <div class="relative">
    <input type="text" :value="computedValue" class="absolute w-full pl-12 pointer-events-none" :class="class" :style="style" :readonly="readonly" :placeholder="placeholder" :disabled="disabled">
    <span class="w-4 h-4 absolute left-3 top-3 pointer-events-none">+62</span>
    <input type="text" @input="emitValue($event)" :value="modelValue" class="w-full pl-9" :class="class" :style="style" :readonly="readonly" :placeholder="placeholder" :disabled="disabled" :maxlength="15">
  </div>
</template>

<script>
  export default {
    name: 'InputPhoneNumber',
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
      readonly: {
        type: Boolean,
        default: () => false
      },
      disabled: {
        type: Boolean,
        default: () => false
      }
    },
    computed: {
      computedValue() {
        return _.replace(this.modelValue, '+62', '');
      }
    },
    methods: {
      emitValue(event) {
        if (event.target.value !== '+62') {
          this.$emit('update:modelValue', '+62' + _.replace(event.target.value, '+62', ''))
        } else {
          this.$emit('update:modelValue', '')
        }
      }
    }
  }
</script>