<template>
  <div class="relative">
    <input type="text" :value="modelValue ? formatMoney(modelValue) : ''" class="absolute w-full pl-9 pr-8 pointer-events-none" :class="class" :style="style" :readonly="readonly" :placeholder="placeholder" :disabled="disabled">
    <span class="w-4 h-4 absolute left-3 top-3 pointer-events-none">Rp</span>
    <a v-if="clearable && modelValue" class="absolute right-3 top-3.5 cursor-pointer" @click.prevent="clear()">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z"/>
      </svg>
    </a>
    <input type="text" @input="$emit('update:modelValue', $event.target.value)" :value="modelValue" class="w-full pl-9" :class="class" :style="style" :readonly="readonly" :placeholder="placeholder" :disabled="disabled">
  </div>
</template>

<script>
  export default {
    name: 'InputMoney',
    props: {
      modelValue: {
        type: [String, Number],
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
      },
      clearable: {
        type: Boolean,
        default: () => false
      }
    },
    methods: {
      clear() {
        this.$emit('update:modelValue', '')
      }
    }
  }
</script>