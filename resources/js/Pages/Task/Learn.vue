<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import { ref, computed } from 'vue';

const title = "Shopping List App";
const characterCount = computed(() => {
    return newItem.value.length;
});
const reversedItems = computed(() => {
    return [...items.value].reverse()
})
const editing = ref(false);
const items = ref([
    {
        id: 1,
        label: '10 party hats',
        purchased: true,
        highPriority: true,
    },
    {
        id: 2,
        label: '2 board games',
        purchased: true,
        highPriority: false,
    },
    {
        id: 3,
        label: '20 cups',
        purchased: false,
        highPriority: true,
    },
]);
const newItem = ref("");
const newItemHighPriority = ref(false);
const saveItem = () => {
    items.value.push({
        id: items.value.length + 1,
        label: newItem.value,
        purchased: false,
        highPriority: newItemHighPriority.value,
    });
    newItem.value = "";
    newItemHighPriority.value = false;
}
const doEdit = () => {
    editing.value = !editing.value;
    newItem.value = "";
    newItemHighPriority.value = false;
}
const togglePurchased = (item) => {
    item.purchased = !item.purchased;
}

</script>

<template>
    <Head title="Learn" />
    <div class="header">
        <h1>{{ title }}</h1>
        <button
            type="button"
            class="btn btn-cancel"
            v-if="editing"
            @click="doEdit"
        >
            Cancel
        </button>
        <button
            class="btn btn-primary"
            @click="doEdit"
            v-else
        >
            Add Item
        </button>
    </div>
    <form
        class="add-item-form"
        v-if="editing"
        @submit.prevent="saveItem"
    >
    <!-- v-on:click === @click -->
        <input v-model.trim="newItem" type="text" placeholder="Add an item">
        <label for="">
            <input type="checkbox" v-model="newItemHighPriority">
            High Priority
        </label>
        <button
            class="btn btn-primary"
            :disabled="newItem.length < 6 || newItem.length > 200"
        >
            <!-- v-bind:disabled === :disabled -->
            Save Item
        </button>
    </form>
    <p
        class="counter"
        v-if="editing"
    >
        {{ characterCount }} / 200
    </p>
    <ul>
        <li
            v-for="(item, index) in reversedItems"
            :key="item.id"
            @click="togglePurchased(item)"
            class="static-class"
            :class="[
                {strikeout: item.purchased},
                {priority: item.highPriority},
            ]"
        >
            {{ item.label }}
        </li>
    </ul>
    <p v-if="!items.length">
        Nothing to see here
    </p>
</template>
