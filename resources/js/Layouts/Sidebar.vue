<script setup >
import { ref } from 'vue';
import SidebarMemo from './Sidebar-Memo.vue'
import SidebarAccount from './Sidebar-Account.vue'
import SidebarProject from './Sidebar-Project.vue';


let drawer = ref(true)
let rail = ref(true)

</script>

<template>
    <v-navigation-drawer v-model="drawer" :rail="rail" permanent @click="rail = false">
        <v-list-item :title="$page.props.auth.user.name" nav>
            <template v-slot:append>
                <v-btn variant="text" :icon="rail === true ? 'mdi-chevron-right' : 'mdi-chevron-left'"
                    @click.stop="rail = !rail"></v-btn>
            </template>
        </v-list-item>
        <v-divider />
        <SidebarAccount/>
        <v-divider />
        <SidebarProject/>
        <v-divider />
        <SidebarMemo />
    </v-navigation-drawer>
</template>
<style>
.side-bar-big-nav:hover {
    text-decoration: underline;
}
</style>