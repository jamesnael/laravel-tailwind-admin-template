<template>
  <Head title="Lupa Password" />

  <AuthLayout>
    <template #title>
      <span class="font-extrabold tracking-wide">Lupa Password</span>
    </template>
    
    <div v-if="status" class="bg-green-400 mt-6 my-6 p-4 rounded-md">
      <span>{{ status }}</span>
    </div>

    <form @submit.prevent="submit()">
      <div class="flex flex-col space-y-4">
        <div class="flex flex-col space-y-2">
          <span class="text-black font-medium">Alamat Email <span class="text-red-400">*</span></span>
          <input type="text" :class="{ 'rounded-md focus:ring-1 ring-indigo-500 placeholder-gray-500 text-black disabled:cursor-not-allowed disabled:bg-gray-200': true, 'border-red-400': form.errors.email }" v-model="form.email" :disabled="form.processing">
          <span v-if="form.errors.email" class="text-red-400 italic">{{ form.errors.email }}</span>
        </div>
        <div class="flex flex-col">
          <div class="flex flex-row items-center justify-end space-x-4">
            <Link :href="route('login')" class="underline text-sm text-black">
                Ingat kata sandi?
            </Link>
          </div>
          <button type="submit" class="w-full py-3 px-6 mt-4 text-center shadow-md rounded-md font-semibold text-white bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:cursor-not-allowed" :disabled="form.processing">
            KIRIM EMAIL RESET PASSWORD
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

  export default {
    name: 'ForgotPasswordForm',
    components: {
      AuthLayout,
      Link,
      Head,
    },
    props: {
      status: String
    },
    setup () {
      const form = useForm({
        email: '',
      })

      function submit() {
        form.post(route('password.email'), {
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
