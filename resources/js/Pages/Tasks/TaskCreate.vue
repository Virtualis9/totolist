<script setup>

import { ref, onMounted } from 'vue';

const token = ref('');

const taskTitle = ref('');

onMounted(() => {
  token.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
});

const submitForm = async () => {

  const response = await fetch('/tasks/create', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': token.value, // Add CSRF token to the headers
    },
    body: JSON.stringify({
      // Include the form data to send
      task_title: 'Your task title here'
    })
  });

  const data = await response.json();

  console.log(data);

};
</script>

<template>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <form @submit.prevent="submitForm">
    <h1>Create Task</h1>
    
    <button type="submit">Submit</button>
  </form>

</template>

<style>

</style>
