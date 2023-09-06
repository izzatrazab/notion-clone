<script setup>

import { Link, router } from '@inertiajs/vue3';

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

</script>

<template>
    
    <v-list density="compact" nav class=''>
        <v-list-group value='Switch Team'>
            <template v-slot:activator="{ props }">
                <v-list-item :title='$page.props.auth.user.current_team.name.toUpperCase()' v-bind="props" prepend-icon="mdi-account-switch" />
            </template>
            <template v-for="team in $page.props.auth.user.all_teams" :key='team.id'>
                <v-list-item v-if='team.id !== $page.props.auth.user.current_team_id' :value='team.id' :title='team.name' @click='switchToTeam(team)' />
            </template>
        </v-list-group>
    </v-list>
</template>
