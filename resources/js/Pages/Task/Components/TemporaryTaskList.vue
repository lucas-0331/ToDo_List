<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { temporary_tasks } = defineProps(['temporary_tasks']);
const modal = ref(false);
const taskId = ref();
const taskName = ref('');

const layoutGrid = [
    'grid-cols-[140px_180px_50px]',
    'md:grid-cols-[140px_240px_1fr_50px]',
    'grid-rows-[85px]',
    'md:grid-rows-[minmax(100px,_180px)]',
    'lg:grid-rows-[minmax(50px,_85px)]',
];

function onShowModal(idTemporaryTask, nameTemporaryTask) {
    taskId.value = idTemporaryTask;
    taskName.value = nameTemporaryTask;
    modal.value = !modal.value;
}
function deleteTemporaryTask() {
    router.delete(route('temporary.destroy', taskId.value));
    onShowModal(null, '');
}
</script>

<template>
    <div v-if="!temporary_tasks.data.length" class="p-6 text-gray-900">
        <slot>

        </slot>
    </div>
    <div v-else class="p-6 text-gray-900">

        <div v-for="task in temporary_tasks.data"
             :key="task.id"
             class="grid shrink-0 my-2 px-2 items-center justify-center border-b-2 first:border-t-2"
             :class="layoutGrid"
        >
            <p class="font-bold"
               :class="task.date"
            >
                {{ task.date }}
            </p>
            <h3 class="font-bold">
                {{ task.name }}
            </h3>
            <p class="hidden md:block font-light text-sm">
                {{ task.description }}
            </p>

            <div class="button-container grid grid-cols-3 justify-center items-center gap-2">
                <button @click.prevent="onShowModal(task.id, task.name)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#D32500" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <Modal :show="modal">
        <div class="text-center pt-2 font-bold">
            <p>
                Do you really want to delete task {{ taskName }}?
            </p>
        </div>
        <div class="flex justify-between p-3">
            <PrimaryButton
                class="bg-green-600"
                @click.prevent="deleteTemporaryTask"
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

</template>

<style scoped>

</style>
