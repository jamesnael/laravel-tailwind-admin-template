<template>
  <Head title="Reset Password" />

  <AuthLayout>
    <form @submit.prevent="submit()">
      <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
          <span class="text-black font-medium">Alamat Email <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.email }" v-model="form.email" :disabled="form.processing">
          <span v-if="form.errors.email" class="text-red-400 italic">{{ form.errors.email }}</span>
        </div>
        <div class="flex flex-col space-y-2">
          <span class="text-black font-medium">Password <span class="text-red-400">*</span></span>
          <input-password :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.password }" v-model="form.password" :disabled="form.processing" />
          <span v-if="form.errors.password" class="text-red-400 italic">{{ form.errors.password }}</span>
        </div>
        <div class="flex flex-col space-y-2">
          <span class="text-black font-medium">Konfirmasi Password <span class="text-red-400">*</span></span>
          <input-password :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.password_confirmation }" v-model="form.password_confirmation" :disabled="form.processing" />
          <span v-if="form.errors.password_confirmation" class="text-red-400 italic">{{ form.errors.password_confirmation }}</span>
        </div>
        <div class="flex flex-col">
          <button type="submit" class="w-full py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:cursor-not-allowed" :disabled="form.processing">
            RESET PASSWORD
          </button>
        </div>
      </div>
    </form>
  </AuthLayout>
</template>

<script>
  import AuthLayout from '@/Layouts/AuthLayout.vue';
  import { Inertia } from '@inertiajs/inertia';
  import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
  import InputPassword from '@/Components/Input/Password.vue';

  export default {
    name: 'LoginForm',
    components: {
      AuthLayout,
      Head,
      Link,
      InputPassword,
    },
    props: {
      email: String,
      token: String
    },
    setup (props) {
      const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
      })

      function submit() {
        form
        .post(route('password.update'), {
          onFinish: () => {
            form.reset()
            setTimeout(() => {
              Inertia.visit('/')
            }, 3000)
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
