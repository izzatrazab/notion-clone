<script setup>
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
iuhi



    </AppLayout>
</template>
