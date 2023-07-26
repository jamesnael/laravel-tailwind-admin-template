<template>
  <form @submit.prevent="submit()">
    <div class="flex flex-col space-y-4">
      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Full Name <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.nama_lengkap }" v-model="form.nama_lengkap" :disabled="form.processing">
          <span v-if="form.errors.nama_lengkap" class="text-red-400 italic">{{ form.errors.nama_lengkap }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Group User <span class="text-red-400">*</span></span>
          <select-search
            clearable
            :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.jabatan_id }"
            v-model="form.jabatan_id"
            :disabled="form.processing"
            :options="jabatan">
          </select-search>
          <span v-if="form.errors.jabatan_id" class="text-red-400 italic">{{ form.errors.jabatan_id }}</span>
          <input type="hidden" v-model="showJabatanLabel">
        </div>
      </div>

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Email Address <span class="text-red-400">*</span></span>
          <input type="email" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.email }" v-model="form.email" :disabled="form.processing">
          <span v-if="form.errors.email" class="text-red-400 italic">{{ form.errors.email }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Username <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.username }" v-model="form.username" :disabled="form.processing">
          <span v-if="form.errors.username" class="text-red-400 italic">{{ form.errors.username }}</span>
        </div>
      </div>

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Password <span v-if="!karyawan" class="text-red-400">*</span></span>
          <input-password :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.password }" v-model="form.password" :disabled="form.processing" />
          <span v-if="karyawan" class="text-black italic text-xs">Biarkan kosong jika tidak ingin merubah password user.</span>
          <span v-if="form.errors.password" class="text-red-400 italic">{{ form.errors.password }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Password Confirmation <span v-if="!karyawan" class="text-red-400">*</span></span>
          <input-password :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.password_confirmation }" v-model="form.password_confirmation" :disabled="form.processing" />
          <span v-if="karyawan" class="text-black italic text-xs">Biarkan kosong jika tidak ingin merubah password user.</span>
          <span v-if="form.errors.password_confirmation" class="text-red-400 italic">{{ form.errors.password_confirmation }}</span>
        </div>
      </div>

      <!-- <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Tanggal Lahir <span class="text-red-400">*</span></span>
          <input-date :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.tanggal_lahir }" v-model="form.tanggal_lahir" :disabled="form.processing" />
          <span v-if="form.errors.tanggal_lahir" class="text-red-400 italic">{{ form.errors.tanggal_lahir }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Nomor HP <span class="text-red-400">*</span></span>
          <input-phone-number :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.nomor_hp }" v-model="form.nomor_hp" :disabled="form.processing" />
          <span v-if="form.errors.nomor_hp" class="text-red-400 italic">{{ form.errors.nomor_hp }}</span>
        </div>
      </div>

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">NIK <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.nik }" v-model="form.nik" maxlength="16" :disabled="form.processing">
          <span v-if="form.errors.nik" class="text-red-400 italic">{{ form.errors.nik }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">E-KTP <span v-if="!karyawan" class="text-red-400">*</span></span>
          <preview-image :src="image_path" />
          <input type="file" accept="image/*" :class="{ 'rounded-md border border-black px-4 py-2 focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.ektp }" @change="onFileChange($event)" :disabled="form.processing">
          <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
          </progress>
          <span v-if="form.errors.ektp" class="text-red-400 italic">{{ form.errors.ektp }}</span>
        </div>
      </div>

      <div class="flex md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Alamat Lengkap <span class="text-red-400">*</span></span>
          <textarea rows="1" :class="{ 'w-full rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.alamat_lengkap }" v-model="form.alamat_lengkap" :disabled="form.processing" />
          <span v-if="form.errors.alamat_lengkap" class="text-red-400 italic">{{ form.errors.alamat_lengkap }}</span>
        </div>
      </div> -->

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Status <span class="text-red-400">*</span></span>
          <select-search
            clearable
            disable-search
            :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.status }"
            v-model="form.status"
            :disabled="form.processing"
            :options="statusOptions">
          </select-search>
          <span v-if="form.errors.status" class="text-red-400 italic">{{ form.errors.status }}</span>
        </div>
        <div class="flex-1"></div>
      </div>

      <div class="flex flex-row justify-end space-x-4">
        <Link class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" :href="route('admin.data-master.karyawan.index')" :disabled="form.processing">
          Back
        </Link>
        <button type="submit" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:cursor-not-allowed" :disabled="form.processing">
          Save
        </button>
      </div>
    </div>
  </form>
</template>

<script>
  import { ref, onMounted, computed } from 'vue';
  import { useForm, Link } from '@inertiajs/inertia-vue3';
  import SelectSearch from '@/Components/Select/SelectSearch.vue';
  import InputPassword from '@/Components/Input/Password.vue';
  import InputDate from '@/Components/Input/Date.vue';
  import InputPhoneNumber from '@/Components/Input/PhoneNumber.vue';
  import PreviewImage from '@/Components/Image/Preview.vue';

  export default {
    name: 'MasterKaryawanForm',
    components: {
      SelectSearch,
      InputPassword,
      InputDate,
      InputPhoneNumber,
      PreviewImage,
      Link
    },
    props: {
      httpMethod: {
        type: String,
        default: () => 'post',
        validator(value) {
          return ['get', 'post', 'put', 'patch', 'delete'].includes(value);
        }
      },
      actionUri: {
        type: String,
        default: () => ''
      },
      karyawan: {
        type: Object,
        default: () => null
      },
      jabatan: {
        type: Array,
        default: () => []
      }
    },
    setup (props) {
      const statusOptions = ref([
        {
          label: 'Aktif',
          value: '1'
        },
        {
          label: 'Tidak Aktif',
          value: '0'
        }
      ]);

      const form = useForm({
        nama_lengkap: '',
        tanggal_lahir: '',
        nomor_hp: '',
        username: '',
        email: '',
        password: '',
        password_confirmation: '',
        nik: '',
        ektp: '',
        alamat_lengkap: '',
        jabatan_id: '',
        status: '',
      })

      const image_path = ref('')

      onMounted(() => {
        if (props.karyawan) {
          form.nama_lengkap = props.karyawan.nama_lengkap
          form.tanggal_lahir = props.karyawan.tanggal_lahir
          form.nomor_hp = props.karyawan.nomor_hp
          form.username = props.karyawan.username
          form.email = props.karyawan.email
          form.password = ''
          form.password_confirmation = ''
          form.nik = props.karyawan.nik
          form.ektp = ''
          image_path.value = props.karyawan.ektp_path
          form.alamat_lengkap = props.karyawan.alamat_lengkap
          form.jabatan_id = _.toString(props.karyawan.jabatan_id)
          form.status = props.karyawan.status ? '1' : '0'
        }
      })

      const showJabatanLabel = computed(() => {
          if (form.jabatan_id) {
              let data = _.filter(props.jabatan, jabatan => jabatan.value == form.jabatan_id);
              return data[0].tipe_user;
          }
      })

      function submit() {
        form.transform((data) => ({
          ...data,
          ektp: form.ektp,
          _method: props.httpMethod,
        })).post(props.actionUri)
      }

      function onFileChange(evt) {
          let files = evt.target.files || evt.dataTransfer.files;
          if (!files.length)
            return;
          form.ektp = files[0]
          image_path.value = URL.createObjectURL(files[0])
      }

      return {
        statusOptions,
        form,
        image_path,
        submit,
        onFileChange,
        showJabatanLabel
      }
    }
  }
</script>