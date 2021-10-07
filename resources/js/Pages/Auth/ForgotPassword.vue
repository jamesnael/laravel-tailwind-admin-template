<template>
    <Head title="Forgot Password" />

    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>
        <template #title>
            <span class="font-extrabold">Reset Kata Sandi</span>
        </template>

        <!-- <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div> -->

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit" class="py-4">
            <div>
                <jet-label for="email" value="Alamat Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" placeholder="Masukkan alamat email terdaftar" v-model="form.email" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-5">
                <jet-button :class="{ 'opacity-25': form.processing, 'w-full justify-center bg-blue-500 hover:bg-blue-600 font-bold': true }" :disabled="form.processing">
                    Reset Kata Sandi
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { Head } from '@inertiajs/inertia-vue3';
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'

    export default {
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>
