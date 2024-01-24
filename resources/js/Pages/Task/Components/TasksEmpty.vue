<script setup>
defineProps({
    tasks: {
        type: Array,
        required: true,
    },
    message: {
        type: String,
        default: 'No task',
    },
})
</script>

<template>
    <div v-if="!tasks.length" class="p-6 text-gray-900">
        <slot></slot>
    </div>
</template>

<style scoped>

</style>
