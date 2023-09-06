<script setup>

import { Link, router } from '@inertiajs/vue3';
const logout = () => {
    router.post(route('logout'));
};

</script>

<template>
    <v-list density="compact" nav>
        <v-list-group value='Team'>
            <template v-slot:activator="{ props }">
                <v-list-item :title='$page.props.auth.user.current_team.name' v-bind="props" prepend-icon="mdi-account" />
            </template>
            <Link :href="route('teams.show', $page.props.auth.user.current_team)">
            <v-list-item value='Setting' title='Settings' />
            </Link>
            <Link :href="route('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
            <v-list-item value='create-new-team' title='Create New Team' />
            </Link>
            <v-list-item value='log-out' @click="logout" title='Log Out' />
        </v-list-group>
    </v-list>
</template>
