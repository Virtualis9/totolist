<script setup>
import { computed, defineProps, ref } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import Header from '@/Components/HeaderTasksList/Header.vue';
import CreateTaskButton from '@/Components/CreateTaskButton/CreateTaskButton.vue';
import CreateForm from '@/Components/CreateForm/CreateForm.vue';
import PreviousAndNextButton from '@/Components/PreviousAndNextButton/PreviousAndNextButton.vue';
import Notification from '@/Components/Notification/Notification.vue';
import ShowTasks from '@/Components/ShowTasks/ShowTasks.vue';

// Define the props for tasks
const props = defineProps({

  tasksData: {
    type: Object,
    required: true
  },

  randomNotCompletedTasks: {
    type: Array,
    required: true
  },

  searchInput: {
    type: String,
    required: false,
    default: ''
  }

});

const tasks = props.tasksData;

const nextPageUrl = props.tasksData.first_page_url

const previousPageUrl = props.tasksData.prev_page_url

const previousLength = ref(tasks.length);

const { searchInput } = props

const notification = computed(() => {

  const currentLength = tasks.length;

  if (currentLength > previousLength.value) {
    alert("yay! Task updated successfully.");
  }

  previousLength.value = currentLength;

});

const sortOption = ref('all');

const filteredTasks = computed(() => {
  if (sortOption.value === 'completed') {
    return tasks.filter(task => task.completed);
  } else if (sortOption.value === 'notCompleted') {
    return tasks.filter(task => !task.completed);
  } else if (sortOption.value === '[A-Z]') {
    return tasks.sort((a, b) => {
      if (a.title > b.title) {
        return 1;
      } else {
        return -1;
      }
    })

  } else if (sortOption.value === '[Z-A]') {
    return tasks.sort((a, b) => {
      if (a.title < b.title) {
        return -1;
      } else {
        return 1;
      }
    })
  } else {
    return tasks;
  }
});

const search = ref(searchInput)

const tasksMatchSearch = (tasks, str) => {
  return tasks.name.indexOf(str) !== -1
}

const filteredTasksBySearch = computed(() => {
  return tasks.filter(task => {
    return tasksMatchSearch(task, search.value)
  })
})

const doSearch = () => {
  router.visit(route('tasks.index'), {
    query: {
      search: search.value
    }
  })
}

const openModal = ref(false)

const openTaskModal = ref(true)

</script>

<template>
  <div class="flex justify-center align-center w-screen h-screen min-h-screen">
    <div class="mt-10">

      <Header :tasks="tasks"></Header>

      <div class="flex justify-center mt-5 mb-5 md:flex-row flex-col gap-5 p-4 w-full">
        <input type="text" placeholder="Type here" class="input input-bordered input-secondary w-full max-w-l mr-5" />
        <select class="select select-primary w-full max-w-l" v-model="sortOption">
          <option value="all">All</option>
          <option value="completed">Completed</option>
          <option value="notCompleted">Not Completed</option>
          <option value="[A-Z]">[A-Z]</option>
          <option value="[Z-A]">[Z-A]</option>
        </select>
      </div>

      <CreateTaskButton></CreateTaskButton>

      <Notification></Notification>

      <CreateForm :openModal="openModal"></CreateForm>

      <ShowTasks :task="tasks" :openTaskModal="openTaskModal"></ShowTasks>

      <div class="divider divider-primary">Primary Tasks</div>
     
      <div class="text-white-700 text-left ml-5 mb-5 bg-white-700 text-center p-5 cursor-pointer ">
        <ul class="grid md:grid-cols-3 gap-5 border-white font-bold  ">
          <Link :href="route('tasks.show', task.id)" class="bg-base-200 p-5 rounded-md hover:bg-base-300"
            v-for="task in filteredTasks" :key="task.id">
          {{ task.title }}
          </Link>
        </ul>
      </div>

      <div class="divider divider-secondary"> 6 Random Incomplete Tasks </div>
      <div class="m-10 ">
        <div class="text-white-700 text-left ml-5 mb-5 bg-white-700 text-center p-5 cursor-pointer ">
          <ul class="grid grid-cols-3 gap-5 border-white font-bold  ">
            <li class="bg-base-200 p-5 rounded-md hover:bg-base-300"
              v-for="randomNotCompletedTasks in randomNotCompletedTasks">
              <Link :href="route('tasks.show', randomNotCompletedTasks.id)">{{ randomNotCompletedTasks.title }} </Link>
            </li>
          </ul>
        </div>
      </div>

      <PreviousAndNextButton :tasksData="tasks" :searchInput="searchInput"></PreviousAndNextButton>>

    </div>
  </div>





</template>
