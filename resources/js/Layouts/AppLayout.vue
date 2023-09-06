<script setup >
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '../Components/Banner.vue';
import NavLink from '../Components/NavLink.vue';
import ResponsiveNavLink from '../Components/ResponsiveNavLink.vue';
import Sidebar from './Sidebar.vue'
import "@mdi/font/css/materialdesignicons.css";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
let drawer = ref(true)
let rail = ref(true)

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

</script>

<template>
    <v-app>

        <Head :title="title" />
        <Banner />

        <v-layout>
            <Sidebar />
            <v-main>
                <div class='p-6'>
                    <!-- Page Heading -->
                    <header v-if="$slots.header">
                        <slot name="header" />
                    </header>
                    <slot />
                </div>
            </v-main>
        </v-layout>
    </v-app>
</template>
