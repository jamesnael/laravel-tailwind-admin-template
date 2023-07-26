<template>
  <form @submit.prevent="submit()">
    <div class="flex flex-col space-y-4">
      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Page Name <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.page_name }" v-model="form.page_name" :disabled="form.processing" readonly>
          <span v-if="form.errors.page_name" class="text-red-400 italic">{{ form.errors.page_name }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Title <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.title }" v-model="form.title" :disabled="form.processing">
          <span v-if="form.errors.title" class="text-red-400 italic">{{ form.errors.title }}</span>
        </div>
      </div>

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Banner Image <span v-if="!banner" class="text-red-400">*</span></span>
          <preview-image :src="image_path" />
          <input type="file" accept="image/*" :class="{ 'rounded-md border border-black px-4 py-2 focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.banner_image }" @change="onFileChange($event)" :disabled="form.processing">
          <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
          </progress>
          <span v-if="form.errors.banner_image" class="text-red-400 italic">{{ form.errors.banner_image }}</span>
        </div>
      </div>

      <div class="flex md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Description</span>
          <textarea rows="5" :class="{ 'w-full rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.description }" v-model="form.description" :disabled="form.processing" />
          <span v-if="form.errors.description" class="text-red-400 italic">{{ form.errors.description }}</span>
        </div>

        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Sub Description</span>
          <textarea rows="5" :class="{ 'w-full rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.sub_description }" v-model="form.sub_description" :disabled="form.processing" />
          <span v-if="form.errors.sub_description" class="text-red-400 italic">{{ form.errors.sub_description }}</span>
        </div>
      </div>

      <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Button Title</span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.button_title }" v-model="form.button_title" :disabled="form.processing" readonly>
          <span v-if="form.errors.button_title" class="text-red-400 italic">{{ form.errors.button_title }}</span>
        </div>
        <div class="flex-1 flex flex-col space-y-2">
          <span class="text-black font-medium">Link Redirect</span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.link_redirect }" v-model="form.link_redirect" :disabled="form.processing">
          <span v-if="form.errors.link_redirect" class="text-red-400 italic">{{ form.errors.link_redirect }}</span>
        </div>
      </div>

      <div class="flex flex-row justify-end space-x-4">
        <Link class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:cursor-not-allowed" :href="route('admin.data-master.banner.index')" :disabled="form.processing">
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
      banner: {
        type: Object,
        default: () => null
      }
    },
    setup (props) {

      const form = useForm({
        page_name: '',
        title: '',
        banner_image: '',
        description: '',
        sub_description: '',
        button_title: '',
        link_redirect: '',
      })

      const image_path = ref('')

      onMounted(() => {
        if (props.banner) {
          form.page_name = props.banner.page_name
          form.title = props.banner.title
          form.banner_image = props.banner.banner_image
          form.description = props.banner.description
          form.sub_description = props.banner.sub_description
          form.button_title = props.banner.button_title
          form.link_redirect = props.banner.link_redirect

          image_path.value = props.banner.banner_image
        }
      })

      function submit() {
        form.transform((data) => ({
          ...data,
          banner_image: form.banner_image,
          _method: props.httpMethod,
        })).post(props.actionUri)
      }

      function onFileChange(evt) {
          let files = evt.target.files || evt.dataTransfer.files;
          if (!files.length)
            return;
          form.banner_image = files[0]
          image_path.value = URL.createObjectURL(files[0])
      }

      return {
        form,
        image_path,
        submit,
        onFileChange
      }
    }
  }
</script>