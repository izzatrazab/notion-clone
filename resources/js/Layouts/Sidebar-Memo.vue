<script setup>

import { onMounted } from 'vue';
import axios from 'axios';
import { Link, router} from '@inertiajs/vue3';

let memoNameList

async function getMemoNameList() {
    const { data } = await axios.get('/api/memo')
    memoNameList = data.memos
}

async function createMemo(){
    const { data } = await axios.post('/api/memo')
    console.log(data);
    if (data.memo_id){
        //success create new memo
        router.visit('/memo/'+ data.memo_id)
        return
    }
    console.log('create new memo failed');
}

onMounted(() => {
    getMemoNameList()
})
</script>

<template>
    <v-list density="compact" nav>
        <v-list-group value='Memo'>
            <template v-slot:activator="{ props }">
                <v-list-item v-bind="props" prepend-icon="mdi-note-text-outline">
                    <span class='side-bar-big-nav'>
                        <Link v-bind:href="'/memo'">
                        memo
                        </Link>
                    </span>
                </v-list-item>
            </template>

            <v-list-item v-for='memoName in memoNameList'>
                <Link v-bind:href="'/memo/' + memoName.id">
                {{ memoName.name }}
                </Link>
            </v-list-item>
            <v-list-item prepend-icon="mdi-plus" title="NEW (not working)" @click="createMemo" />
        </v-list-group>
    </v-list>
</template>
