<script setup>
defineProps({
    cars: {
        required: true,
        type: Object
    }
   
})

</script>

<template>
    
    <ul>
        <li v-for="car in cars">
            {{ car }}
        </li>
    </ul>

</template>
