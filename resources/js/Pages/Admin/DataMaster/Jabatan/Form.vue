<template>
  <form @submit.prevent="submit()">
    <div class="flex flex-col space-y-4">
      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Group User <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.nama_jabatan }" v-model="form.nama_jabatan" :disabled="form.processing">
          <span v-if="form.errors.nama_jabatan" class="text-red-400 italic">{{ form.errors.nama_jabatan }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">User Type <span class="text-red-400">*</span></span>
          <select-search
            clearable
            :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.tipe_user }"
            v-model="form.tipe_user"
            :disabled="form.processing"
            :options="tipeUser">
          </select-search>
          <span v-if="form.errors.tipe_user" class="text-red-400 italic">{{ form.errors.tipe_user }}</span>
        </div>
      </div>

      <div class="flex md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Description <span class="text-red-400">*</span></span>
          <textarea rows="1" :class="{ 'w-full rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.keterangan }" v-model="form.keterangan" :disabled="form.processing" />
          <span v-if="form.errors.keterangan" class="text-red-400 italic">{{ form.errors.keterangan }}</span>
        </div>
      </div>

      <div v-if="form.tipe_user === 'Backend User'">
        <div class="flex md:space-x-8">
          <div class="flex-1 flex flex-col space-y-2">
            <span class="text-black font-medium">Role Access</span>
            <button type="button" class="max-w-max py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300 disabled:cursor-not-allowed" @click.prevent="checkedAll()" :disabled="form.processing">Select All</button>
          </div>
        </div>

        <div v-for="module in userAccess" class="flex flex-col space-y-4">
          <span class="text-black font-medium mt-4">{{ module.module }}</span>
          <hr>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-x-4 gap-y-6 text-black">
            <div v-for="submodule in module.sub_module" class="flex flex-col space-y-2">
              <span class="font-medium">{{ submodule.module }}</span>
              <div class="flex flex-col space-y-2">
                <label v-for="activity in submodule.activities" class="inline-flex items-center" :for="activity.value">
                  <input type="checkbox" :id="activity.value" class="form-tick appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-600 checked:border-transparent focus:outline-none disabled:cursor-not-allowed disabled:bg-gray-100" :value="activity.value" v-model="form.hak_akses" :disabled="form.processing">
                  <span class="ml-2">{{ activity.label }}</span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-row justify-end space-x-4">
        <Link class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" :href="route('admin.data-master.jabatan.index')" :disabled="form.processing">
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
  import { ref, onMounted } from 'vue';
  import { useForm, Link } from '@inertiajs/inertia-vue3';
  import SelectSearch from '@/Components/Select/SelectSearch.vue';

  export default {
    name: 'MasterJabatanForm',
    components: {
      SelectSearch,
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
      jabatan: {
        type: Object,
        default: () => null
      },
      userAccess: {
        type: Array,
        default: () => []
      }
    },
    setup (props) {
      const tipeUser = ref([
        {
          label: 'Backend User',
          value: 'Backend User'
        }
      ]);

      const form = useForm({
        nama_jabatan: '',
        tipe_user: '',
        keterangan: '',
        hak_akses: [],
      })

      onMounted(() => {
        if (props.jabatan) {
          form.nama_jabatan = props.jabatan.nama_jabatan;
          form.tipe_user = props.jabatan.tipe_user;
          form.keterangan = props.jabatan.keterangan;
          form.hak_akses = props.jabatan.hak_akses ? props.jabatan.hak_akses : [];
        }
      })

      function submit() {
        form.transform((data) => ({
          ...data,
          _method: props.httpMethod,
        })).post(props.actionUri)
      }

      function checkedAll() {
        let hakAkses = []
        _.forEach(props.userAccess, access => {
          _.forEach(access.sub_module, submodule => {
            _.forEach(submodule.activities, activity => hakAkses.push(activity.value))
          })
        })
        form.hak_akses = hakAkses
      }

      return {
        tipeUser,
        form,
        submit,
        checkedAll,
      }
    }
  }
</script>