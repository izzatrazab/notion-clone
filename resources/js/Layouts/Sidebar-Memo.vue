<script setup>

import { onMounted } from 'vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

let memoNameList

async function getMemoNameList() {
    const { data } = await axios.get('/api/memo')
    memoNameList = data.memos
}

async function createMemo() {
    const { data } = await axios.post('/api/memo')
    console.log(data);
    if (data.memo_id) {
        //success create new memo
        router.visit('/memo/' + data.memo_id)
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
                <v-list-item v-bind="props" prepend-icon="mdi-note-text-outline" title='MEMO' />
            </template>
            <v-list-item value='All Memo' title='All Memo' @click='router.visit("/memo")' />
            <v-list-item v-for='(memoName, index) in memoNameList' :value='"memo " + index'
                @click='router.visit("/memo/" + memoName.id)' :title='memoName.name' />
            <v-list-item append-icon="mdi-plus" title="create memo" @click="createMemo" />
        </v-list-group>
    </v-list>
</template>
