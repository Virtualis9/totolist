<script setup>

defineProps({ 
    task: { 
        type: Object, required: true 
    }       
});

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

    <p> {{ task.created_at }}</p>
    

   
</template>