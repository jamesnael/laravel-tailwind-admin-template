<template>
  <div class="relative">
    <input :type="inputType" @input="$emit('update:modelValue', $event.target.value)" :value="modelValue" class="w-full pr-8" :class="class" :style="style" :placeholder="placeholder" :readonly="readonly" :disabled="disabled">
    <svg v-if="inputType === 'password'" @click="inputType = 'text'" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 absolute right-3 top-3.5 cursor-pointer" viewBox="0 0 16 16">
      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
    </svg>
    <svg v-else @click="inputType = 'password'" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 absolute right-3 top-3.5 cursor-pointer" viewBox="0 0 16 16">
      <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
      <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
    </svg>
  </div>
</template>

<script>
  import { ref } from 'vue';

  export default {
    name: 'InputPassword',
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
    setup() {
      const inputType = ref('password')

      return {
        inputType
      }
    }
  }
</script>