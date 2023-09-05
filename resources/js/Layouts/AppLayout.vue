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
            <v-app-bar density="compact" :elevation="1" color='amber-accent-1'>
                <v-app-bar-title>
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        dashboard
                    </NavLink>
                </v-app-bar-title>
                <template v-slot:append>
                    <!-- Primary Navigation Menu -->
                        <div >

                            <!-- manage team -->
                            <v-menu v-if="$page.props.jetstream.hasTeamFeatures">
                                <template v-slot:activator="{ props }">
                                    <v-btn color="primary" dark v-bind="props">
                                        {{ $page.props.auth.user.current_team.name }}
                                        <v-icon icon='mdi-menu-down'></v-icon>
                                    </v-btn>
                                </template>

                                <v-list>
                                    <v-list-item>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-btn block>
                                            <Link :href="route('teams.show', $page.props.auth.user.current_team)">Team
                                            Settings</Link>
                                        </v-btn>
                                    </v-list-item>
                                    <v-list-item v-if="$page.props.jetstream.canCreateTeams">
                                        <v-btn block>
                                            <Link :href="route('teams.create')">Create New Team</Link>
                                        </v-btn>
                                    </v-list-item>
                                    <v-list-item>
                                        <template v-if="$page.props.auth.user.all_teams.length > 1">
                                            <div class="border-t border-gray-200" />

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Switch Teams
                                            </div>

                                            <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                                <v-list-item>
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <v-btn block type='submit'>
                                                            <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                                class="mr-2 h-5 w-5 text-green-400"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            {{ team.name }}
                                                        </v-btn>
                                                    </form>
                                                </v-list-item>
                                            </template>
                                        </template>
                                    </v-list-item>
                                </v-list>
                            </v-menu>

                        </div>

                </template>

            </v-app-bar>
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
