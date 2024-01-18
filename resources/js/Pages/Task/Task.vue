<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'

const { tasks } = defineProps(['tasks'])

const header = ref('Tasks');

</script>

<template>
    <Head title="Home" />

    <h1>{{ header }}</h1>

<!--    <ul>-->
<!--        <li v-for="task in tasks" :key="task.id">-->
<!--            {{ task.name }}-->
<!--        </li>-->
<!--    </ul>-->
    <div v-for="task in tasks" :key="task.id">
        <span>{{task.name}}</span>
    </div>
</template>
