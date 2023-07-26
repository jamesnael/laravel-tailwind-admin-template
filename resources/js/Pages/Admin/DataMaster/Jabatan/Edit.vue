<template>
  <Head title="Group User" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto pb-5">Edit Group User</h2>
    </template>

    <jabatan-form
      http-method="put"
      :action-uri="route('admin.data-master.jabatan.update', [jabatan.slug])"
      :jabatan="jabatan"
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
      },
      jabatan: {
        type: Object,
        default: () => null
      }
    }
  }
</script>