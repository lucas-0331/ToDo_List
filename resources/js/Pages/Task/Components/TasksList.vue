<script setup>
import {router} from "@inertiajs/vue3";

defineProps({
    tasks: {
        type: Array,
        required: true,
    }
})
const layoutGrid = [
    'grid-cols-[100px_100px_100px_100px_100px]',
    'md:grid-cols-[100px_100px_180px_1fr_100px_100px]',
    'grid-rows-[85px]',
    'md:grid-rows-[minmax(100px,_180px)]',
    'lg:grid-rows-[minmax(50px,_85px)]',
];
const checkDate = (date) => {
    const currentDate = new Date();
    const inputDate = new Date(date);
    currentDate.setHours(0, 0, 0, 0);
    inputDate.setHours(0, 0, 0, 0);
    // console.log(currentDate, inputDate);

    if (inputDate < currentDate) {
        return 'text-red-500';
    } else if (inputDate > currentDate) {
        return 'text-green-600';
    } else {
        return 'text-yellow-500';
    }
};
const deleteTask = (idTask) => {
    if(idTask) {
        // axios.delete(route('task.destroy', idTask)).then(() => {
        //     router.reload()
        //     alert('Deletado!')
        // }).catch(() => {
        //     alert('Error delete')
        // });
        router.delete(route('task.destroy', idTask), {
            onSuccess() {

            },
            preserveState: false,

        })
    }
};
</script>

<template>
    <div v-if="tasks.length" class="p-6 text-gray-900">
        <div v-for="(task, index) in tasks"
             :key="task.id"
             class="grid shrink-0 my-2 px-2 items-center justify-center border-b-2 first:border-t-2"
             :class="layoutGrid"
        >
            <img loading="lazy" :src="task.image" :alt="task.description" class="rounded-full size-16">
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
                <button class="material-symbols-outlined text-3xl text-red-700"
                        @click="deleteTask(task.id)"
                >
                    delete
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
