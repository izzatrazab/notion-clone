<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template >
    <Head title="Welcome" />
    <div class='d-flex align-center justify-center h-screen'>
        <v-card class='text-center'>
            <template v-if="canLogin">
                <v-card-title>
                    Welcome back
                </v-card-title>
                <v-card-item>
                    <p>
                        goFlow: A Project Management Tool in the making
                    </p>
                    <p>
                        This is suppose to be a landing/welcome page
                    </p>
                </v-card-item>
                <v-card-actions class='text-center'>
                    <Link v-if="$page.props.auth.user" :href="route('project')">
                    <v-btn rounded='xl' color='primary'>
                        Project
                    </v-btn>
                    </Link>
                    <template v-else>
                        <Link :href="route('login')">
                        <v-btn rounded='xl' color='primary'>
                            Log in
                        </v-btn>
                        </Link>
                        <Link v-if="canRegister" :href="route('register')">
                        <v-btn rounded='xl' color='primary'>
                            Register
                        </v-btn>
                        </Link>
                    </template>
                </v-card-actions>

            </template>
        </v-card>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
