<script setup>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";

const form = useForm({
    name: '',
    description: '',
    status: false,
    date: '',
    image: '',
});
const modal = ref(false);

function onSubmit() {
    form.post(route('task.store'));
}
function onShowModal() {
    modal.value = !modal.value;
}
function onYesClick() {
    onSubmit();
    onShowModal();
}
</script>

<template>
    <section>
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

            <PrimaryButton @click.prevent="onShowModal">Save</PrimaryButton>

            <Modal :show="modal">
                <div class="text-center pt-2 font-bold">
                    <p>
                        Do you really want to create this new task?
                    </p>
                </div>
                <div class="flex justify-between p-3">
                    <PrimaryButton
                        class="bg-green-600"
                        @click="onYesClick"
                    >
                        Yes
                    </PrimaryButton>

                    <PrimaryButton
                        class="bg-red-700"
                        @click.prevent="onShowModal"
                    >
                        Cancel
                    </PrimaryButton>
                </div>
            </Modal>

        </form>
    </section>
</template>

<style scoped>

</style>
