<script setup>

import { ref, reactive, onMounted } from 'vue'
import axios from 'axios';
import draggable from 'vuedraggable'
import Gantt from 'frappe-gantt'
import VueDatePicker from '@vuepic/vue-datepicker';

const props = defineProps({
    project_id: {
        type: Number,
        required: true
    },
})
let tasksGantt = null
let tasks = reactive([])
let dependArr = reactive([])
let tempProgress

onMounted(async () => {

    const { data } = await axios.get(`/tasks/${props.project_id}`)
    tasks.push(...data.tasks);
    tasks.forEach(task => {
        task.id = task.id.toString();
        dependArr[task.id] = task.name
        task.startTemp = task.start
        task.endTemp = task.end
        task.dialogDependencies = false
    });
    if (tasks.length !== 0)
        createGantt()

})

function createGantt() {
    tasksGantt = new Gantt("#gantt", tasks, {
        on_click: function (task) {
        },
        on_date_change: async function (task, start, end) {
            const index = task.order - 1
            const startDate = start.toLocaleDateString('en-CA')
            const endDate = end.toLocaleDateString('en-CA')
            if (tasks[index].start !== startDate) {
                tasks[index].start = startDate
                tasks[index].startTemp = startDate
                await axios.put('/task/startdate', {
                    task_id: task.id,
                    new_date: startDate
                })
            }

            if (tasks[index].end !== endDate) {
                tasks[index].end = endDate
                tasks[index].endTemp = endDate
                await axios.put('/task/enddate', {
                    task_id: task.id,
                    new_date: endDate
                })
            }

        },
        on_progress_change: function (task, progress) {
            // const index = tasks.findIndex(object => {
            //     return object.id === task.id;
            // })
            // tasks[index].progress = progress
        },
        on_view_change: function (mode) {
        }
    })
}

function afterDragnDrop(evt) {
    console.log(evt);
    reorderOrder(evt.newIndex, evt.oldIndex)
    tasksGantt.refresh(tasks)
}

async function addNewTask() {
    const order = tasks.length + 1


    const { data } = await axios.post(`/task/`, {
        project_id: props.project_id,
        order
    })
    tasks.push(data.new_task)
    if (tasksGantt === null)
        createGantt()
    // tasksGantt.refresh(tasks)
}

async function reorderOrder(newIndex, oldIndex) {
    let tasks_ids = []
    let order = []

    if (newIndex < oldIndex) {
        for (let i = newIndex; i < tasks.length; i++) {
            tasks_ids.push(tasks[i].id)
            order.push(i + 1)
            tasks[i].order = i + 1;
        }
    } else {
        for (let i = newIndex; i >= 0; i--) {
            tasks_ids.push(tasks[i].id)
            order.push(i + 1)
            tasks[i].order = i + 1;
        }
    }
    const { data } = await axios.put(`/tasks/reorder`, {
        tasks_ids,
        order
    })
}

async function handleStartDate(index) {
    let new_date = tasks[index].startTemp
    tasks[index].startTemp = new_date.getFullYear() + "-" + (new_date.getMonth() + 1) + "-" + new_date.getDate()

    try {
        const { data } = await axios.put('/task/startdate', {
            task_id: tasks[index].id,
            new_date: tasks[index].startTemp
        })

        tasks[index].start = tasks[index].startTemp
        tasksGantt.refresh(tasks)
    } catch (error) {
        console.log(error);
    }
}

async function handleEndDate(index) {
    let new_date = tasks[index].endTemp
    tasks[index].endTemp = new_date.getFullYear() + "-" + (new_date.getMonth() + 1) + "-" + new_date.getDate()

    try {
        const { data } = await axios.put('/task/enddate', {
            task_id: tasks[index].id,
            new_date: tasks[index].endTemp
        })

        tasks[index].end = tasks[index].endTemp
        tasksGantt.refresh(tasks)
    } catch (error) {
        console.log(error);
    }
}

async function saveProgress(task_id, index) {
    console.log(`submit progress of: ${task_id}`);
    console.log(tasks[index].progress);
    //save to db
    try {
        const { data } = await axios.put(`/task/progress`, {
            task_id,
            progress: tasks[index].progress
        })
        tempProgress = null
        console.log(data.status);
        tasksGantt.refresh(tasks)

    } catch (error) {
        console.log(error);
    }

}

function onFocusProgress(currentProgress) {
    tempProgress = currentProgress
}

</script>

<template>
    <section>
        <v-card>
            <v-card-title>
                Tasks
            </v-card-title>
            <v-card-item>
                <v-table density='compact'>
                    <thead>
                        <tr>
                            <th class="text-left">Task Name</th>
                            <th class="text-left">Progress</th>
                            <th class="text-left">Start</th>
                            <th class="text-left">End</th>
                            <th class="text-left">Dependencies</th>
                        </tr>
                    </thead>
                    <draggable :list="tasks" item-key="id" tag='tbody' @end="afterDragnDrop">
                        <template #item="{ element, index }">
                            <tr :key='element.id'>
                                <td>{{ element.name }}</td>
                                <td>
                                    <v-text-field density="compact" variant="plain" v-model='element.progress'
                                        @focus='onFocusProgress(element.progress)'
                                        @keyup.enter="saveProgress(element.id, index)" @blur='() => {
                                            if (tempProgress !== null) {
                                                element.progress = tempProgress
                                                tempProgress = null
                                            }
                                        }' :placeholder='`${element.progress} %`' hide-details
                                        append-icon="mdi-percent-outline"></v-text-field>
                                </td>
                                <td>
                                    <VueDatePicker format='yyyy-MM-dd' v-model="element.startTemp"
                                        @update:model-value="handleStartDate(index)" dark>
                                    </VueDatePicker>
                                </td>
                                <td>
                                    <VueDatePicker format='yyyy-MM-dd' v-model="element.endTemp"
                                        @update:model-value="handleEndDate(index)" dark>
                                    </VueDatePicker>
                                </td>
                                <td>
                                    <v-dialog v-model="element.dialogDependencies" width="auto">
                                        <template v-slot:activator="{ props }">
                                            <v-btn variant='text' v-bind="props">
                                                <template v-for='dependencies in element.dependencies'>
                                                    {{ dependArr[dependencies] }}
                                                </template>

                                            </v-btn>
                                        </template>

                                        <v-card>
                                            <v-card-item>
                                                <v-checkbox v-for="task in tasks" :key="task.id"
                                                    v-model='element.dependencies' :label="task.name" :value="task.id"
                                                    hide-details @change='tasksGantt.refresh(tasks)'></v-checkbox>
                                            </v-card-item>
                                        </v-card>
                                    </v-dialog>
                                </td>
                            </tr>
                        </template>
                        <template #footer>
                            <tr>
                                <td colspan='5' class='text-center'>
                                    <v-btn prepend-icon="mdi-plus-box-outline" variant='text' @click='addNewTask()'>
                                        add task
                                    </v-btn>
                                </td>
                            </tr>
                        </template>
                    </draggable>
                </v-table>
            </v-card-item>
        </v-card>
    </section>
    <v-divider :thickness="20" class='border-opacity-0'></v-divider>
    <section>
        <v-card>
            <v-card-title>
                Gantt Chart
            </v-card-title>
            <v-card-item>
                <svg id="gantt"></svg>
            </v-card-item>
        </v-card>
    </section>
</template>