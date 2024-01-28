<script setup>
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {router, useForm} from "@inertiajs/vue3";

const { temporary_tasks } = defineProps(['temporary_tasks']);

const tasks = ref({});
const modal = ref(false);
const update = ref(false);

const layoutGrid = [
    'grid-cols-[140px_180px_100px_100px]',
    'md:grid-cols-[140px_240px_1fr_100px_100px]',
    'grid-rows-[85px]',
    'md:grid-rows-[minmax(100px,_180px)]',
    'lg:grid-rows-[minmax(50px,_85px)]',
];

function onShowModal() {
    modal.value = true;
}
const editTemporaryTask = (idTemporaryTask) => {
    if(idTemporaryTask) {
        router.get(route('temporary.edit', idTemporaryTask));
    }
}
function deleteTemporaryTask(idTemporaryTask) {
    router.delete(route('temporary.destroy', idTemporaryTask));
}
</script>

<template>
    <div v-if="!temporary_tasks.length" class="p-6 text-gray-900">
        <slot>

        </slot>
    </div>

    <div v-else class="p-6 text-gray-900">
        <div v-for="task in temporary_tasks"
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
            <input type="checkbox"
                   :checked="task.status"
                   v-model="task.status"
                   class="justify-self-center size-8 rounded-full cursor-pointer"
                   @click="newStatus(task.id, task.status)"
            >

            <div class="button-container grid grid-cols-3 justify-center items-center gap-2">

                <button @click="editTemporaryTask(task.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0093FF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                    </svg>
                </button>
                <button @click.prevent="onShowModal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#D32500" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>
                </button>

                <Modal :show="modal">
                    <div class="text-center pt-2 font-bold">
                        <p>
                            Do you really want to delete this task?
                        </p>
                    </div>
                    <div class="flex justify-between p-3">
                        <PrimaryButton
                            class="bg-green-600"
                            @click.prevent="deleteTemporaryTask(task.id)"
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

            </div>
        </div>
    </div>
</template>

<style scoped>

</style>