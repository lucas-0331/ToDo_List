<script setup>
import { ref, watchEffect } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import ShowTemporaryTask from "@/Pages/Task/Partials/ShowTemporaryTask.vue";

const form = useForm({
    file: null,
});
const importSuccess = ref(false);
const showTemporaryTask = ref(false);
const temporaryTask = ref([]);

const fetchTemporaryTasks = async () => {
    try {
        const response = await router.get(route('temporary.show'));
        temporaryTask.value = response.data;
        console.log(temporaryTask);
        showTemporaryTask.value = true;
    } catch (error) {
        console.error('Erro ao buscar os dados do servidor', error);
    }
}
const handleSubmit = () => {
     form.post(route('temporary.store'));
}
watchEffect(() => {
    if (form.progress && form.progress.percentage === 100) {
        importSuccess.value = true;
        setTimeout(() => {
            importSuccess.value = false;
        }, 3000);
        fetchTemporaryTasks();
    }
});
</script>

<template>
    <div class="my-2" v-show="!showTemporaryTask">
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
                    required
                />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
                <div v-if="form.progress && form.progress.percentage === 100">
                    Import Successfully
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
        <Modal :show="importSuccess" :max-width="'sm'" title="Import Successful">
            <div class="m-2 h-24 flex flex-col justify-center items-center">
                <input type="checkbox" class="rounded-full h-20 w-20" :checked="true" disabled>
                <p class="font-bold ">Successful</p>
            </div>
        </Modal>
        <ShowTemporaryTask v-show="showTemporaryTask">
            <h1>{{temporaryTask}}</h1>
        </ShowTemporaryTask>
    </div>
</template>
