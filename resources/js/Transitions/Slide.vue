<template>
  <transition
    enter-active-class="transition-all ease-in-out duration-500"
    enter-from-class="transform overflow-hidden max-h-0"
    enter-to-class="transform overflow-hidden max-h-screen"
    leave-active-class="transition-all ease-in-out duration-500"
    leave-from-class="transform overflow-hidden max-h-screen"
    leave-to-class="transform overflow-hidden max-h-0">
    <div v-show="show">
      <slot />
    </div>
  </transition>
</template>

<script>
  export default {
    name: 'TransitionsSlide',
    props: {
      show: {
        type: Boolean,
        default: () => false
      }
    }
  }
</script>
