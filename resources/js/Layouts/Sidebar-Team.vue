<script setup>

import { Link } from '@inertiajs/vue3';

</script>

<template>
    
    <v-list density="compact" nav>
        <v-list-group value='Team'>
            <template v-slot:activator="{ props }">
                <v-list-item title='MANAGE TEAM' v-bind="props" prepend-icon="mdi-account-multiple" />
            </template>
            <Link :href="route('teams.show', $page.props.auth.user.current_team)">
            <v-list-item value='Team Setting' title='Team Settings' />
            </Link>
            <Link :href="route('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
            <v-list-item value='create-new-team' title='Create New Team' />
            </Link>
        </v-list-group>
    </v-list>
</template>
