<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'


import EditorJS from '@editorjs/editorjs';
import Table from '@editorjs/table';
import Header from '@editorjs/header';
import Checklist from '@editorjs/checklist';
import NestedList from '@editorjs/nested-list';
import editorjsNestedChecklist from '@calumk/editorjs-nested-checklist';

import { onMounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import axios from 'axios';

let editor
let form = { blocks: '', memo_id: '' }

const props = defineProps({
    memo: {
        type: Object,
        default: null
    },
    memos: {
        type: Object,
        default: null
    }
})

function createEditor(block) {
    editor = new EditorJS({
        holder: 'editorjs',
        tools: {
            Header,
            list: {
                class: NestedList,
                inlineToolbar: true,
                config: {
                    defaultStyle: 'ordered'
                },
            },
            nestedchecklist: editorjsNestedChecklist,
            Checklist,
            table: {
                class: Table,
                inlineToolbar: true,
                config: {
                    withHeadings: true,
                }
            },
        },
        data: {
            blocks: JSON.parse(props.memo[0].json_memo)
        }
    })
}


function saveMemo() {
    form.memo_id = props.memo[0].id
    editor.save().then(async (outputData) => {
        form.blocks = JSON.stringify(outputData.blocks)
        await axios.put('/api/memo', form)

    }).catch((error) => {
        console.log('Saving failed: ', error)
    });
}

async function deleteMemo(memo_id) {
    try {
        const { data } = await axios.delete('/api/memo', { params: { memo_id } })
        if (data.status) {
            //delete success
            router.visit('/memo')
        }
    } catch (error) {
        console.log("Process: Delete memo: " + error);
    }
}

onMounted(() => {
    if (props.memo !== null) {
        createEditor(JSON.parse(props.memo[0].json_memo))
    }

    if (props.memos !== null) {
        // props.memos = JSON.parse(props.memos)
        // console.log(props.memos);
    }
})

</script>

<template>
    <AppLayout title="Memo">
        <template #header>
            <Link v-bind:href="'/memo'">
            <h1 class="text-h6">
                Memo
            </h1>
            </Link>
        </template>
        <section v-if="memo !== null ? false : true">
            <!-- <MemoList/> -->
            <v-card variant="outlined">
                <v-table density='compact'>
                    <thead>
                        <tr>
                            <th class="text-left">
                                no.
                            </th>
                            <th class="text-left">
                                Memo Name
                            </th>
                            <th class="text-left">
                                Last Updated
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(memo, index) in props.memos" :key="memo.id">
                            <td>{{ index + 1 }}</td>
                            <td>
                                <Link v-bind:href="'/memo/' + memo.id">
                                <span class='scale'>
                                    {{ memo.name }}
                                </span>
                                </Link>
                            </td>
                            <td>{{ memo.updated_at }}</td>
                        </tr>
                    </tbody>
                </v-table>
            </v-card>
        </section>
        <section v-else>
            <v-card variant="outlined">
                <h1 class='text-h4'>
                    {{ memo[0].name }}
                </h1>
                <v-btn color='primary' @click="saveMemo">save</v-btn>
                <v-btn color='warning' @click="deleteMemo(memo[0].id)">delete</v-btn>
                <div id='editorjs' />
            </v-card>
        </section>
    </AppLayout>
</template>

<style>
.scale:hover {
    display: block;
    color: rgb(48, 52, 250);
    text-decoration: underline;
    font-size: large;
}
</style>