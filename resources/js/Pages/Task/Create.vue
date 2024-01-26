<script setup>
    import { Head } from '@inertiajs/inertia-vue3';
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import CreateNewTaskForm from "@/Pages/Task/Partials/CreateNewTaskForm.vue";
</script>

<template>
    <Head title="Create Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <CreateNewTaskForm
                        class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
