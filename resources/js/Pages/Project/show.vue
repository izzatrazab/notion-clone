<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Gantt from 'frappe-gantt'
import axios from 'axios';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { reactive, ref } from 'vue'
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'


const props = defineProps({
    project: {
        type: Object,
        default: "no id received"
    }
})

let date = ref([props.project.start, props.project.end])

let gantt = null
let tasks = reactive([{
    id: '1',
    name: 'Redesign website',
    start: '2016-12-28',
    end: '2016-12-31',
    progress: 20,
    dependencies: ''
}, {
    id: '3',
    name: 'Revamp website',
    start: '2016-12-28',
    end: '2016-12-31',
    progress: 20,
    dependencies: '1',
    priority: 'high'
},
{
    id: '2',
    name: 'Revamp website no2',
    start: '2016-12-28',
    end: '2016-12-28',
    progress: 20,
    dependencies: '1'
}])

function testing() {
    tasks[0].progress++;
    gantt.refresh(tasks)
}



onMounted(() => {
    console.log(props.project);

    gantt = reactive(new Gantt("#gantt", tasks, {
        on_click: function (task) {
            console.log(task);
        },
        on_date_change: function (task, start, end) {
            const index = tasks.findIndex(object => {
                return object.id === task.id;
            })
            console.log(index);
            tasks[index].start = start.toLocaleDateString('en-CA')
            tasks[index].end = end.toLocaleDateString('en-CA')

        },
        on_progress_change: function (task, progress) {
            const index = tasks.findIndex(object => {
                return object.id === task.id;
            })
            tasks[index].progress = progress
        },
        on_view_change: function (mode) {
            console.log(mode);
        }
    }))
})

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
                                        <v-text-field v-model="props.project.name" :counter="10" label="Project name"
                                            hide-details></v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="4">
                                        <VueDatePicker v-model="date" range format='yyyy-MM-dd'></VueDatePicker>
                                    </v-col>
                                </v-row>
                                <v-btn type="submit" color='primary' class="mt-2">update</v-btn>
                            </v-container>
                        </v-form>
                    </v-expansion-panel-text>
                </v-expansion-panel>
            </v-expansion-panels>
        </template>
        <v-divider :thickness="20"></v-divider>
        <section>
            <v-card>
                <v-card-title>
                    Table
                </v-card-title>
                <v-card-item>

                    <v-btn @click='testing'>
                        test
                    </v-btn>
                    <v-table density='compact'>
                        <thead>
                            <tr>
                                <th class="text-left">
                                    Task Name
                                </th>

                                <th class="text-left">
                                    Progress
                                </th>
                                <th class="text-left">
                                    Start
                                </th>
                                <th class="text-left">
                                    End
                                </th>
                                <th class="text-left">
                                    Dependencies
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(task, index) in tasks" :key="task.id">
                                <td>{{ task.name }}</td>
                                <td>{{ task.progress }}%</td>
                                <td>{{ task.start }}</td>
                                <td>{{ task.end }}</td>
                                <td>{{ task.dependencies }}</td>
                            </tr>
                        </tbody>
                    </v-table>
                </v-card-item>

            </v-card>
        </section>
        <v-divider :thickness="20"></v-divider>
        <section>
            <v-card>
                <v-card-title>
                    Gantt Chart
                </v-card-title>
                <v-card-item>
                    <svg id="gantt" />
                </v-card-item>
            </v-card>
        </section>

    </AppLayout>
</template>
