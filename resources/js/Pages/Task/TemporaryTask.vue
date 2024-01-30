<script setup>
import TemporaryTaskList from "@/Pages/Task/Components/TemporaryTaskList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
defineProps({
    temporary_tasks: {
        type: Object,
        required: true,
    },
    unique_task: {
        type: Object,
    },
});
function onSubmit() {
    router.get(route('temporary.import'));
}
</script>

<template>

    <AuthenticatedLayout>
        {{unique_task.data}}
    <template #header>
        <div class="flex w-full justify-end">
            <button @click.prevent="onSubmit"
                  class="bg-blue-500 text-white font-bold h-10 w-32 flex items-center justify-center rounded dark:hover:bg-blue-600"
            >
                Import to Task
            </button>
        </div>
    </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <TemporaryTaskList :temporary_tasks="temporary_tasks">
                        <span class="inline-flex items-center rounded-full bg-gray-50 px-2 py-1 text-xs font-semibold text-gray-600 ring-1 ring-inset ring-gray-500/10">
                            You have no tasks!
                        </span>
                    </TemporaryTaskList>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
