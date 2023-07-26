<template>
  <Head title="Profile" />

  <admin-layout>
    <template #breadcrumbs>
      <Breadcrumb :breadcrumbs="breadcrumbs" />
    </template>

    <template #page-title>
      <h2 class="text-dark-7 text-lg font-medium mr-auto">Profile</h2>
    </template>

    <div v-if="status" class="bg-green-400 text-white mt-6 my-6 p-4 rounded-md">
      <span>Profile berhasil disimpan.</span>
    </div>
    
    <form @submit.prevent="submit()">
      <div class="flex flex-col space-y-4">
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Nama Lengkap <span class="text-red-400">*</span></span>
            <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.nama_lengkap }" v-model="form.nama_lengkap" :disabled="form.processing">
            <span v-if="form.errors.nama_lengkap" class="text-red-400 italic">{{ form.errors.nama_lengkap }}</span>
          </div>
        </div>

        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Alamat Email <span class="text-red-400">*</span></span>
            <input type="email" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.email }" v-model="form.email" :disabled="form.processing">
            <span v-if="form.errors.email" class="text-red-400 italic">{{ form.errors.email }}</span>
          </div>
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Username <span class="text-red-400">*</span></span>
            <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.username }" v-model="form.username" :disabled="true">
            <span v-if="form.errors.username" class="text-red-400 italic">{{ form.errors.username }}</span>
          </div>
        </div>

        <!-- <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Tanggal Lahir <span class="text-red-400">*</span></span>
            <input-date :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.tanggal_lahir }" v-model="form.tanggal_lahir" :disabled="form.processing" />
            <span v-if="form.errors.tanggal_lahir" class="text-red-400 italic">{{ form.errors.tanggal_lahir }}</span>
          </div>
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Nomor HP <span class="text-red-400">*</span></span>
            <input-phone-number :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.nomor_hp }" v-model="form.nomor_hp" :disabled="form.processing" />
            <span v-if="form.errors.nomor_hp" class="text-red-400 italic">{{ form.errors.nomor_hp }}</span>
          </div>
        </div>

        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">NIK <span class="text-red-400">*</span></span>
            <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.nik }" v-model="form.nik" :disabled="form.processing">
            <span v-if="form.errors.nik" class="text-red-400 italic">{{ form.errors.nik }}</span>
          </div>
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">E-KTP </span>
            <preview-image :src="image_path" />
            <input type="file" accept="image/*" :class="{ 'rounded-md border border-black px-4 py-2 focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.ektp }" @change="onFileChange($event)" :disabled="form.processing">
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
              {{ form.progress.percentage }}%
            </progress>
            <span v-if="form.errors.ektp" class="text-red-400 italic">{{ form.errors.ektp }}</span>
          </div>
        </div> -->

        <div class="flex md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Alamat Lengkap <span class="text-red-400">*</span></span>
            <textarea rows="1" :class="{ 'w-full rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.alamat_lengkap }" v-model="form.alamat_lengkap" :disabled="form.processing" />
            <span v-if="form.errors.alamat_lengkap" class="text-red-400 italic">{{ form.errors.alamat_lengkap }}</span>
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
  import { ref, onMounted } from 'vue';
  import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
  import AdminLayout from '@/Layouts/AdminLayout.vue';
  import Breadcrumb from '@/Layouts/Breadcrumb.vue';
  import InputDate from '@/Components/Input/Date.vue';
  import InputPhoneNumber from '@/Components/Input/PhoneNumber.vue';
  import PreviewImage from '@/Components/Image/Preview.vue';

  export default {
    name: 'InformasiProfile',
    components: {
      Head,
      AdminLayout,
      Breadcrumb,
      InputDate,
      InputPhoneNumber,
      PreviewImage,
    },
    props: {
      breadcrumbs: {
        type: Array
      }
    },
    setup () {

      const status = ref(false)

      const form = useForm({
        nama_lengkap: '',
        tanggal_lahir: '',
        nomor_hp: '',
        username: '',
        email: '',
        nik: '',
        ektp: '',
        alamat_lengkap: '',
      })

      const image_path = ref('')

      onMounted(() => {
        form.nama_lengkap = usePage().props.value.currentUser.nama_lengkap
        form.tanggal_lahir = usePage().props.value.currentUser.tanggal_lahir
        form.nomor_hp = usePage().props.value.currentUser.nomor_hp
        form.username = usePage().props.value.currentUser.username
        form.email = usePage().props.value.currentUser.email
        form.nik = usePage().props.value.currentUser.nik
        form.ektp = ''
        image_path.value = usePage().props.value.currentUser.ektp_path
        form.alamat_lengkap = usePage().props.value.currentUser.alamat_lengkap
      })

      function submit() {
        form.transform((data) => ({
          ...data,
          ektp: form.ektp,
          _method: 'put',
        })).post(route('admin.profile.update'), {
          errorBag: 'updateProfileInformation',
          onSuccess: () => (status.value = true),
        })
      }

      function onFileChange(evt) {
          let files = evt.target.files || evt.dataTransfer.files;
          if (!files.length)
            return;
          form.ektp = files[0]
          image_path.value = URL.createObjectURL(files[0])
      }

      return {
        status,
        form,
        image_path,
        submit,
        onFileChange,
      }
    }
  }
</script>