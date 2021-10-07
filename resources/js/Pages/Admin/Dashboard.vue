<template>
  <Head title="Dashboard" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>
    <div class="pt-5">
      <span class="text-black font-bold text-base">Ringkasan Statistik</span>
      <div class="flex flex-col pt-5 md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2 box-content h-16 w-auto p-4 border-2 rounded-md">      
          <span>Total Customer</span>
          <div class="flex flex-row">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/><path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"/></svg>
            <span class="ml-2 text-black text-xl font-bold">{{ customer }}</span>
          </div>
        </div>

        <div class="flex-1 flex flex-col space-y-2 box-content h-16 w-auto p-4 border-2 rounded-md">      
          <span>Total Sales</span>
          <div class="flex flex-row">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span class="ml-2 text-black text-xl font-bold">{{ sales }}</span>
          </div>
        </div>

        <div class="flex-1 flex flex-col space-y-2 box-content h-16 w-auto p-4 border-2 rounded-md">      
          <span>Total Collector</span>
          <div class="flex flex-row">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span class="ml-2 text-black text-xl font-bold">{{ collector }}</span>
          </div>
        </div>

        <div class="flex-1 flex flex-col space-y-2 box-content h-16 w-auto p-4 border-2 rounded-md">      
          <span>Total Penjualan</span>
          <span class="text-black text-xl font-bold">Rp. {{ formatMoney(totalPenjualan) }}</span>
        </div>

        <div class="flex-1 flex flex-col space-y-2 box-content h-16 w-auto p-4 border-2 rounded-md">      
          <span>Total Pembayaran</span>
          <span class="text-black text-xl font-bold">Rp. {{ formatMoney(totalPembayaran) }}</span>
        </div>
      </div> 
    </div>
  </admin-layout>
</template>

<script>
    import { ref } from "vue";
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import Breadcrumb from '@/Layouts/Breadcrumb.vue';
    import DialogModal from '@/Components/Modal/DialogModal.vue';

    export default {
      name: 'TransaksiPenagihanIndex',
      components: {
        Head,
            Link,
            AdminLayout,
            Breadcrumb,
            DialogModal,
        },
      props: {
        breadcrumbs: {
          type: Array
        },
        customer: {
          type: Number
        },
        sales: {
          type: Number
        },
        collector: {
          type: Number
        },
        totalPenjualan: {
          type: Number
        },
        totalPembayaran: {
          type: Number
        }
      },
    }
</script>