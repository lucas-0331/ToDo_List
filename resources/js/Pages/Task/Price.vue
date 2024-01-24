<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import { ref } from 'vue';

const title = ref('Challenge');
const theHeader = ref('Upgrade your plan');
const theFooter = ref('Need more capabilities?')
const plans = ref([
    {
        id: 1,
        type: 'Free',
        value: 'USD $0/month',
        description: 'For people just getting started with ChatGPT',
        upgrade: 'Your current plan',
        benefits: [
          {id: 1, label: 'Unlimited messages, interactions, and history'},
          {id: 2, label: 'Access to our GPT-3.5 model'},
          {id: 3, label: 'Access on Web, iOS, and Android'},
        ],
        footer: 'Have an existing plan? See billing help',
        colorButton: 'btn-secondary bg-gray-400 hover:bg-gray-500',
    },
    {
        id: 2,
        type: 'Plus',
        value: 'USD $20/month',
        description: 'Everything in Free, and:',
        upgrade: 'Upgrade to Plus',
        benefits: [
            {id: 1, label: 'Access to GPT-4, our most capable model'},
            {id: 2, label: 'Browse, create, and use GPTs'},
            {id: 3, label: 'Access to additional tools like DALL-E, Browsing, Advanced Data Analysis and more'},
        ],
        footer: null,
        colorButton: 'btn-success bg-blue-500 hover:bg-blue-600',
    },
    {
        id: 3,
        type: 'Team',
        value: 'USD $25 per person/month*',
        description: 'Everything in Plus, and:',
        upgrade: 'Upgrade to Team',
        benefits: [
            {id: 1, label: 'Higher message caps on GPT-4 and tools like DALL-E, Browsing, Advanced Data Analysis, and more'},
            {id: 2, label: 'Create and Share GPTs with your workspace'},
            {id: 3, label: 'Admin console for workspace management'},
            {id: 4, label: 'Team data excluded from training by default'},
        ],
        footer: '* Price billed annually minimum 2 users',
        colorButton: 'btn-primary bg-green-700 hover:bg-green-800',
    },
]);
</script>

<template>
    <Head :title="title"></Head>
    <div class="plans-container flex justify-center items-center p-2 min-h-screen bg-white">
        <div class="plans-layout p-2 grid grid-rows-[80px_minmax(400px,_1fr)_80px] w-full max-w-[900px] min-h-[400px] shrink-0">
            <div class="plan-header flex items-center pl-5 bord bg-gray-700 font-medium text-xl rounded-t-md">
                <h1>{{ theHeader }}</h1>
            </div>
            <div class="plans-content grid grid-cols-1 md:grid-cols-3">
                <div v-for="plan in plans"
                     :key="plan.id"
                     class="border-gray-500 border-b-[1px] border-t-[1px] p-5 md:border-[1px]"
                >
                    <h3 class="font-medium text-xl">
                        {{ plan.type }}
                    </h3>
                    <p class="font-normal text-base text-gray-400 mt-2">
                        {{ plan.value }}
                    </p>
                    <div class="button-content flex justify-center my-5 mx-2">
                        <button
                            class="btn w-5/6 font-medium p-2 rounded"
                            :class="plan.colorButton"
                        >
                            {{ plan.upgrade }}
                        </button>
                    </div>
                    <p class="font-medium">
                        {{ plan.description }}
                    </p>
                    <ul class="mb-3">
                        <li v-for="benefit in plan.benefits"
                            :key="benefit.id"
                            class="font-normal text-sm my-1"
                        >
                            <span class="material-symbols-outlined mr-4 text-sm">
                                check
                            </span>
                            {{ benefit.label }}
                        </li>
                    </ul>
                    <span v-if="plan.footer"
                          class="font-normal text-xs text-gray-400"
                    >
                        {{ plan.footer }}
                    </span>
                </div>
            </div>
            <div class="price-footer flex items-center justify-center bg-gray-700 font-normal rounded-b-md">
                {{ theFooter }}
            </div>
        </div>
    </div>
</template>
