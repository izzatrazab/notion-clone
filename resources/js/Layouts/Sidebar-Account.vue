<script setup>

import { Link, router } from '@inertiajs/vue3';
const logout = () => {
    router.post(route('logout'));
};

</script>

<template>
    <v-list density="compact" nav>
        <v-list-group value='Account'>
            <template v-slot:activator="{ props }">
                <v-list-item title='ACCOUNT' v-bind="props" prepend-icon="mdi-account" />
            </template>
            <Link :href="route('profile.show')">
            <v-list-item value='Profile' title='Profile' />
            </Link>
            <Link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
            <v-list-item value='api-tokens' title='API Tokens' />
            </Link>
            <v-list-item value='log-out' @click="logout" title='Log Out' />
        </v-list-group>
    </v-list>
</template>
