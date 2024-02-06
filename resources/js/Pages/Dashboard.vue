<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import TasksList from "@/Pages/Task/Components/TasksList.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputCSV from "@/Pages/Task/InputCSV.vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps(['tasks']);
const tasks = ref(props.tasks);
const modal = ref(false);
function onShowModal() {
    return modal.value = !modal.value;
}
function onShowEmail() {
    router.get(route('email.index'));
}
</script>

<template>
    <Head title="Task" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Task</h2>
                <div class="flex gap-3">
                    <PrimaryButton @click.prevent="onShowEmail"
                                   class="bg-green-500 text-white font-bold h-10 w-28 flex items-center justify-center rounded dark:hover:bg-green-600"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-forward" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                            <path d="M3 6l9 6l9 -6" />
                            <path d="M15 18h6" />
                            <path d="M18 15l3 3l-3 3" />
                        </svg>
                    </PrimaryButton>
                    <PrimaryButton @click.prevent="onShowModal"
                          class="bg-blue-500 text-white font-bold h-10 w-28 flex items-center justify-center rounded dark:hover:bg-gray-700"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-type-csv" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                            <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                            <path d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                            <path d="M16 15l2 6l2 -6" />
                        </svg>
                    </PrimaryButton>
                    <Link :href="route('task.create')"
                          class="bg-blue-500 text-white font-bold h-10 w-28 flex items-center justify-center rounded dark:hover:bg-blue-600"
                    >
                        New Task
                    </Link>
                </div>
            </div>
        </template>

        <Modal :show="modal">
            <div class="p-3">
                <InputCSV>

                </InputCSV>
                <PrimaryButton @click="onShowModal" class="bg-red-700 hover:bg-red-600 w-full">
                    Close
                </PrimaryButton>
            </div>
        </Modal>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <TasksList :tasks="tasks">
                        <span class="inline-flex items-center rounded-full bg-gray-50 px-2 py-1 text-xs font-semibold text-gray-600 ring-1 ring-inset ring-gray-500/10">
                            You have no tasks!
                        </span>
                    </TasksList>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
