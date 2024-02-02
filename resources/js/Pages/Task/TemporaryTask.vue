<script setup>
import { ref,onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TemporaryTaskList from "@/Pages/Task/Components/TemporaryTaskList.vue";
defineProps({
    temporary_tasks: {
        type: Object,
        required: true,
    },
});

const current = ref(false);

function onSubmit() {
    router.get(route('temporary.import'));
}
function allTemporaryTask() {
    router.patch(route('temporary.all_task'), {current: current.value});
    current.value = !current.value;
}
</script>

<template>
    <Head title="Temporary Task" />
    <AuthenticatedLayout>
    <template #header>
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Temporary Tasks</h2>
                <button @click.prevent="allTemporaryTask"
                        class="bg-blue-500 mt-4 text-white font-bold h-10 w-32 flex items-center justify-center rounded dark:hover:bg-blue-600"
                >
                    Select all Task
                </button>
            </div>
            <div class="flex">

                <button @click.prevent="onSubmit"
                        class="bg-blue-500 ml-2 text-white font-bold h-20 w-32 flex items-center justify-center rounded dark:hover:bg-blue-600"
                >
                    <span>
                        Import to Task
                    </span>
                </button>
            </div>
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
