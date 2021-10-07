<template>
  <div class="flex flex-col">
    <div class="relative">
      <input type="text" class="w-full pr-8" :class="class" :style="style" :value="selectLabel" readonly @focus="showOptions()" :placeholder="placeholder" :disabled="disabled">
      <svg v-show="clearable && modelValue.length > 0" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 absolute right-8 top-3.5 cursor-pointer" viewBox="0 0 16 16" @click="clear()">
        <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z"/>
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 absolute right-3 top-3.5 pointer-events-none" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
      </svg>
      <div v-show="show" class="fixed inset-0 z-40" @click="show = false"></div>
      <transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100"
        leave-active-class="transition ease-in duration-75"
        leave-from-class="transform opacity-100 scale-100"
        leave-to-class="transform opacity-0 scale-95">
        <div v-show="show" class="absolute w-full z-50 mt-2 shadow-lg origin-top border bg-white border-black rounded-md">
          <div v-if="!disableSearch" class="py-2 px-4">
            <div class="relative">
              <input type="text" v-model="search" placeholder="Pencarian" class="w-full pl-8 rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200">
              <svg class="w-4 h-4 absolute left-2.5 top-3.5 pointer-events-none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
          </div>
          <div v-show="dropdown.length === 0" class="py-2 px-4">Tidak ada data untuk ditampilkan.</div>
          <div v-show="dropdown.length > 0" class="flex flex-col max-h-40 overflow-y-auto">
            <span v-for="option in dropdown" class="hover:bg-blue-400 hover:text-white py-2 px-4 cursor-pointer" @click="select(option)">
              <slot name="option" :option="option">
                {{ option[label] }}
              </slot>
            </span>
          </div>
        </div>
      </transition> 
    </div>
  </div>
  <!--  -->
</template>

<script>
  import { ref, computed } from 'vue';

  export default {
    name: 'SelectSearch',
    props: {
      modelValue: {
        type: [String, Number]
      },
      class: {
        type: [String, Object, Array]
      },
      style: {
        type: [String, Object, Array]
      },
      label: {
        type: String,
        default: () => 'label'
      },
      disabled: {
        type: Boolean,
        default: () => false
      },
      placeholder: {
        type: String
      },
      disableSearch: {
        type: Boolean,
        default: () => false
      },
      clearable: {
        type: Boolean,
        default: () => false
      },
      options: {
        type: Array,
        default: () => []
      }
    },

    setup(props, { emit }) {
      const show = ref(false)

      const search = ref('')

      const dropdown = computed(() => {
        if (search.value) {
          return _.filter(props.options, opsi => { return _.includes(_.toLower(opsi[props.label]), _.toLower(search.value)) })
        }
        return props.options
      })

      const selectLabel = computed(() => {
        if (props.modelValue) {
          let obj = _.find(props.options, option => option.value == props.modelValue)
          return obj[props.label]
        }
        return ''
      })

      function showOptions() {
        search.value = ''
        show.value = true
      }

      function select(option) {
        emit('update:modelValue', _.toString(option.value))
        emit('change')
        show.value = false
      }

      function clear() {
        emit('update:modelValue', '')
      }

      return {
        showOptions,
        search,
        show,
        dropdown,
        select,
        clear,
        selectLabel,
      }
    }
  }
</script>