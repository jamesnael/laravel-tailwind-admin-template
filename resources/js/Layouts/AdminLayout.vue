<template>
  <!-- BEGIN: Mobile Menu -->
  <div class="border-b border-dark-3 bg-dark-2 -mx-1 sm:-mx-8 mb-6 md:hidden">
      <div class="h-16 px-3 sm:px-8 flex items-center">
          <a href="" class="flex mr-auto">
              <logo-image class="w-6 h-6" />
          </a>
          <a href="javascript:;" @click.prevent="openMobileMenu = !openMobileMenu" class="mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-8 h-8 text-white" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
          </a>
          <user-menu
            class="mt-2 w-56 origin-top-right right-0" >
            <img :src="'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' + $page.props.currentUser.nama_lengkap" :alt="$page.props.currentUser.nama_lengkap" class="rounded-full h-8 w-8 object-cover">
          </user-menu>
      </div>
      <transition-slide :show="openMobileMenu">
        <main-menu class="border-t border-dark-3 py-5 px-5" />
      </transition-slide>
  </div>
  <!-- END: Mobile Menu -->
  <div class="flex min-h-screen-95">
      <!-- BEGIN: Side Menu -->
      <nav class="pr-5 h-full overflow-x-hidden hidden md:block flex-flex-col fixed bg-dark-3" style="width: 250px;">
        <div class="h-full flex flex-col">
          <a href="" class="flex items-center pl-5 pt-6">
            <logo-image class="w-6 h-6" />
            <span class="hidden xl:block text-white text-md ml-3">
              <span class="font-medium">Admin Panel</span>
            </span>
          </a>
          <div class="w-full h-px z-10 relative bg-dark-3 my-6"></div>
          <div class="overflow-y-auto pl-3" style="height: calc(103vh - 210px)">
            <main-menu />
          </div>
          <user-menu
            hide-namecard
            class="mt-2 w-full origin-top-right left-0 bottom-20" >
            <div class="py-2 pl-4 border-b border-dark-3 flex items-center">
              <img :src="'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' + $page.props.currentUser.nama_lengkap" :alt="$page.props.currentUser.nama_lengkap" class="rounded-full h-8 w-8 object-cover">
              <div class="ml-3">
                <div class="font-medium text-white">{{ $page.props.currentUser.nama_lengkap }}</div>
                <div class="text-xs mt-0.5 text-gray-400">{{ $page.props.currentUser.jabatan.nama_jabatan }}</div>
              </div>
            </div>
          </user-menu>
        </div>
      </nav>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="rounded-30px px-4 max-w-full shadow-md my-6 mr-2 md:mr-8 py-0 md:px-6 min-w-0 min-h-full flex-1 pb-10 bg-white ml-4 md:ml-72">
          <!-- BEGIN: Top Bar -->
          <div class="flex items-center relative border-b border-dark-3" style="height: 67px;">
              <!-- BEGIN: Breadcrumb -->
              <slot name="breadcrumbs">
                <breadcrumb />
              </slot>
              <!-- END: Breadcrumb -->
          </div>
          <!-- END: Top Bar -->
          <!-- BEGIN: Alert -->
          <div v-if="$page.props.flash.alertMessage" :class="{ 'bg-red-400':$page.props.flash.alertState === 'error', 'bg-blue-400':$page.props.flash.alertState === 'info', 'bg-yellow-400':$page.props.flash.alertState === 'warning', 'bg-green-400':$page.props.flash.alertState === 'success', 'text-white mt-6 p-4 rounded-md': true }">
            <span>{{ $page.props.flash.alertMessage }}</span>
          </div>
          <!-- END: Alert -->
          <!-- BEGIN: Page Title -->
          <div v-if="$slots['page-title']" class="flex items-center my-4">
            <slot name="page-title" />
          </div>
          <!-- END: Page Title -->
          <!-- BEGIN: Content -->
          <slot />
          <!-- END: Content -->
      </div>
      <!-- END: Content -->
  </div>
</template>

<script>
  import { ref } from "vue";
  import UserMenu from '@/Layouts/UserMenu.vue';
  import MainMenu from '@/Layouts/MainMenuContainer.vue';
  import LogoImage from '@/Layouts/LogoImage.vue';
  import Breadcrumb from "@/Layouts/Breadcrumb.vue";
  import TransitionSlide from "@/Transitions/Slide.vue";

  export default {
    name: 'AdminLayout',
    components: {
      UserMenu,
      MainMenu,
      LogoImage,
      TransitionSlide,
      Breadcrumb
    },
    setup() {
      const userMenu = ref(false);
      const openMobileMenu = ref(false);

      return {
        userMenu,
        openMobileMenu,
      }
    }
  }
</script>