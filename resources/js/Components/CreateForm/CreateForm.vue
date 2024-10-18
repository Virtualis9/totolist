<script setup>
import { Link, router, usePage  } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

import { ref } from 'vue';

const formData = ref({
    title: '',
    description: '',
    long_description: '',
})

const page = usePage()

const submitForm = () => {
    Inertia.post(route('tasks.store'), {
        title: formData.value.title,
        description: formData.value.description,
        long_description: formData.value.long_description,
        _token: page.props.csrf_token
    })
    return {
        formData,
        submitForm
    }
}

</script>

<template>

    <div class="modal" role="dialog" id="my_modal_8">
        <div class="modal-box">
            <form @submit.prevent="submitForm">
                <h3 class="text-lg font-bold mb-5 w-full">Create Task!</h3>
                <input v-model="formData.title" type="text" placeholder="Type here"
                    class="input input-bordered input-primary w-full max-w-l mb-5" />
                <textarea v-model="formData.description" class="textarea textarea-primary w-full mb-5 "
                    placeholder="Description"></textarea><br>
                <textarea v-model="formData.long_description" class="textarea textarea-secondary w-full mb-5"
                    placeholder="long description"></textarea>
            </form>
            <div class="modal-action join">
                <Link :href="route('tasks.index')" class="btn-primary btn absolute bottom-1 left-6 mb-5 mt-5 ">Cancel
                </Link>
                <button @click="submitForm" type="submit"
                    class="btn-primary btn absolute bottom-1 right-6 mb-5 mt-5">Submit</button>
            </div>
        </div>
    </div>

</template>
