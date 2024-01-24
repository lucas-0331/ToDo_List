<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import moment from "moment";

const props = defineProps({
    tasks: {
        type: Object,
        required: true,
    },
});
const task = ref(props.tasks);
const dateFormat = moment(task.value.date, 'DD/MM/YYYY').format('YYYY-MM-DD');
const form = useForm({
    name: task.value.name,
    description: task.value.description,
    status: task.value.status,
    date: dateFormat,
    image: task.value.image,
});
function onSubmit(idTask) {
    form.patch(route('task.update', idTask));
}
</script>

<template>
    <section>
        <h2 class="text-lg font-medium text-gray-900">Task Information</h2>

        <p class="mt-1 text-sm text-gray-600">
            Edit your task.
        </p>

        <form @submit.prevent="onSubmit(task.id)" class="mt-6 space-y-6">
            <div>
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
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
                <div class="flex">
                    <img :src="form.image" alt="" class="rounded-full h-16 w-16 mt-2 mr-3">

                    <input
                        id="image"
                        type="file"
                        class="mt-1 block w-full placeholder:italic placeholder:text-slate-400 self-end"
                        :src="form.image"
                    />
                </div>


                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

        </form>
    </section>
</template>
