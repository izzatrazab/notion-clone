<script setup>
import axios from 'axios';
import AppLayout from '@/Layouts/AppLayout.vue'
import Task from '@/Components/Task/Task.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const props = defineProps({
    project: {
        type: Object,
        default: "no id received"
    },
    tasks: {
        type: Array,
        default: []
    }
})

let date = ref([props.project.start, props.project.end])

async function updateProject() {
    let form = {
        project_id: props.project.id,
        name: props.project.name,
        start: null,
        end: null
    }

    try {
        form.start = `${date.value[0].getFullYear()}-${date.value[0].getMonth() + 1}-${date.value[0].getDate()}`
    } catch (error) {
        form.start = date.value[0]
    }
    try {
        form.end = `${date.value[1].getFullYear()}-${date.value[1].getMonth() + 1}-${date.value[1].getDate()}`
    } catch (error) {
        form.end = date.value[1]
    }
    try {
        await axios.put('/project', form)
    } catch (error) {
        console.log('Update project failed: ', error);
    }
}

</script>

<template>
    <AppLayout title="Project">
        <template #header>
            <h1 class="text-h6">
                <Link v-bind:href="'/project'">
                Project:
                </Link>
                {{ props.project.name }}
            </h1>
            <v-expansion-panels>
                <v-expansion-panel title="Details">
                    <v-expansion-panel-text>
                        <v-form @submit.prevent='updateProject()'>
                            <v-container>
                                <v-row align='end'>
                                    <v-col cols="12" md="4">
                                        <v-text-field v-model="props.project.name" label="Project Name" hide-details variant='solo'></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="4">
                                        <VueDatePicker v-model="date" range format='yyyy-MM-dd' dark></VueDatePicker>
                                    </v-col>
                                </v-row>
                                <v-btn type="submit" color='primary' class="mt-2" rounded='xl'>update</v-btn>
                            </v-container>
                        </v-form>
                    </v-expansion-panel-text>
                </v-expansion-panel>
            </v-expansion-panels>
        </template>
        <v-divider :thickness="20" class='border-opacity-0'></v-divider>
        <Task :project_id='props.project.id' />
    </AppLayout>
</template>
