<template>
  <Head title="Log in" />

  <AuthLayout>
    <form @submit.prevent="submit()">
      <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
          <span class="text-black font-medium">Username / Email <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.email }" v-model="form.email" :disabled="form.processing">
          <span v-if="form.errors.email" class="text-red-400 italic">{{ form.errors.email }}</span>
        </div>
        <div class="flex flex-col space-y-2">
          <span class="text-black font-medium">Password <span class="text-red-400">*</span></span>
          <input-password :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-100': true, 'border-red-400': form.errors.password }" v-model="form.password" :disabled="form.processing" />
          <span v-if="form.errors.password" class="text-red-400 italic">{{ form.errors.password }}</span>
        </div>
        <div class="flex flex-col space-y-2">
          <label class="inline-flex items-center" for="remember">
            <input type="checkbox" id="remember" class="form-tick appearance-none h-5 w-5 border border-gray-500 rounded-md checked:bg-blue-600 checked:border-transparent focus:outline-none disabled:cursor-not-allowed disabled:bg-gray-100" v-model="form.remember" :disabled="form.processing">
            <span class="ml-2">Ingat Saya</span>
          </label>
          <span v-if="form.errors.remember" class="text-red-400 italic">{{ form.errors.remember }}</span>
        </div>
        <div class="flex flex-row items-center justify-end space-x-4">
          <Link :href="route('password.request')" class="underline text-sm text-black">
              Lupa kata sandi?
          </Link>
          <button type="submit" class="py-3 px-6 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:cursor-not-allowed" :disabled="form.processing">
            Masuk
          </button>
        </div>
      </div>
    </form>
  </AuthLayout>
</template>

<script>
  import AuthLayout from '@/Layouts/AuthLayout.vue';
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
    setup () {
      const form = useForm({
        email: '',
        password: '',
        remember: false,
      })

      function submit() {
        form.transform((data) => ({
          ...data,
          remember: form.remember ? 'on' : ''
        }))
        .post(route('login'))
      }

      return {
        form,
        submit,
      }
    }
  }
</script>
