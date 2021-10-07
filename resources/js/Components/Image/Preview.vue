<template>
  <img v-if="src" :src="src" class="w-40 h-auto cursor-pointer" @click="show = !show">
  
  <teleport to="body">
    <transition leave-active-class="duration-200">
      <div v-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" scroll-region>
        <transition enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0">
          <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
            <div class="absolute inset-0 bg-gray-500 opacity-50"></div>
          </div>
        </transition>

        <transition enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div class="min-h-full flex content-center items-center px-8">
            <img v-show="show" :src="src" class="overflow-y-auto transform transition-all max-w-full m-auto" @click="show = !show">
          </div>
        </transition>
      </div>
    </transition>
  </teleport>
</template>

<script>
  import { ref, onMounted, onUnmounted } from "vue";

  export default {
    name: 'PreviewImage',
    props: {
        src: {
          type: String,
          default: () => ''
        }
    },
    watch: {
      show: {
        immediate: true,
        handler: (show) => {
          if (show) {
            document.body.style.overflow = 'hidden'
          } else {
            document.body.style.overflow = null
          }
        }
      }
    },
    setup(props, {emit}) {
      const show = ref(false)

      const close = () => {
        show.value = false
      }
      const closeOnEscape = (e) => {
        if (e.key === 'Escape' && show.value) {
          close()
        }
      }

      onMounted(() => document.addEventListener('keydown', closeOnEscape))
      onUnmounted(() => {
        document.removeEventListener('keydown', closeOnEscape)
        document.body.style.overflow = null
      })

      return {
        show,
        close,
      }
    }
  }
</script>
