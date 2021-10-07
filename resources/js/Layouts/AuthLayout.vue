<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
      <div class="flex flex-row w-full sm:max-w-md items-center justify-between">
        <Link href="/">
          <logo-image class="w-10 h-10" />
        </Link>
        <slot name="title">
          <span class="font-extrabold tracking-wide">Masuk ke Admin Panel</span>
        </slot>
      </div>

      <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <slot />
      </div>

      <small class="mt-5 tracking-wide">{{ new Date().getFullYear() }} &copy; James Nathanael. All Rights Reserved.</small>
  </div>
</template>

<script>
  import { Link } from '@inertiajs/inertia-vue3';
  import LogoImage from '@/Layouts/LogoImage.vue';

  export default {
    name: 'AuthLayout',
    components: {
      Link,
      LogoImage
    }
  }
</script>