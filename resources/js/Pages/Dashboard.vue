<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import {computed, ref} from 'vue';
import DropdownLink from "@/Components/DropdownLink.vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps(['tasks']);
const tasks = ref(props.tasks);
const noTask = 'No tasks at the moment';
const status = ref('');
const checkDate = (date) => {
    const currentDate = new Date();
    const inputDate = new Date(date);

    currentDate.setHours(0, 0, 0, 0);
    inputDate.setHours(0, 0, 0, 0);

    if (inputDate < currentDate) {
        return 'text-red-500';
    } else if (inputDate > currentDate) {
        return 'text-green-600';
    } else {
        return 'text-yellow-500';
    }
}
const layoutGrid = [
    'grid-cols-[100px_100px_100px_100px_100px]',
    'md:grid-cols-[100px_100px_180px_1fr_100px_100px]',
    'grid-rows-[85px]',
    'md:grid-rows-[minmax(100px,_180px)]',
    'lg:grid-rows-[minmax(50px,_85px)]',
]
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
                    <div class="p-6 text-gray-900" v-if="!tasks">{{ noTask }}</div>

                    <div class="p-6 text-gray-900" v-else>
                        <div v-for="(task, index) in tasks"
                             :key="task.id"
                             class="grid shrink-0 my-2 px-2 items-center justify-center border-b-2 first:border-t-2"
                             :class="layoutGrid"
                        >
                            <img :src="task.image" :alt="task.description" class="rounded-full size-16">
                            <p class="font-bold"
                               :class="checkDate(task.date)"
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
                                   v-model="task.status"
                                   class="justify-self-center size-8 rounded-full cursor-pointer"
                            >
                            <div class="button-container grid grid-cols-3 justify-center items-center gap-2">
                                <form action=""
                                      @submit.prevent=""
                                      class="text-gray-700"
                                >
                                    <button class="material-symbols-outlined text-3xl">
                                        visibility
                                    </button>
                                </form>
                                <form action=""
                                      @submit.prevent=""
                                      class="text-blue-600"
                                >
                                    <button class="material-symbols-outlined text-3xl">
                                        edit_square
                                    </button>
                                </form>
                                <form action=""
                                      @submit.prevent=""
                                      class="text-red-700"
                                >
                                    <button class="material-symbols-outlined text-3xl">
                                        delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
