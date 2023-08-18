<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Project from '@/Components/Project/Project.vue';

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id='main' class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Project /> 
                    {{ project }}
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
    #main{
        color: white;
        padding: 10px;
    }
</style>

<script>
export default {
    props:{
        project:Array,
        tasks:Array
    }
}
</script>