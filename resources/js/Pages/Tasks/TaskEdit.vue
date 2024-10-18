<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, defineProps, watch } from 'vue';

// Get the task from props
const { task } = defineProps({
  task: {
    type: Object,
    required: true
  }
});

// Initialize form data with task prop values
const formData = ref({
  title: task.title,
  description: task.description,
  long_description: task.long_description,
});

// Get the page object to access the CSRF token if needed
const page = usePage();

// Function to handle form submission
const submitForm = () => {
  Inertia.put(route('tasks.update', task.id), formData.value, {
    onSuccess: () => {
      console.log('Task updated successfully');
    },
    onError: (errors) => {
      console.log('Failed to update the task:', errors);
    }
  });
};

</script>

<template>
  <form @submit.prevent="submitForm">
    <h3 class="text-lg font-bold mb-5 w-full">Edit Task!</h3>

    <input v-model="formData.title" type="text" placeholder="Type here" class="input input-bordered input-primary w-full max-w-l mb-5" />

    <textarea v-model="formData.description" class="textarea textarea-primary w-full mb-5" placeholder="Description"></textarea>

    <textarea v-model="formData.long_description" class="textarea textarea-secondary w-full mb-5" placeholder="Long description"></textarea>

    <div class="modal-action join">
      <Link :href="route('tasks.index')" class="btn-primary btn absolute bottom-1 left-6 mb-5 mt-5">
        Cancel
      </Link>

      <button type="submit" class="btn-primary btn absolute bottom-1 right-6 mb-5 mt-5">
        Submit
      </button>
    </div>
  </form>
</template>
