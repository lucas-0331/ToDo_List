<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import TasksList from "@/Pages/Task/Components/TasksList.vue";

const props = defineProps(['tasks']);
const tasks = ref(props.tasks);
// const status = ref('');
</script>

<template>
    <Head title="Task" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Task</h2>
                <Link :href="route('task.create')" class="bg-blue-500 text-white font-bold h-10 w-28 flex items-center justify-center rounded dark:hover:bg-blue-600">New Task</Link>
            </div>
        </template>

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
