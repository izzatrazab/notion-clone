<script setup>
// af: Project dashboard (overall of all projects)

import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <AppLayout title="Project">
        <template #header>
            <Link v-bind:href="'/project'">
            <h1 class="text-h6">
                Project
            </h1>
            </Link>
        </template>
        <section>
            all project
        </section>
    </AppLayout>
</template>
