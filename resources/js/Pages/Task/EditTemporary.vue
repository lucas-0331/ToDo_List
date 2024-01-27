<script setup>
import { ref } from "vue";
import { Head } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdateTemporaryTaskForm from "@/Pages/Task/Partials/UpdateTemporaryTaskForm.vue";

const props = defineProps(['task']);
const task = ref(props.task);
</script>

<template>
    <Head title="Edit CSV Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit CSV Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateTemporaryTaskForm
                        class="max-w-xl"
                        :tasks="task"/>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
