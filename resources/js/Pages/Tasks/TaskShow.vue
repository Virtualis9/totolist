<script setup>
import { defineProps} from 'vue';
import { router, Link } from '@inertiajs/vue3';

const {task} = defineProps({ 
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

    <h1>
        {{ task.title }}
    </h1>

    <p>
        {{ task.description }}
    </p>

    <p>
        {{ task.long_description }}
    </p>

    <p> 
        {{ task.created_at }}
    </p>

    <button @click="remove">Delete</button>
    <Link :href="route('tasks.edit', task.id)" class="btn btn-primary">Edit Task</Link>

</template>