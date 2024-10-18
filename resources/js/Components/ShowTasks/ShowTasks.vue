<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';

const { task } = defineProps({
    task: {
        type: Object,
        required: true
    },

});

const remove = () => {
    router.delete(route('tasks.destroy', task.id))
}

</script>

<template>

    <div class="modal" role="dialog" id="my_modal_9">
        <div class="modal-box">

            <h1 class="text-lg font-bold mb-5 w-full">
                {{ task.title }}
            </h1>
            <p class="text-lg font-bold mb-5 w-full">
                {{ task.description }}
            </p>

            <p class="text-lg font-bold mb-5 w-full">
                {{ task.long_description }}
            </p>

            <p class="text-lg font-bold mb-5 w-full">
                {{ task.created_at }}
            </p>

            <div class="modal-action join">
                <Link :href="route('tasks.index')" class="btn-primary btn absolute bottom-1 left-6 mb-5 mt-5 ">Cancel
                </Link>
                <button @click="remove" type="submit"
                    class="btn-primary btn absolute bottom-1 right-6 mb-5 mt-5">Delete</button>
            </div>
        </div>
    </div>

</template>

<style scoped></style>