<script setup>
import {ref} from "vue";
import {Head, Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps(['task', 'status']);
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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2>{{ task.name }}</h2>
                    <p>{{ task.description }}</p>
                    <p>{{ task.date }}</p>
                    <p>{{ task.status }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
