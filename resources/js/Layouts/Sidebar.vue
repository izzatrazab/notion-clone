<script setup >
// af: Sidebar component encase all sidebar components (eg. Sidebar-Memo.vue, Sidebar-Account.vue)

import SidebarMemo from './Sidebar-Memo.vue'
import SidebarAccount from './Sidebar-Account.vue'
import SidebarTeam from './Sidebar-Team.vue';
import SidebarSwitchTeam from './Sidebar-SwitchTeam.vue';
import SidebarProject from './Sidebar-Project.vue';
import { ref } from 'vue';

let drawer = ref(true)
let rail = ref(true)

</script>

<template>
    <v-navigation-drawer v-model="drawer" :rail="rail" permanent @click="rail = false">
        <v-list density="compact" nav>
            <v-list-item :title="$page.props.jetstream.hasTeamFeatures ? 'team: '+ $page.props.auth.user.current_team.name.toUpperCase() : ''" 
                :prepend-icon="rail === true ? 'mdi-chevron-right' : 'mdi-chevron-left'" @click.stop="rail = !rail" />
        </v-list>
        <SidebarAccount />
        <template v-if="$page.props.jetstream.hasTeamFeatures">
            <SidebarTeam />
            <SidebarSwitchTeam v-if='$page.props.auth.user.all_teams.length > 1'/>
        </template>
        <SidebarProject />
        <SidebarMemo />
    </v-navigation-drawer>
</template>