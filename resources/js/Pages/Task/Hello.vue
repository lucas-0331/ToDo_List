<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import { ref, onMounted, onBeforeMount } from 'vue'

/**
 * Function
 */
// function metade() {
//     return contador.value / 2
// }
// const metade = function() {
//     return contador.value / 2
// }

/**
 * Arrow Function
 */
// const metade = () => ({})
// const metade = () => {
//     return {}
// }

/**
 * Option API
 */
// export default {
//     components: {
//         Head,
//     },
//     data() => {contador: 1} {
//         return { contador: 1 }
//     },
//     methods: {
//         metade() {
//             return this.contador / 2
//         }
//     }
// }

const contador = ref(1)

const pessoa = ref({
        nome: 'João',
        idade: 17,
        cidade: 'Campinas',
        maiorIdade: () => pessoa.value.idade > 18
    }
)

setInterval(() => {
    pessoa.value.idade++
}, 1000);

onMounted( () => {
    console.log('onmounted');
});

onBeforeMount( () => {
    console.log('onbeforemount');
});
</script>

<template>
    <h1>{{ pessoa }}</h1>
    <h2>{{ pessoa.maiorIdade() }}</h2>
    <input type="text" v-model="pessoa.nome">
    <button @click="contador++">+1</button>
    <button @click="pessoa.idade--">-1</button>
    <input type="text" v-model="pessoa.idade">
    <button @click="pessoa.idade++">+1</button>
    <div>
        <Head title="Hello" />
        <h1 class="mb-8 text-3xl font-bold">Hello</h1>
        <p class="mb-8 leading-normal">Hello World, my Hello.vue work! <a class="text-indigo-500 hover:text-orange-600 underline" href="https://inertiajs.com">Inertia.js</a> works.</p>
    </div>
</template>


