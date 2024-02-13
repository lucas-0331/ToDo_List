<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps(['task']);
const task = ref(props.task);
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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <h2 class="font-bold text-center text-2xl">
                        {{ task.name }}
                    </h2>
                    <p class="px-2 my-2">
                        <span class="font-bold">
                            Description:
                        </span>
                        {{ task.description }}
                    </p>
                    <div class="flex justify-between px-2">
                        <p>
                            <span class="font-bold">
                                Date:
                            </span>
                            {{ task.date }}
                        </p>
                        <div>
                            <span class="font-bold">
                                Task Status:
                            </span>
                            <input type="checkbox" :checked="task.status" disabled />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
