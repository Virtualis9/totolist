<script setup>

import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({ 
    tasks: { 
        type: Object, 
        required: true 
    }       
});
 
</script>

<template>
    <h1>The list of tasks</h1>
    <ul>
      <li v-for="task in tasks" :key="task.id">
        <Link :href="'/tasks/' + task.id">{{ task.title }}</Link>
      </li>
    </ul>
  </template>
  