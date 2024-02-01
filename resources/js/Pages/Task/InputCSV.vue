<script setup>
import { ref, watchEffect } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ShowTemporaryTask from "@/Pages/Task/Components/TemporaryTaskList.vue";

const { temporary_tasks } = defineProps(['temporary_tasks']);
const form = useForm({
    file: null,
    header: false,
});
const importSuccess = ref(false);
const handleSubmit = () => {
     form.post(route('temporary.store'));
}
</script>

<template>
    <div class="my-2">
        <form @submit.prevent="handleSubmit"
              name="csv_file"
              enctype="multipart/form-data"
              class="flex justify-between"
        >
            <div>
                <InputLabel for="file" value="File" />
                <input
                    id="file"
                    type="file"
                    class="mt-1 block w-full"
                    accept=".csv"
                    name="file_csv"
                    @input="form.file = $event.target.files[0]"
                />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
                <div v-if="form.progress && form.progress.percentage === 100">
                    Import Successfully
                </div>
                <div class="my-2">
                    <input type="checkbox" v-model="form.header"> Does this file have a header?
                    <span v-if="form.errors.header" class="text-red-600 my-1">{{ form.errors.header }}</span>
                </div>
            </div>
            <PrimaryButton class="hover:bg-gray-700" type="submit">
                <span class="mr-1">
                    import
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" />
                </svg>
            </PrimaryButton>
        </form>
        <Modal :show="importSuccess" :max-width="'sm'">
            <div class="m-2 h-24 flex flex-col justify-center items-center">
                <input type="checkbox" class="rounded-full h-20 w-20" :checked="true" disabled>
                <p class="font-bold ">Successful</p>
            </div>
        </Modal>
    </div>
</template>
