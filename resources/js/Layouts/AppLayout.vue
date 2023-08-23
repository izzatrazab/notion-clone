<script setup >
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Banner from '../Components/Banner.vue';
import DropdownJetstream from '../Components/DropdownJetstream.vue';
import DropdownLink from '../Components/DropdownLink.vue';
import NavLink from '../Components/NavLink.vue';
import ResponsiveNavLink from '../Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

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
        <div>

            <Head :title="title" />
            <Banner />

            <aside id="default-sidebar"
                class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
                aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                    <ul class="space-y-2 font-medium">
                        <li
                            class='flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group'>
                            <Link :href="route('dashboard')">
                            <a href="#"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 22 21">
                                    <path
                                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                    <path
                                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                                </svg>
                                <span class="ml-3">Dashboard</span>
                            </a>
                            </Link>
                        </li>

                        <li>
                            <v-btn variant="plain">sdfa</v-btn>
                        </li>

                        <li class='p-2'>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 18 21">
                                    <path
                                        d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap">E-commerce</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Products</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Billing</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Invoice</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </aside>

            <div class="sm:ml-64">
                <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
                    <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                        <!-- Primary Navigation Menu -->
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex justify-between h-16">
                                <div class="flex">
                                    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
                                        aria-controls="default-sidebar" type="button"
                                        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                        <span class="sr-only">Open sidebar</span>
                                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                            </path>
                                        </svg>
                                    </button>

                                    <!-- Navigation Links -->
                                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                            Dashboard
                                        </NavLink>
                                    </div>
                                </div>

                                <div class="hidden sm:flex sm:items-center sm:ml-6">
                                    <div class="ml-3 relative">
                                        <!-- Teams Dropdown -->
                                        <DropdownJetstream v-if="$page.props.jetstream.hasTeamFeatures" align="right"
                                            width="60">
                                            <template #trigger>
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                        {{ $page.props.auth.user.current_team.name }}

                                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <div class="w-60">
                                                    <!-- Team Management -->
                                                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                                            Manage Team
                                                        </div>

                                                        <!-- Team Settings -->
                                                        <DropdownLink
                                                            :href="route('teams.show', $page.props.auth.user.current_team)">
                                                            Team Settings
                                                        </DropdownLink>

                                                        <DropdownLink v-if="$page.props.jetstream.canCreateTeams"
                                                            :href="route('teams.create')">
                                                            Create New Team
                                                        </DropdownLink>

                                                        <!-- Team Switcher -->
                                                        <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                            <div class="border-t border-gray-200 dark:border-gray-600" />

                                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                                Switch Teams
                                                            </div>

                                                            <template v-for="team in $page.props.auth.user.all_teams"
                                                                :key="team.id">
                                                                <form @submit.prevent="switchToTeam(team)">
                                                                    <DropdownLink as="button">
                                                                        <div class="flex items-center">
                                                                            <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                                                class="mr-2 h-5 w-5 text-green-400"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="1.5" stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                            </svg>
                                                                            <div>{{ team.name }}</div>
                                                                        </div>
                                                                    </DropdownLink>
                                                                </form>
                                                            </template>
                                                        </template>
                                                    </template>
                                                </div>
                                            </template>
                                        </DropdownJetstream>
                                    </div>

                                    <!-- Settings Dropdown -->
                                    <div class="ml-3 relative">
                                        <DropdownJetstream align="right" width="48">
                                            <template #trigger>
                                                <button v-if="$page.props.jetstream.managesProfilePhotos"
                                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover"
                                                        :src="$page.props.auth.user.profile_photo_url"
                                                        :alt="$page.props.auth.user.name">
                                                </button>

                                                <span v-else class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                                        {{ $page.props.auth.user.name }}

                                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Account
                                                </div>

                                                <DropdownLink :href="route('profile.show')">
                                                    Profile
                                                </DropdownLink>

                                                <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                                    :href="route('api-tokens.index')">
                                                    API Tokens
                                                </DropdownLink>

                                                <div class="border-t border-gray-200 dark:border-gray-600" />

                                                <!-- Authentication -->
                                                <form @submit.prevent="logout">
                                                    <DropdownLink as="button">
                                                        Log Out
                                                    </DropdownLink>
                                                </form>
                                            </template>
                                        </DropdownJetstream>
                                    </div>
                                </div>

                                <!-- Hamburger -->
                                <div class="-mr-2 flex items-center sm:hidden">
                                    <button
                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
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
                            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                                <div class="flex items-center px-4">
                                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            :src="$page.props.auth.user.profile_photo_url"
                                            :alt="$page.props.auth.user.name">
                                    </div>

                                    <div>
                                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                            {{ $page.props.auth.user.name }}
                                        </div>
                                        <div class="font-medium text-sm text-gray-500">
                                            {{ $page.props.auth.user.email }}
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 space-y-1">
                                    <ResponsiveNavLink :href="route('profile.show')"
                                        :active="route().current('profile.show')">
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
                                        <div class="border-t border-gray-200 dark:border-gray-600" />

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
                                            <div class="border-t border-gray-200 dark:border-gray-600" />

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
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor">
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
                    </nav>
                    <!-- Page Heading -->

                    <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <slot name="header" />
                        </div>
                    </header>

                    <main>
                        <slot />
                    </main>
                </div>
            </div>
        </div>
    </v-app>
</template>
