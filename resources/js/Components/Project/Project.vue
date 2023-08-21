<script setup lang='ts'>
import EditorJS, { OutputBlockData } from '@editorjs/editorjs';
import Table from '@editorjs/table';
import { reactive, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

let editor: EditorJS = null
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
        },
        data: {
            blocks: [blocks as OutputBlockData<string, any>]
        }
    })
}

onMounted(() => {
    router.get('/api/block', {}, {
        preserveState: true,
        onSuccess: ({ props }) => {
            console.log(props.blocks);
            createEditor(JSON.parse(props.blocks[0].json))
        },
    })
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