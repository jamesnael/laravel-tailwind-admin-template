<template>
  <transition
    enter-active-class="transition duration-300"
    :enter-from-class="'transform opacity-100 rotate-' + from"
    :enter-to-class="'transform opacity-100 -rotate-' + to"
    leave-active-class="transition duration-300"
    :leave-from-class="'transform opacity-100 -rotate-' + to"
    :leave-to-class="'transform opacity-100 -rotate-' + from">
    <div v-show="show">
      <slot />
    </div>
  </transition>
</template>

<script>
  import { onMounted, ref } from "vue";

  export default {
    name: 'TransitionsRotate',
    props: {
      from: {
        type: String,
        default: () => "0"
      },
      to: {
        type: String,
        default: () => "180"
      }
    },
    setup() {
      const show = ref(false)

      onMounted(() => { show.value = true })

      return {
        show
      }
    }
  }
</script>