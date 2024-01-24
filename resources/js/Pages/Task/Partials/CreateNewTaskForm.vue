<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
const task = usePage().props.auth.task;

const form = useForm({
    name: '',
    description: '',
    status: false,
    date: '',
    image: '',
    // user_id: user.id,
});

function onSubmit() {
    form.post(route('task.store'))
}
</script>

<template>
    <section>
        <input type="text" v-model="user.id">
        <input type="text" v-model="user.name">
        <h2 class="text-lg font-medium text-gray-900">Task Information</h2>

        <p class="mt-1 text-sm text-gray-600">
            Create your new task.
        </p>

        <form @submit.prevent="onSubmit()" class="mt-6 space-y-6">
            <div>
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="title"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="description" value="Description" />

                <TextInput
                    id="description"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    required
                    autocomplete="description"
                />

                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div>
                <InputLabel for="date" value="Date" />

                <TextInput
                    id="date"
                    type="date"
                    class="mt-1 block w-full placeholder:italic placeholder:text-slate-400"
                    v-model="form.date"
                    required
                    autocomplete="date"
                />

                <InputError class="mt-2" :message="form.errors.date" />
            </div>

            <div>
                <InputLabel for="image" value="Image" />

                <input
                    id="image"
                    type="file"
                    class="mt-1 block w-full placeholder:italic placeholder:text-slate-400"
                    src=""
                />

                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>
            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

        </form>
    </section>
</template>

<style scoped>

</style>
