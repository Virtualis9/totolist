<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    tasksData: {
        type: Object,
        required: true
    },

   
})

</script>

<template>

    <div class="join grid grid-cols-2 mt-5">
        <Link :href="previousPageUrl" class="join-item btn btn-outline">Previous page</Link>
        <Link :href="nextPageUrl" class="join-item btn btn-outline">Next</Link>
    </div>

</template>

<style scoped>

</style>