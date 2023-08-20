<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Project from '@/Components/Project/Project.vue'
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
                    <Project/>
                    
                    <!-- <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                    project name</th>
                                <th
                                    class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                    status</th>
                                <th
                                    class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                    priority</th>
                                <th
                                    class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                                    date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800">
                            <tr v-for='project in projects'>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    {{ project.project_name }}
                                </td>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    {{ project.status }}
                                </td>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    {{ project.priority }}</td>
                                <td
                                    class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                                    {{ (project.start_date == null) ? project.deadline : project.start_date + ' - ' +
                                        project.deadline }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan='4' class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">add project</td>
                            </tr>
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
#main {
    color: white;
    padding: 10px;
}</style>

<script>
export default {
    props: {
        projects: Array,
        tasks: Array
    }
}
</script>