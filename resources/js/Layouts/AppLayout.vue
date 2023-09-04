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
            <v-app-bar>
                <v-app-bar-title>
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            dashboard
                    </NavLink>
                </v-app-bar-title>
                <template v-slot:append>
                    <!-- Primary Navigation Menu -->
                    <div class="flex justify-between h-16">
                        <div class="hidden sm:flex sm:items-center sm:ml-6">

                            <!-- manage team -->
                            <v-menu>
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

                            <!-- manage account -->
                            <v-menu>
                                <template v-slot:activator="{ props }">
                                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            :src="$page.props.auth.user.profile_photo_url"
                                            :alt="$page.props.auth.user.name">
                                    </button>
                                    <v-btn color="primary" dark v-bind="props">
                                        {{ $page.props.auth.user.name }}
                                        <v-icon icon='mdi-menu-down'></v-icon>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item>
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>
                                    </v-list-item>
                                    <v-list-item>
                                        <v-btn block>
                                            <Link :href="route('profile.show')">Profile</Link>
                                        </v-btn>
                                    </v-list-item>
                                    <v-list-item v-if="$page.props.jetstream.hasApiFeatures">
                                        <Link :href="route('api-tokens.index')">API Tokens</Link>
                                    </v-list-item>
                                    <v-list-item>
                                        <form @submit.prevent="logout">
                                            <v-btn block type='submit'>
                                                Log Out
                                            </v-btn>
                                        </form>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </div>


                        <!-- <v-app-bar-nav-icon @click="showingNavigationDropdown = !showingNavigationDropdown"/> -->

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                @click="showingNavigationDropdown = !showingNavigationDropdown">

                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path
                                        :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>

                            </button>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }"
                        class="sm:hidden">
                        <div class="pt-2 pb-3 space-y-1">
                            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </ResponsiveNavLink>
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="flex items-center px-4">
                                <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                </div>

                                <div>
                                    <div class="font-medium text-base text-gray-800">
                                        {{ $page.props.auth.user.name }}
                                    </div>
                                    <div class="font-medium text-sm text-gray-500">
                                        {{ $page.props.auth.user.email }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                                    Profile
                                </ResponsiveNavLink>

                                <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures"
                                    :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                                    API Tokens
                                </ResponsiveNavLink>

                                <!-- Authentication -->
                                <form method="POST" @submit.prevent="logout">
                                    <ResponsiveNavLink as="button">
                                        Log Out
                                    </ResponsiveNavLink>
                                </form>

                                <!-- Team Management -->
                                <template v-if="$page.props.jetstream.hasTeamFeatures">
                                    <div class="border-t border-gray-200" />

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Team
                                    </div>

                                    <!-- Team Settings -->
                                    <ResponsiveNavLink :href="route('teams.show', $page.props.auth.user.current_team)"
                                        :active="route().current('teams.show')">
                                        Team Settings
                                    </ResponsiveNavLink>

                                    <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams"
                                        :href="route('teams.create')" :active="route().current('teams.create')">
                                        Create New Team
                                    </ResponsiveNavLink>

                                    <!-- Team Switcher -->
                                    <template v-if="$page.props.auth.user.all_teams.length > 1">
                                        <div class="border-t border-gray-200" />

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                            <form @submit.prevent="switchToTeam(team)">
                                                <ResponsiveNavLink as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                            class="mr-2 h-5 w-5 text-green-400"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </ResponsiveNavLink>
                                            </form>
                                        </template>
                                    </template>
                                </template>
                            </div>
                        </div>
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
