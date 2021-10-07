<template>
  <div class="relative">
    <div role="button" aria-expanded="false" @click="menu = ! menu">
      <slot />
    </div>
    <div v-show="menu" class="fixed inset-0 z-40" @click="menu = false"></div>
    <transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95">
      <div v-show="menu" class="absolute z-50" :class="class" @click="menu = false">
        <div class="shadow-lg w-full bg-dark-6 text-white">
          <div v-show="!hideNamecard" class="p-4 border-b border-dark-3 flex items-center">
            <img :src="'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' + $page.props.currentUser.nama_lengkap" :alt="$page.props.currentUser.nama_lengkap" class="rounded-full h-8 w-8 object-cover">
            <div class="ml-2">
              <div class="font-medium text-white">{{ $page.props.currentUser.nama_lengkap }}</div>
              <div class="text-xs mt-0.5 text-gray-500">{{ $page.props.currentUser.jabatan.nama_jabatan }}</div>
            </div>
          </div>
          <div class="p-2">
            <Link class="flex items-center block p-2 hover:bg-dark-3 rounded-md" :href="route('admin.profile.show')">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-2" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg> Profile
            </Link>
            <Link class="flex items-center block p-2 hover:bg-dark-3 rounded-md" :href="route('admin.profile.password')">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-2" viewBox="0 0 16 16">
                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"/>
              </svg> Ubah Password
            </Link>
          </div>
          <div class="p-2 border-t border-dark-3">
            <Link class="flex items-center block p-2 hover:bg-dark-3 rounded-md" :href="route('logout')">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
              </svg> Log out
            </Link>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
  import { ref } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3';

  export default {
    name: 'UserMenu',
    components: {
      Link
    },
    props: {
      class: [String, Array, Object],
      hideNamecard: {
        type: Boolean,
        default: () => false
      }
    },
    setup() {
      const menu = ref(false)

      return {
        menu
      }
    }
  }
</script>