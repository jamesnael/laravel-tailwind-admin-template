<template>
  <Head title="Ubah Password" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>

    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto">Ubah Password</h2>
    </template>
    
    <form @submit.prevent="submit()">
      <div class="flex flex-col space-y-4">
        <div class="flex md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Password Saat Ini <span class="text-red-400">*</span></span>
            <input-password :class="{ 'w-full rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.password_saat_ini }" v-model="form.password_saat_ini" :disabled="form.processing" />
            <span v-if="form.errors.password_saat_ini" class="text-red-400 italic">{{ form.errors.password_saat_ini }}</span>
          </div>
        </div>

        <div class="flex md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Password Baru <span class="text-red-400">*</span></span>
            <input-password :class="{ 'w-full rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.password }" v-model="form.password" :disabled="form.processing" />
            <span v-if="form.errors.password" class="text-red-400 italic">{{ form.errors.password }}</span>
          </div>
        </div>

        <div class="flex md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Konfirmasi Password Baru <span class="text-red-400">*</span></span>
            <input-password :class="{ 'w-full rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.password_confirmation }" v-model="form.password_confirmation" :disabled="form.processing" />
            <span v-if="form.errors.password_confirmation" class="text-red-400 italic">{{ form.errors.password_confirmation }}</span>
          </div>
        </div>

        <div class="flex flex-row justify-end space-x-4">
          <button type="button" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" @click.prevent="form.reset();form.clearErrors()" :disabled="form.processing">
            Ulang
          </button>
          <button type="submit" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:cursor-not-allowed" :disabled="form.processing">
            Simpan
          </button>
        </div>
      </div>
    </form>
  </admin-layout>
</template>

<script>
  import { Head, useForm } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';
  import InputPassword from '@/Components/Input/Password.vue';

  export default {
    name: 'UbahPassword',
    components: {
      Head,
      AdminLayout,
      Breadcrumb,
      InputPassword,
    },
    props: {
      breadcrumbs: {
        type: Array
      }
    },
    setup () {

      const form = useForm({
        password_saat_ini: '',
        password: '',
        password_confirmation: '',
      })

      function submit() {
        form.transform((data) => ({
          ...data,
          _method: 'put',
        })).post(route('admin.profile.password-update'), {
          errorBag: 'updatePassword',
          preserveScroll: true,
          onSuccess: () => form.reset(),
          onError: () => {
            if (form.errors.password) {
              form.reset('password', 'password_confirmation')
            }

            if (form.errors.password_saat_ini) {
              form.reset('password_saat_ini')
            }
          }
        })
      }

      return {
        form,
        submit,
      }
    }
  }
</script>