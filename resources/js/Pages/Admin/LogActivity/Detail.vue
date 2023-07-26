<template>
  <Head title="Log Activity - Detail" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto">Detail Log Activity {{ nama_user }}</h2>
    </template>

    <log-activity-form
      http-method="put"
      :log-activity="log_activity"
     />

  </admin-layout>
</template>

<script>
  import { Head, useForm } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';
  import LogActivityForm from '@/Pages/Admin/LogActivity/Form.vue';

  export default {
    name: 'LogActivityDetail',
    components: {
      Head,
      AdminLayout,
      Breadcrumb,
      LogActivityForm,
    },
    props: {
      breadcrumbs: {
        type: Array
      },
      nama_user: {
        type: String
      },
      log_activity: {
        type: Object,
        default: () => null
      }
    }
  }
</script>