<template>
  <Head title="Group User" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto">Master Group User</h2>
    </template>

    <datatables
      ref="datatables"
      class="pt-4"
      :route-uri="route('admin.data-master.jabatan.table')"
      v-model:columns="columns"
      table-class="w-full table-auto border-collapse text-black"
      thead-class="bg-white text-black border-b-2 border-black"
      search-class="border-b border-0 border-black bg-white text-black placeholder-gray-500 focus:outline-none focus:border-b focus:border-0 focus:ring-0"
      loader-type="bar"
      loading-bar-class="bg-blue-600"
      disable-skeleton-loader
      disable-pagination-label
      disable-rows-per-page
      reload-button-class="focus:outline-none p-3 text-center shadow-md rounded-md font-semibold text-white bg-blue-600 focus:ring-4 focus:ring-blue-300"
      search-label="Cari Group User" >
      <template #label.no-record>
        <div class="py-2">Tidak ada data untuk ditampilkan.</div>
      </template>
      <template #label.no-result>
        <div class="py-2">Tidak ada data yang sesuai dengan kriteria pencarian.</div>
      </template>
      <template #icon.search>
        <svg class="w-4 h-4 absolute left-2.5 top-3.5 pointer-events-none text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </template>
      <template #label.reload-button>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current" viewBox="0 0 16 16">
          <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
          <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
        </svg>
      </template>
      <template #after.reload-button>
        <Link v-if="hasAccess('module.data-master.jabatan.create', $page.props.currentUser.jabatan.hak_akses)" :href="route('admin.data-master.jabatan.create')" class="p-3 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300">
          <div class="flex content-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 md:w-3 md:h-3 stroke-current" viewBox="0 0 16 16">
              <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
            </svg>
            <span class="hidden md:inline-flex ml-2">Create Group User</span>
          </div>
        </Link>
      </template>
      <template #grid.content.body.action="{ row }">
        <div class="flex flex-row justify-center space-x-4">
          <Link v-if="hasAccess('module.data-master.jabatan.edit', $page.props.currentUser.jabatan.hak_akses)" :href="route('admin.data-master.jabatan.edit', {jabatan: row.slug})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current text-blue-600" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
          </Link>
          <button v-if="hasAccess('module.data-master.jabatan.delete', $page.props.currentUser.jabatan.hak_akses)" type="button" class="appearance-none outline-none focus:border-transparent focus:outline-none bg-transparent" @click.prevent="confirmDeleteRow(row)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current text-red-600" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
          </button>
        </div>
      </template>
      <template #table.cell.content.action="{ row }">
        <div class="flex flex-row justify-center space-x-4">
          <Link v-if="hasAccess('module.data-master.jabatan.edit', $page.props.currentUser.jabatan.hak_akses)" :href="route('admin.data-master.jabatan.edit', {jabatan: row.slug})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current text-blue-600" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
          </Link>
          <button v-if="hasAccess('module.data-master.jabatan.delete', $page.props.currentUser.jabatan.hak_akses)" type="button" class="appearance-none outline-none focus:border-transparent focus:outline-none bg-transparent" @click.prevent="confirmDeleteRow(row)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 stroke-current text-red-600" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
          </button>
        </div>
      </template>
    </datatables>

    <dialog-modal :show="showModal" @close="showModal = false">
      <div class="flex flex-col space-y-6 p-10 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" class="w-20 h-20 fill-current text-yellow-500">
          <path d="M70.335 30.683c-1.569-2.719-3.878-4.278-6.337-4.278s-4.764 1.556-6.333 4.274l-34.6 59.94c-1.569 2.719-1.765 5.5-.536 7.628s3.734 3.348 6.871 3.348h69.2c3.138 0 5.643-1.22 6.871-3.348s1.035-4.907-.534-7.624zm31.484 65.452c-.456.785-1.627 1.237-3.216 1.237H29.4c-1.589 0-2.76-.452-3.214-1.237s-.26-2.029.536-3.406l34.6-59.94c.794-1.375 1.769-2.163 2.676-2.163s1.886.79 2.68 2.167l34.6 59.939c.798 1.377.994 2.616.541 3.403z"/>
          <path d="M64 78.144a2.11 2.11 0 0 0 2.111-2.111V48.24a2.111 2.111 0 0 0-4.222 0v27.793A2.11 2.11 0 0 0 64 78.144z"/>
          <circle cx="64" cy="86.506" r="3.734"/>
        </svg>
        <p class="text-center md:text-lg">
          Apakah Anda yakin untuk menghapus Karyawan ini? Karyawan yang telah dihapus tidak dapat dikembalikan.
        </p>
        <div class="w-full pt-5">
          <div class="flex flex-row justify-center space-x-4">
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" @click.prevent="showModal = false" :disabled="form.processing">
              Batal
            </button>
            <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:cursor-not-allowed" @click.prevent="deleteRow()" :disabled="form.processing">
              Hapus
            </button>
          </div>
        </div>
      </div>
    </dialog-modal>
  </admin-layout>
</template>

<script>
  import { ref } from "vue";
  import { Head, Link, usePage, useForm } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';
  import Datatables from '@/Components/Datatable/Datatables.vue';
  import DialogModal from '@/Components/Modal/DialogModal.vue';

  export default {
    name: 'MasterJabatanIndex',
    components: {
      Head,
      Link,
      AdminLayout,
      Breadcrumb,
      Datatables,
      DialogModal,
    },
    props: {
      breadcrumbs: {
        type: Array
      }
    },
    setup() {
      const datatables = ref(null);

      const columns = ref([
        {
          uniqid: 'rowIndex',
          label: '#',
          field: 'rowIndex',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-center md:text-center',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'namaJabatan',
          label: 'Group User',
          field: 'nama_jabatan',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'tipeUser',
          label: 'User Type',
          field: 'tipe_user',
          sortable: false,
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'keterangan',
          label: 'Description',
          field: 'keterangan',
          sortable: false,
          align: 'center',
          classes: 'px-4 py-2 md:py-4',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'action',
          label: 'Action',
          field: 'id',
          sortable: false,
          align: 'center',
          classes: 'px-4 py-2 md:py-4 text-center',
          headerClass: 'text-center p-4'
        }
      ]);

      const form = useForm({})

      const showModal = ref(false)

      function confirmDeleteRow(row) {
        form.value = row
        showModal.value = true
      }

      function deleteRow() {
        form.delete(route('admin.data-master.jabatan.destroy', { jabatan: form.value.slug }), {
          onSuccess: () => {
            form.reset()
            showModal.value = false
            datatables.value.getData()
          }
        });
      }

      return {
        datatables,
        columns,
        form,
        showModal,
        confirmDeleteRow,
        deleteRow
      }
    }
  }
</script>