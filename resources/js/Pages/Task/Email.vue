<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
const form = useForm({
    subject: 'Lorem Ipsum',
    message: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
});
function onSubmit() {
    form.post(route('email.send'));
}
</script>

<template>
    <Head title="Email" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Email</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900">Send Email</h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Information to Email.
                        </p>

                        <form @submit.prevent="onSubmit()" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="subject" value="Subject" />

                                <TextInput
                                    id="subject"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.subject"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.subject" />
                            </div>

                            <div>
                                <InputLabel for="message" value="Message" />

                                <textarea
                                    id="message"
                                    class="mt-1 border-slate-300 rounded block w-full"
                                    v-model="form.message"
                                    rows="8"
                                    maxlength="500"
                                    required
                                />
                                <div class="flex justify-end">
                                    <span v-if="form.message.length > 500" class="text-red-600">
                                        {{ form.message.length }} / 500
                                    </span>
                                    <span v-else>
                                        {{ form.message.length }} / 500
                                    </span>
                                </div>
                                <InputError class="mt-2" :message="form.errors.message" />
                            </div>

                            <PrimaryButton>
                                Send
                            </PrimaryButton>

                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
