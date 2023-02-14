<template>
  <div class="flex items-center text-gray-400 mr-auto">
    <div class="flex items-center text-gray-700 mr-auto">
      <Link :href="route('admin.dashboard.index')" class="flex items-center text-blue-700">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mx-1 text-blue-700" viewBox="0 0 16 16">
          <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-2 h-2 mx-1 text-blue-700" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
          <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
      </Link>
      <Link v-for="(breadcrumb, idx) in breadcrumbs" :href="breadcrumb.route" :class="{ 'flex items-center': true, 'text-blue-700': idx < (breadcrumbs.length - 1) }">
        <span>{{ breadcrumb.text }}</span>
        <svg v-if="idx < (breadcrumbs.length - 1)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-2 h-2 mx-1 text-blue-700" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
          <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
      </Link>
    </div>
  </div>
</template>

<script>
  import { Link } from '@inertiajs/inertia-vue3';

  export default {
    name: 'Breadcrumbs',
    components: {
      Link
    },
    props: {
      breadcrumbs: {
        type: Array,
        default: () => []
      }
    }
  }
</script>