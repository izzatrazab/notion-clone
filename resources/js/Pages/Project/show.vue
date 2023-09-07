<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Gantt from 'frappe-gantt'
import { reactive } from 'vue'

const props = defineProps({
    project: {
        type: Object,
        default: "no id received"
    }
})

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
    end: '2016-12-31',
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
                        {{ props.project }}
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
        <v-divider :thickness="20" ></v-divider>
        <section>
            <v-card>
                <v-card-title>
                    Gantt Chart
                </v-card-title>
                <v-card-item>
                    <svg id="gantt"/>
                </v-card-item>
            </v-card>
        </section>

    </AppLayout>
</template>
