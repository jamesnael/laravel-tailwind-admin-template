<template>
  <Head title="Group User" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto pb-5">Create Group User</h2>
    </template>

    <jabatan-form
      http-method="post"
      :action-uri="route('admin.data-master.jabatan.store')"
      :user-access="userAccess"
     />

  </admin-layout>
</template>

<script>
  import { Head, useForm } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';
  import JabatanForm from '@/Pages/Admin/DataMaster/Jabatan/Form.vue';

  export default {
    name: 'MasterJabatanCreate',
    components: {
      Head,
      AdminLayout,
      Breadcrumb,
      JabatanForm,
    },
    props: {
      breadcrumbs: {
        type: Array
      },
      userAccess: {
        type: Array,
        default: () => []
      }
    }
  }
</script>