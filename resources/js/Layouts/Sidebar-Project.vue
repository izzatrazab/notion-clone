<script setup>

import { onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

let projectNameList

async function getProjectNameList() {
    const { data } = await axios.get('/project/name')
    projectNameList = data.projects
}

async function createProject() {
    const { data } = await axios.post('/project')
    console.log(data);
    if (data.project_id) {
        //success create new project
        router.visit('/project/' + data.project_id)
        return
    }
    console.log('create new project failed');
}

onMounted(() => {
    getProjectNameList()
})
</script>

<template>
    <v-list density="compact" nav>
        <v-list-group value='Project'>
            <template v-slot:activator="{ props }">
                <v-list-item v-bind="props" prepend-icon="mdi-chart-gantt" title='PROJECT' />
            </template>
            <v-list-item value='All Project' title='All Project' @click='router.visit("/project")' />
            <v-list-item v-for='(projectName, index) in projectNameList' :value='"project " + index'
                @click='router.visit("/project/" + projectName.id)' :title='projectName.name' />
            <v-list-item append-icon="mdi-plus" title="create project" @click="createProject" />
        </v-list-group>
    </v-list>
</template>
