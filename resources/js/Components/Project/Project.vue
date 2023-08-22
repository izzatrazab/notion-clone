<script setup lang='ts'>
import EditorJS, { OutputBlockData } from '@editorjs/editorjs';
import Table from '@editorjs/table';
import Warning from '@editorjs/warning';
import { reactive, onBeforeMount } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios';

let editor: EditorJS
let form: { blocks: string } = reactive({
    blocks: ''
})

function saveEditor() {
    editor.save().then((outputData) => {
        form.blocks = JSON.stringify(outputData.blocks[0])
        router.post('/api/block', form)
    }).catch((error) => {
        console.log('Saving failed: ', error)
    });
}

function createEditor(blocks: { id: string, type: string, data: { withHeadings: boolean, content: String[][] } }) {
    editor = new EditorJS({
        holder: 'editorjs',
        tools: {
            table: {
                class: Table,
                inlineToolbar: true,
                config: {
                    // rows: 3,
                    cols: 3,
                    withHeadings: true,
                },
            },
            Warning
        },
        data: {
            blocks: [blocks as OutputBlockData<string, any>]
        }
    })
}

async function getBlock() {
    const {data} = await axios.get('/api/block')
    createEditor(JSON.parse(data.blocks[0].json))
    
}

onBeforeMount(() => {
    getBlock()

    // router.get('/api/block', {}, {
    //     preserveState: true,
    //     onSuccess: ({ props }) => {
    //         console.log(props.blocks);
    //         createEditor(JSON.parse(props.blocks[0].json))
    //     },
    // })
})

</script>
<template>
    <button @click='saveEditor()'>
        save
    </button>
    <div id='editorjs'>
    </div>
</template>

<style></style>