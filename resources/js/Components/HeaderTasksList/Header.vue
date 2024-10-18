<script setup>
import { computed, ref } from 'vue';
import TaskList from '@/Pages/Tasks/TaskList.vue';

const props = defineProps({
    tasks: {
        type: Array,
        required: true
    }
});


const tasks = ref(props.tasks);

const noneCompletedTasks = computed(() => {
  let counter = 0; 
  for (let i = 0; i < tasks.value.length; i++) {
    if (!tasks.value[i].completed) {
      counter++;
    }
  }
  return counter; 
});

const taskDonePercent = computed(() => {
  let completed = 0;
  let total = tasks.value.length;
  for (let i = 0; i < total; i++) {
    if (tasks.value[i].completed) {
      completed++;
    }
  }
  return Math.round((completed / total) * 100);
});

</script>

<template>  
    <div class="md:stats shadow w-full">
        <div class="stat">
          <div class="stat-figure text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              class="inline-block h-8 w-16 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
              </path>
            </svg>
          </div>
          <div class="stat-title">Total Tasks</div>
          <div class="stat-value text-primary">{{ tasks.length }}</div>  <!-- Use .value -->
          <div class="stat-desc">Jan 1st - Feb 1st</div>
        </div>
        <div class="stat">
          <div class="stat-figure text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              class="inline-block h-8 w-8 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
              </path>
            </svg>
          </div>
          <div class="stat-title">Task Not completed</div>
          <div class="stat-value text-secondary">{{ noneCompletedTasks }}</div> <!-- Use .value -->
          <div class="stat-desc">4% more than last month</div>
        </div>
        <div class="stat size-15">
          <div class="stat-figure text-secondary">
            <div class="avatar online">
              <div class="w-16 rounded-full">
                <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
              </div>
            </div>
          </div>
          <div class="stat-value">{{ taskDonePercent }}%</div>  <!-- Use .value -->
          <div class="stat-title">Tasks done</div>
          <div class="stat-desc text-secondary">{{ tasks.length }} tasks remaining</div>  <!-- Use .value -->
        </div>
      </div>

</template>
