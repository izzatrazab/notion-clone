<script setup >
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted } from 'vue';


let drawer = ref(true)
let rail = ref(true)
let memoNameList

async function getMemoNameList() {
    const { data } = await axios.get('/api/memo')
    console.log(data);
    memoNameList = data.memos
}
onMounted(() => {
    getMemoNameList()
})

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

        <v-list density="compact" nav>
            <v-list-group value='Memo'>
                <template v-slot:activator="{ props }">
                    <v-list-item v-bind="props" prepend-icon="mdi-note-text-outline" title="MEMO"></v-list-item>
                </template>

                <v-list-item v-for='memoName in memoNameList'>
                    <Link v-bind:href="'/dashboard/' + memoName.id">
                    {{ memoName.name }}
                    </Link>
                </v-list-item>
                <v-list-item prepend-icon="mdi-plus" title="NEW" @click="console.log('d')" />
            </v-list-group>
        </v-list>
    </v-navigation-drawer>
</template>