<template>
  <Head title="Karyawan" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto">Tambah Karyawan</h2>
    </template>

    <karyawan-form
      http-method="post"
      :action-uri="route('admin.data-master.karyawan.store')"
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
      }
    }
  }
</script>