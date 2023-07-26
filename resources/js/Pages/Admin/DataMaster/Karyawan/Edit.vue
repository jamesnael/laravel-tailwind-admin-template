<template>
  <Head title="User" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto pb-5">Edit User</h2>
    </template>

    <karyawan-form
      http-method="put"
      :action-uri="route('admin.data-master.karyawan.update', [karyawan.slug])"
      :karyawan="karyawan"
      :jabatan="jabatan"
     />

  </admin-layout>
</template>

<script>
  import { Head, useForm } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';
  import KaryawanForm from '@/Pages/Admin/DataMaster/Karyawan/Form.vue';

  export default {
    name: 'MasterKaryawanCreate',
    components: {
      Head,
      AdminLayout,
      Breadcrumb,
      KaryawanForm,
    },
    props: {
      breadcrumbs: {
        type: Array
      },
      jabatan: {
        type: Array,
        default: () => []
      },
      karyawan: {
        type: Object,
        default: () => null
      }
    }
  }
</script>