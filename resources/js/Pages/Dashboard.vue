<script setup lang='ts'>
import AppLayout from '../Layouts/AppLayout.vue'
import Project from '../Components/Project/Project.vue'

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h1>
                Dashboard
            </h1>
        </template>
        <!-- <Project /> -->
    </AppLayout>
</template>

<style>
#main {
    /* color: white; */
    padding: 10px;
}
</style>
