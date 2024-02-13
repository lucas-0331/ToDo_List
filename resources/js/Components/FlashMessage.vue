<script setup>
import { usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";

onMounted(() => {
    setTimeout(() => {
        usePage().props.flash.message = null;
    }, 3000);
});
const background = () => {
    const status = usePage().props.flash.status;
    if (status === 'success') return 'bg-green-400';
    else if (status === 'warning') return 'bg-orange-500';
    else return 'bg-red-600';
}
</script>

<template>
    <div v-if="$page.props.flash.message"
         class="flex justify-center items-center w-full top-0 right-0 left-0 font-black text-white h-[100px] text-4xl"
         :class="background()"
    >
        {{ $page.props.flash.message }}
    </div>
</template>

<style scoped>

</style>
