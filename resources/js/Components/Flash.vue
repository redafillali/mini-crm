<script setup>
import { defineProps, ref } from 'vue';
defineProps({
    message: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'success',
    },
});

const show = ref(true);

setTimeout(() => {
    show.value = false;
}, 5000);

</script>

<template>
    <!-- Flash message VueJS timeout  seconde -->
    <div v-if="message" v-show="show"
         class="fixed bottom-0 right-0 m-8">
        <div class="bg-white rounded-lg shadow-xl p-4 flex">
            <div class="flex-shrink-0">
                <svg v-if="type == 'success'" class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
                <svg v-else-if="type == 'error'" class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="ml-3">
                <p :class="{
                    'text-sm font-medium text-green-800': type === 'success',
                    'text-sm font-medium text-red-800': type === 'error',
                }">
                    {{ message }}
                </p>
            </div>
        </div>
    </div>
</template>