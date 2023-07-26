<template>
  <Head title="Log Activity" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    
    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto">Log Activity</h2>
    </template>

    <datatables
      ref="datatables"
      class="pt-4"
      :route-uri="route('admin.log-activity.table')"
      :query="{ input_date: form.input_date }"
      v-model:columns="columns"
      table-class="w-full table-auto border-collapse text-black"
      thead-class="bg-white text-black border-b-2 border-black"
      search-class="border-b border-0 border-black bg-white text-black placeholder-gray-500 focus:outline-none focus:border-b focus:border-0 focus:ring-0"
      loader-type="bar"
      loading-bar-class="bg-indigo-500"
      disable-skeleton-loader
      disable-pagination-label
      disable-rows-per-page
      reload-button-class="focus:outline-none p-3 text-center shadow-md rounded-md font-semibold text-white bg-indigo-500 focus:ring-4 focus:ring-indigo-300"
      search-label="Cari Nama User"
    >
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
      </template>
      <template #before.reload-button>
        <input-date :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.month }" v-model="form.input_date" :disabled="form.processing" :clearable="false" @input="setRangeDate()" />
      </template>
      <template #grid.content.body.action="{ row }">
        <div class="flex flex-row justify-center space-x-4">
          <Link :href="route('admin.log-activity.detail', {log_activity: row.id})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
          </Link>
        </div>
      </template>
      <template #table.cell.content.action="{ row }">
        <div class="flex flex-row justify-center space-x-4">
          <Link :href="route('admin.log-activity.detail', {log_activity: row.id})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
          </Link>
        </div>
      </template>

    </datatables>
  </admin-layout>
</template>

<script>
  import { ref, watch, nextTick } from "vue";
  import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';
  import Datatables from '@/Components/Datatable/Datatables.vue';
  import DialogModal from '@/Components/Modal/DialogModal.vue';
  import RangeDate from '@/Components/Input/RangeDate.vue';
  import InputDate from '@/Components/Input/Date.vue';
  import SelectSearch from '@/Components/Select/SelectSearch.vue';

  export default {
    name: 'KomisiSalesIndex',
    components: {
      Head,
          Link,
          AdminLayout,
          Breadcrumb,
          Datatables,
          DialogModal,
          RangeDate,
          InputDate,
          SelectSearch
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
          uniqid: 'namaUser',
          label: 'User Name',
          field: (row) => row.causer.nama_lengkap ?? '-',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'namaJabatan',
          label: 'Group User',
          field: (row) => row.causer.jabatan.nama_jabatan ?? '-',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'aktivitas',
          label: 'Activity',
          field: 'description',
          sortable: false,
          sortOrder: 'asc',
          align: 'center',
          classes: 'px-4 py-2 md:py-4',
          headerClass: 'text-center p-4'
        },
        {
          uniqid: 'tanggal',
          label: 'Date',
          field: 'created_date',
          sortable: false,
          sortOrder: 'asc',
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
          classes: 'px-4 py-2 md:py-4 text-left md:text-center',
          headerClass: 'text-center p-4'
        }
      ]);

      const today = new Date();
      var month = '' + (today.getMonth() + 1),
          day = '' + today.getDate(),
          year = today.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

      const date = year + '-' + month + '-' + day;

      const form = useForm({
        input_date: date
      });

      const showModal = ref(false)

      // let input_date = ref('')

      // watch(form.input_date, () => {
      //   setRangeDate()
      // })

      async function setRangeDate() {
        // var date_value = form.input_date.value
        // date_value = date_value.split(' - ')
        // if (date_value.length == 2 || date_value[0] == '') {
            await nextTick()
            datatables.value.reload()
        // }
      }

      return {
          datatables,
          columns,
          form,
          showModal,
          setRangeDate,
      }
    }
  }
</script>